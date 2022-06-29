import { groupBy, singular } from '../util.js'
import { database } from './connection.js'

/**
 * @param {IModel} parent
 * @returns {number}
 */
function getModelId(parent) {
    return parent.id
}

/**
 * Resolves a one-to-many relationship.
 *
 * It also works when passing an array of parent models, resolving the one-to-many
 * relationship for each one of them.
 *
 * @param {object|object[]} models
 * @param {string} parent
 * @param {string} relationship
 * @returns {Promise<void>}
 */
export async function hasMany(models, parent, relationship) {
    if (!Array.isArray(models)) {
        models = [models]
    }

    const table = relationship
    const parentKey = `${parent}_id`

    const ids = models.map(getModelId)

    const children = groupBy(
        await database(table).whereIn(parentKey, ids),
        (child) => child[parentKey]
    )

    models.forEach((parent) => {
        parent[relationship] = children[getModelId(parent)] ?? []
    })
}

/**
 * Resolves a many-to-many relationship.
 *
 * It also works when passing an array of parent models, resolving the many-to-many
 * relationship for each one of them.
 *
 * @param {object|object[]} models
 * @param {string} parent
 * @param {string} relationship
 * @returns {Promise<void>}
 */
export async function belongsToMany(models, parent, relationship) {
    if (!Array.isArray(models)) {
        models = [models]
    }

    const related = singular(relationship)

    const relatedTable = relationship
    const relatedKey = `${relatedTable}.id`

    const inverseParentKey = `pivot_${parent}_id`

    const pivotTable = [parent, related].sort().join('_')
    const parentPivotKey = `${pivotTable}.${parent}_id`
    const relatedPivotKey = `${pivotTable}.${related}_id`

    const ids = models.map(getModelId)

    const children = groupBy(
        await database(relatedTable)
            .select(`${relatedTable}.*`, { [inverseParentKey]: parentPivotKey })
            .innerJoin(pivotTable, relatedKey, relatedPivotKey)
            .whereIn(parentPivotKey, ids),
        (child) => child[inverseParentKey]
    )

    models.forEach((parent) => {
        parent[relationship] = children[getModelId(parent)] ?? []
    })
}
