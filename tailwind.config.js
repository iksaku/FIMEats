module.exports = {
  mode: 'jit',

  purge: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],

  //darkMode: 'media',

  theme: {
    extend: {},
  },

  variants: {
    extend: {},
  },

  plugins: [require('@tailwindcss/forms'), require('@tailwindcss/aspect-ratio')],
}
