const mix = require('laravel-mix')
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
    .js('resources/js/alpine.js', 'public/js')
    .js('resources/js/fontawesome.js', 'public/js')
    .postCss('resources/styles/app.pcss', 'public/css', [
        require('postcss-nested'),
        require('tailwindcss')
    ])
    .sourceMaps()

if (mix.inProduction()) {
    mix
        .purgeCss()
        .version()
}
