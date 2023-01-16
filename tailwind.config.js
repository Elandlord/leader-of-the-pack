module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'lotp-blue': {
                    '500': '#2C84BF',
                    '600': '#2677AD'
                }
            }
        },
        fontFamily: {
            sans: ['Bree Serif', 'sans-serif'],
            heading: ['Ahsing', 'sans-serif']
        }
    },
    plugins: [],
}
