module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'media',

    mode: 'jit',

    theme: {
        extend: {},
    },

    variants: {
        extend: {},
    },

    plugins: [],
}
