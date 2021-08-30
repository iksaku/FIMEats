// 1. touch the file ✅
// 2. execute migrations
// 3. transform YAML -> SQL Statements
// 4. wrap SQL statements into a transaction
// 5. execute transactions
// 6. watch menus directory, re-generate DB

import fs from 'fs/promises'
import path from 'path'
import yaml from 'js-yaml'
import {createConnection, getConnection, getConnectionManager} from "typeorm";
import {normalizePath, Plugin} from "vite";
import { Faculty, Cafeteria, Product, Category, models } from "../models";
import { FacultyMenu } from './menus/Menu'

async function build(): Promise<void> {
  const database = path.resolve(__dirname, 'database.sqlite')

  await ensureDatabaseExists(database)

  if (! getConnectionManager().has('default')) {
    await createConnection({
      type: 'sqljs',
      location: database,
      autoSave: true,
      entities: models,
    })
  }

  await getConnection().synchronize(true)

  await importDataset()
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

async function importDataset(): Promise<void> {
  await getConnection().transaction(async (transactionManager) => {
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

      const data = yaml.load(await fs.readFile(path.resolve(menuDir, menu))) as FacultyMenu

      await transactionManager.insert(Faculty, {
        id: ++faculty_id,
        name: data.name,
        short_name: data.short_name,
        logo: data.logo,
        maps_url: data.maps_url,
      })

      for (const cafeteria of data.cafeterias) {
        await transactionManager.insert(Cafeteria, {
          id: ++cafeteria_id,
          name: cafeteria.name,
          faculty_id,
        })

        for (const product of cafeteria.products) {
          await transactionManager.insert(Product, {
            id: ++product_id,
            name: product.name,
            quantity: product.quantity ?? 1,
            price: product.price,
            image: product.image,
            cafeteria_id,
          })

          for (const category of product.categories) {
            let category_id = categoryMap.get(category)

            if (!category_id) {
              category_id = categoryMap.size + 1
              categoryMap.set(category, category_id)

              await transactionManager.insert(Category, {
                id: category_id,
                name: category
              })
            }

            await transactionManager.createQueryBuilder()
              .relation(Product, 'categories')
              .of(product_id)
              .add(category_id)
          }
        }
      }
    }
  })
}

let building = false

export default function (): Plugin {
  return {
    name: 'Database Generator',
    async buildStart(): Promise<void> {
      await build()
    },
    async handleHotUpdate({ server }): Promise<void> {
      server.watcher.on('change', async (path) => {
        if (building || ! normalizePath(path).includes('database/menus')) {
          return
        }

        building = true

        await build()

        building = false
      })
    }
  }
}
