/**
 * Group an array of objects related by the same key. Example:
 * From:
 *    [
 *        { name: 'Apple', type: 'Fruit' },
 *        { name: 'Pineapple', type: 'Fruit' },
 *        { name: 'Dog', type: 'Animal' }
 *    ]
 * To:
 *    {
 * 		Fruit: [
 * 		    { name: 'Apple', type: 'Fruit' },
 * 			{ name: 'Pineapple', type: 'Fruit' },
 * 		],
 *		Animal: [
 *		    { name: 'Dog', type: 'Animal' }
 *		]
 * 	}
 *
 * @param items
 * @param callback
 * @returns {object}
 */
export function groupBy(items, callback) {
    return items.reduce((groups, item) => {
        const key = callback(item)

        groups[key] ??= []
        groups[key].push(item)

        return groups
    }, {})
}

/**
 * @param {object[]} items
 * @param {string} key
 * @returns {*[]}
 */
export function pluck(items, key) {
    return items.map((item) => item[key]).flat(1)
}

/**
 * @param {string} word
 * @return {string}
 */
export function pluralize(word) {
    if (word.endsWith('s')) {
        return word
    }

    if (word.endsWith('y')) {
        return word.substring(0, word.length - 1) + 'ies'
    }

    return word + 's'
}

/**
 * @param {string} word
 * @returns {string}
 */
export function singular(word) {
    if (!word.endsWith('s')) {
        return word
    }

    if (word.endsWith('ies')) {
        return word.substring(0, word.length - 3) + 'y'
    }

    return word.substring(0, word.length - 1)
}
