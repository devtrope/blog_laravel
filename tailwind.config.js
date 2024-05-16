/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        fontFamily: {
            'display': ['Inter']
        },
        extend: {
            screens: {
                'xs': '400px',
                '3xl': '1920px'
            }
        },
    },
    plugins: [],
}

