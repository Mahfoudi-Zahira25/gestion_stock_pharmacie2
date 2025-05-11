const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
// tailwind.config.js
// module.exports = {
//   theme: {
//     extend: {
//       colors: {
//         primaire: '#1F2937', // couleur personnalisée (ex : gris foncé)
//         secondaire: '#10B981', // vert émeraude
//       },
//     },
//   },
// }