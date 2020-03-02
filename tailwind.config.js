const defaultVariants = require('tailwindcss/defaultConfig').variants

module.exports = {
    theme: {
        extend: {}
    },
    variants: {
        borderWidth: [...defaultVariants.borderWidth, 'first', 'last'],
        borderStyle: [...defaultVariants.borderStyle, 'first', 'last'],
        boxShadow: [...defaultVariants.boxShadow, 'hocus'],
        scale: [...defaultVariants.scale, 'hocus'],
        textDecoration: [...defaultVariants.textDecoration, 'hocus'],
        zIndex: [...defaultVariants.zIndex, 'hocus']
    },
    plugins: [
        function ({ addVariant, e }) {
            addVariant('hocus', ({ modifySelectors, separator}) => {
                modifySelectors(({ className }) => {
                    return `.${e(`hocus${separator}${className}`)}:hover,.${e(`hocus${separator}${className}`)}:focus`
                })
            })
        }
    ]
}
