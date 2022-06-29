import knex from 'knex'
import fs from 'fs/promises'
import path from 'path'

const database_path = path.resolve('./src/lib/database/database.sqlite')

/**
 * @type {import('knex').Knex.Config}
 */
const config = {
    client: 'better-sqlite3',
    useNullAsDefault: true,
    connection: {
        filename: database_path
    }
}

/**
 * @type {import('knex').Knex}
 */
export let database = knex(config)

export async function refreshDatabase() {
    await database.destroy()

    try {
        await fs.unlink(database_path)
    } catch {
        // File doesn't exist
    }

    database = knex(config)
}
