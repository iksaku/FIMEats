const mix = require('laravel-mix')
const path = require('path')
require('laravel-mix-purgecss')

mix
    .babelConfig({
        plugins: [
            '@babel/plugin-syntax-dynamic-import'
        ]
    })
    .webpackConfig({
        output: {
            chunkFilename: 'js/[name].js?id=[chunkhash]'
        },
        resolve: {
            alias: {
                vue$: 'vue/dist/vue.runtime.esm.js',
                '@': path.resolve('resources/js')
            }
        }
    })

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/ziggy.js', 'public/js')
    .postCss('resources/styles/app.pcss', 'public/css', [
        require('postcss-nested'),
        require('tailwindcss')
    ])
    .purgeCss()
    .version()
    .sourceMaps()
