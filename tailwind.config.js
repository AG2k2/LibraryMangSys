/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'scrollthumb' : '#a79065',
                'bgcolor-950' : '#DCBE87',
                'bgcolor-900' : '#ecddbf',
                'bgcolor-850' : '#ddc392',
                'bgcolor-800' : '#f4ead9',
                'bgcolor-700' : '#eee1c9',
            },
            fontFamily: {
                'appfont': 'comic sans ms',
            },
            boxShadow: {
                'bookDescShadow' : 'shadow'
            },
            rotate: {
                '-4' : '-4deg',
            }
        },
    },
    plugins: [
        require('tailwind-scrollbar')({ nocompatible: true }),
    ],
}
