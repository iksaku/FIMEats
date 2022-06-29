import { database } from '../lib/database/connection.js'

export async function get() {
    const faculties = await database('faculties').orderByRaw('`short_name` = ? desc', ['FIME'])

    await Promise.all(
        faculties.map(async (faculty) => {
            faculty.logo = `/logos/${faculty.short_name.toLowerCase()}.png`
        })
    )

    return {
        body: {
            faculties
        }
    }
}
