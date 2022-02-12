import fs from 'fs/promises'
import path from 'path'
import yaml from 'js-yaml'
import { Connection, createConnection, getConnection, getConnectionManager } from 'typeorm'
import { normalizePath, Plugin } from 'vite'
import { Faculty, Cafeteria, Product, Category, models } from '../models'
import { FacultyMenu } from './menus/Menu'

async function build(): Promise<void> {
  const database = path.resolve(__dirname, 'database.sqlite')

  await ensureDatabaseExists(database)

  const connection = await createConnection({
    type: 'sqljs',
    location: database,
    autoSave: true,
    entities: models,
  })

  await connection.synchronize(true)

  await importDataset(connection)

  await connection.close()
}

async function ensureDatabaseExists(path: string): Promise<void> {
  try {
    await fs.access(path)
    return
  } catch {
    const handler = await fs.open(path, 'w')
    await handler.close()
  }
}

async function importDataset(connection: Connection): Promise<void> {
  await connection.transaction(async (transactionManager) => {
    const menuDir = path.resolve(__dirname, 'menus')
    const menus = await fs.readdir(menuDir)

    let faculty_id = 0
    let cafeteria_id = 0
    let product_id = 0

    const categoryMap = new Map<string, number>()

    for (const menu of menus) {
      if (!menu.endsWith('.yaml')) {
        continue
      }

      const data = yaml.load(
        await fs.readFile(path.resolve(menuDir, menu), {
          encoding: 'utf-8',
        })
      ) as FacultyMenu

      await transactionManager.insert(Faculty, {
        rowid: ++faculty_id,
        name: data.name,
        short_name: data.short_name,
        maps_url: data.maps_url,
      })

      for (const cafeteria of data.cafeterias) {
        await transactionManager.insert(Cafeteria, {
          rowid: ++cafeteria_id,
          name: cafeteria.name,
          // @ts-ignore
          faculty_id,
        })

        for (const product of cafeteria.products) {
          await transactionManager.insert(Product, {
            rowid: ++product_id,
            name: product.name,
            quantity: product.quantity ?? 1,
            price: product.price,
            image: product.image,
            // @ts-ignore
            cafeteria_id,
          })

          for (const category of product.categories) {
            let category_id = categoryMap.get(category)

            if (!category_id) {
              category_id = categoryMap.size + 1
              categoryMap.set(category, category_id)

              await transactionManager.insert(Category, {
                rowid: category_id,
                name: category,
              })
            }

            await transactionManager.createQueryBuilder().relation(Product, 'categories').of(product_id).add(category_id)
          }
        }
      }
    }
  })

  await connection.query('VACUUM')
}

let building = false

export default function (): Plugin {
  return {
    name: 'Database Compiler',
    async buildStart(): Promise<void> {
      await build()
    },
    async handleHotUpdate({ server }): Promise<void> {
      server.watcher.on('change', async (path) => {
        if (building || !normalizePath(path).includes('database/menus')) {
          return
        }

        building = true

        await build()

        building = false
      })
    },
  }
}
