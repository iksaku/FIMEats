import adapter from '@sveltejs/adapter-static'
import preprocess from 'svelte-preprocess'
import { imagetools } from 'vite-imagetools'
import DatabaseCompiler from './src/lib/database/compiler.js'
import path from 'path'

/** @type {import('@sveltejs/kit').Config} */
const config = {
    // Consult https://github.com/sveltejs/svelte-preprocess
    // for more information about preprocessors
    preprocess: preprocess(),

    kit: {
        adapter: adapter(),

        prerender: {
            default: true
        },

        vite: {
            resolve: {
                alias: {
                    $assets: path.resolve('./src/assets'),
                    $components: path.resolve('./src/components')
                }
            },
            plugins: [imagetools(), DatabaseCompiler()]
        }
    }
}

export default config
