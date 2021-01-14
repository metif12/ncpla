const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    theme: {
        extend: {
            fontFamily: {
                sans: ['Vazir', ...defaultTheme.fontFamily.sans],
                serif: ['Vazir', ...defaultTheme.fontFamily.serif],
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ['active'],
            opacity: ['disabled'],
        }
    },
    // purge: {
    //     content: [
    //         './app/**/*.php',
    //         './resources/**/*.html',
    //         './resources/**/*.js',
    //         './resources/**/*.jsx',
    //         './resources/**/*.ts',
    //         './resources/**/*.tsx',
    //         './resources/**/*.php',
    //         './resources/**/*.vue',
    //         './resources/**/*.twig',
    //     ],
    //     options: {
    //         defaultExtractor: (content) => content.match(/[\w-/.:]+(?<!:)/g) || [],
    //         whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
    //     },
    // },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};
