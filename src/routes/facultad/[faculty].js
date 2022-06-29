import { database } from '../../lib/database/connection.js'
import { belongsToMany, hasMany } from '../../lib/database/relationships.js'
import { pluck } from '../../lib/util.js'

/** @type {import('./__types/[faculty]').RequestHandler} */
export async function get({ params }) {
    const faculty = await database('faculties').where('short_name', params.faculty).first()

    if (!faculty) {
        return {
            status: 404
        }
    }

    faculty.logo = `/logos/${faculty.short_name.toLowerCase()}.png`

    await hasMany(faculty, 'faculty', 'cafeterias')

    await hasMany(faculty.cafeterias, 'cafeteria', 'products')

    await belongsToMany(pluck(faculty.cafeterias, 'products'), 'product', 'categories')

    return {
        body: {
            faculty
        }
    }
}
