import preset from "../../../../vendor/filament/filament/tailwind.config.preset";

export default {
    presets: [preset],
    content: [
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
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
};
