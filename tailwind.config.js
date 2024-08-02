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
            fontSize: {
              base: '14px',
            },
            colors: {
              primary: '#3498db',
              secondary: '#2ecc71',
              background: '#ecf0f1',
              text: '#2c3e50',
            },
            fontFamily: {
              base: ['Helvetica Neue', 'Arial', 'sans-serif'],
            },
            borderRadius: {
              base: '4px',
            },
            padding: {
              base: '14px',
            },
            margin: {
              base: '14px',
            },
        }
    },

    plugins: [forms],
    darkMode: 'class'
};
