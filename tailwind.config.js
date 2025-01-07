import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./vendor/awcodes/palette/resources/views/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                "product-sans": ["Product Sans", "sans-serif"],
                "sf-pro-display": ["SF Pro Display", "sans-serif"],
                "euclid-circular-b": ["Euclid Circular B", "sans-serif"],
                figtree: ["Figtree", "sans-serif"],
                "afacad-flux": ["Afacad Flux", "sans-serif"],
                subjectivity: ["Subjectivity", "sans-serif"],
                "dela-gothic-one": ["Dela Gothic One", "serif"],
                fenix: ["Fenix", "serif"],
            },
        },
    },
    plugins: [],
};
