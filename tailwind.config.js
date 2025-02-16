import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            screens: {
                'desktop': '840px',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins', 'sans-serif']
            },
            colors: {
                primary: '#FF6B2C',
                secondary: '#7521FF',
                third: '#4CD7FF',
                danger: '#FF2C39',
                dark: '#0E0140',
            }
        },
    },

    plugins: [forms],
};
