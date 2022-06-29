import fs from 'fs/promises'
import yaml from 'js-yaml'
import path from 'path'
import { normalizePath } from 'vite'
import { database, refreshDatabase } from './connection.js'

let compiling = false

export default () => {
    return {
        name: 'Database Generator',
        async buildStart() {
            await compile()
        },
        async handleHotUpdate({ server }) {
            server.watcher.on('change', async (path) => {
                if (compiling || !normalizePath(path).includes('database/menus')) return

                await compile()
            })
        }
    }
}

export async function compile() {
    if (compiling) return

    compiling = true

    await refreshDatabase()

    await migrateDatabase()

    await compileMenus()

    await afterCompilation()

    compiling = false
}

async function migrateDatabase() {
    await database.schema.createTable('faculties', (table) => {
        table.bigIncrements('id').primary()
        table.string('name')
        table.string('short_name')
    })

    await database.schema.createTable('cafeterias', (table) => {
        table.bigIncrements('id').primary()
        table.bigint('faculty_id').references('faculties.id')
        table.string('name')
    })

    await database.schema.createTable('categories', (table) => {
        table.bigIncrements('id').primary()
        table.string('name').unique()
    })

    await database.schema.createTable('products', (table) => {
        table.bigIncrements('id').primary()
        table.bigint('cafeteria_id').references('cafeterias.id')
        table.string('name')
        table.tinyint('quantity')
        table.decimal('price', 5, 2)
        table.string('image')
    })

    await database.schema.createTable('category_product', (table) => {
        table.bigint('category_id').references('categories.id')
        table.bigint('product_id').references('products.id')
    })
}

async function compileMenus() {
    const menus_directory = './src/lib/database/menus'
    const menus = await fs.readdir(menus_directory)

    for (const menu of menus) {
        if (!menu.endsWith('.yaml')) continue

        // noinspection JSValidateTypes
        /**
         * @type {import('../menus/Menu').FacultyMenu}
         */
        const faculty = yaml.load(
            await fs.readFile(path.resolve(menus_directory, menu), {
                encoding: 'utf-8'
            })
        )

        const [faculty_id] = await database('faculties').insert({
            name: faculty.name,
            short_name: faculty.short_name
        })

        for (const cafeteria of faculty.cafeterias) {
            const [cafeteria_id] = await database('cafeterias').insert({
                faculty_id,
                name: cafeteria.name
            })

            for (const products of cafeteria.products) {
                const [product_id] = await database('products').insert({
                    cafeteria_id,
                    name: products.name,
                    price: products.price,
                    quantity: products.quantity,
                    image: products.image
                })

                for (const category_name of products.categories) {
                    const [{ id: category_id }] = await database('categories')
                        .insert({
                            name: category_name
                        })
                        .onConflict('name')
                        .merge()
                        .returning('id')

                    await database('category_product').insert({
                        category_id,
                        product_id
                    })
                }
            }
        }
    }
}

async function afterCompilation() {
    await database.schema.raw(
        'CREATE VIRTUAL TABLE products_fts using fts5(id, name, content=products, content_rowid=id, tokenize="trigram")'
    )

    await database.schema.raw("INSERT INTO products_fts(products_fts) VALUES ('rebuild')")

    await database.schema.raw('VACUUM')
}
