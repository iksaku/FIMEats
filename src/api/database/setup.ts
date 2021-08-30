import {createConnection, getConnection} from "typeorm"
import 'reflect-metadata'
import sqljs from 'sql.js'
import sqlite from 'sql.js/dist/sql-wasm.wasm?url'
import database_url from './database.sqlite?url'
import {models} from "@/api/models";

const database_storage_key = 'database'

async function setup(): Promise<void> {
  // @ts-ignore
  window.SQL = await sqljs({
    locateFile: () => sqlite
  })

  await createConnection({
    type: 'sqljs',
    autoSave: true,
    location: database_storage_key,
    entities: models,

    logging: true,
    logger: 'advanced-console',
  })

  await importDatabase()
}

async function importDatabase(): Promise<void> {
  if (
    import.meta.env.MODE === 'production'
    && localStorage.getItem(database_storage_key) !== null
  ) {
    return
  }

  const databaseStream = await fetch(database_url)
  const database = new Uint8Array(await databaseStream.arrayBuffer())
  await getConnection().sqljsManager.loadDatabase(database)
}

await setup()
