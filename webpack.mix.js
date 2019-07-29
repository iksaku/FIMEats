const mix = require('laravel-mix')
const tailwind = require('tailwindcss')
require('laravel-mix-purgecss')

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
    .extract()
    .postCss('resources/styles/app.pcss', 'public/css', [
        tailwind()
    ])
    .purgeCss()

if (mix.inProduction())
    mix.version()
