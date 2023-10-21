import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            display: ['responsive'],
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                raleway: ['Raleway', 'sans-serif']
            },
            boxShadow: {
                'custom': '0px 4px 4px 0px rgba(0, 0, 0, 0.30)'
            },
            colors: {
                'yellow': '#EFBA00',
                'blue-footer' : '#003D75',
                'muddy-white' : '#F8F8F8',
                'blue-welcome': '#3598F3',
                'blue-button': '#1789FC',
                'yellow-button': '#FDB833',
                'color-1' : '#FCCAA2'
            },
        },
    },

    plugins: [forms],
};
