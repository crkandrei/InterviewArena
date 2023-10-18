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
            colors: {
                'blue-footer' : '#003D75',
                'muddy-white' : '#FFFCFA',
                'blue-welcome': '#3598F3',
                'blue-button': '#1789FC', // custom blue color
                'yellow-button': '#FDB833', // custom yellow color
                'color-1' : '#FCCAA2'
            },
        },
    },

    plugins: [forms],
};
