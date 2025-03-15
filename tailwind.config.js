import defaultTheme from "tailwindcss/defaultTheme";
import preset from "./vendor/filament/filament/tailwind.config.preset";

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/masmerise/livewire-toaster/resources/views/*.blade.php",
        "./vendor/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./vendor/awcodes/palette/resources/views/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: "class",
    theme: {
        extend: {
            animation: {
                "infinite-scroll": "infinite-scroll 25s linear infinite",
                "infinite-scroll-backward":
                    "infinite-scroll-backward 25s linear infinite",
                "text-reveal":
                    "text-reveal 1.5s cubic-bezier(0.77, 0, 0.175, 1)",
            },
            keyframes: {
                "infinite-scroll": {
                    from: { transform: "translateX(0)" },
                    to: { transform: "translateX(-100%)" },
                },
                "infinite-scroll-backward": {
                    from: { transform: "translateX(-100%)" },
                    to: { transform: "translateX(0)" },
                },
                "text-reveal": {
                    "0%": {
                        transform: "translate(0, 100%)",
                    },
                    "100%": {
                        transform: "translate(0, 0)",
                    },
                },
            },
            fontFamily: {
                "product-sans": ["Product Sans", "sans-serif"],
                "sf-pro-display": ["SF Pro Display", "sans-serif"],
                "euclid-circular-b": ["Euclid Circular B", "sans-serif"],
                figtree: ["Figtree", "sans-serif"],
                "afacad-flux": ["Afacad Flux", "sans-serif"],
                subjectivity: ["Subjectivity", "sans-serif"],
                "dela-gothic-one": ["Dela Gothic One", "serif"],
                fenix: ["Fenix", "serif"],
                "albert-sans": ["Albert Sans", "serif"],
                "jersey-15": ["'Jersey 15'", "serif"],
                manrope: ["Manrope", "sans-serif"],
                "natural-precision": ["Natural Precision", "sans-serif"],
                lovan: ["Lovan", "sans-serif"],
                geist: ["Geist", "serif"],
            },
            colors: {
                light: {
                    primary: {
                        DEFAULT: "#B89C7D",
                        variant: "#D4BFA6",
                    },
                    secondary: {
                        DEFAULT: "#8CA6BD",
                        variant: "#B1C6D8",
                    },
                    accent: {
                        primary: "#E8986A",
                        secondary: "#64C5AA",
                    },
                    bg: {
                        primary: "#F7F3EB",
                        secondary: "#EDE6DA",
                        tertiary: "#FBFAF7",
                    },
                    text: {
                        primary: "#2B2924",
                        secondary: "#5F5B52",
                        tertiary: "#8E8A80",
                    },
                    btn: {
                        primary: "#7A5D3F",
                        secondary: "#E9E2D6",
                        tertiary: "#F7F3EB",
                    },
                },

                dark: {
                    primary: {
                        DEFAULT: "#7A5D3F",
                        variant: "#9B7B5B",
                    },
                    secondary: {
                        DEFAULT: "#465A69",
                        variant: "#6A8197",
                    },
                    accent: {
                        primary: "#C76D43",
                        secondary: "#3E8C75",
                    },
                    bg: {
                        primary: "#1A1814",
                        secondary: "#252220",
                        tertiary: "#302D29",
                    },
                    text: {
                        primary: "#F5EBE2",
                        secondary: "#CBC3B6",
                        tertiary: "#9A9287",
                    },
                    btn: {
                        primary: "#B89C7D",
                        secondary: "#38342E",
                        tertiary: "#1A1814",
                    },
                },
            },
            typography: (theme) => ({
                light: {
                    css: {
                        color: theme("colors.light.text.primary"),
                        a: {
                            color: "rgb(59, 130, 246)",
                            "&:hover": {
                                opacity: "0.7",
                            },
                        },
                        h1: { color: theme("colors.light.text.primary") },
                        h2: { color: theme("colors.light.text.primary") },
                        h3: { color: theme("colors.light.text.primary") },
                        em: { color: theme("colors.light.text.primary") },
                        del: { color: theme("colors.light.text.primary") },
                        span: { color: theme("colors.light.text.primary") },
                        blockquote: {
                            color: theme("colors.light.text.secondary"),
                            borderLeftColor: theme(
                                "colors.light.primary.DEFAULT"
                            ),
                            backgroundColor: "rgb(232, 152, 106, 0.2)",
                            fontSize: "16px",
                            padding: "10px",
                        },
                        strong: { color: theme("colors.light.text.primary") },
                        code: {
                            backgroundColor: theme("colors.light.bg.secondary"),
                        },
                    },
                },
                dark: {
                    css: {
                        color: theme("colors.dark.text.primary"),
                        a: {
                            color: "rgb(59, 130, 246)",
                            "&:hover": {
                                opacity: "0.7",
                            },
                        },
                        h1: { color: theme("colors.dark.text.primary") },
                        h2: { color: theme("colors.dark.text.primary") },
                        h3: { color: theme("colors.dark.text.primary") },
                        em: { color: theme("colors.dark.text.primary") },
                        del: { color: theme("colors.dark.text.primary") },
                        span: { color: theme("colors.dark.text.primary") },
                        blockquote: {
                            color: theme("colors.dark.text.secondary"),
                            borderLeftColor: theme(
                                "colors.dark.primary.DEFAULT"
                            ),
                            backgroundColor: "rgb(154, 156, 125, 0.3)",
                            fontSize: "16px",
                            padding: "10px",
                        },
                        strong: { color: theme("colors.dark.text.primary") },
                        code: {
                            backgroundColor: theme("colors.dark.bg.secondary"),
                        },
                    },
                },
            }),
        },
    },
    plugins: [require("@tailwindcss/typography")],
};

// alternate pallete
/** light: {
                    primary: {
                        DEFAULT: "#5E5CE6", // Ungu-biru lebih netral
                        variant: "#7B7AEF", // Ungu-biru lebih terang
                    },
                    secondary: {
                        DEFAULT: "#FF7D60", // Coral netral
                        variant: "#FF9983", // Coral lebih terang
                    },
                    accent: {
                        primary: "#FF9773", // Peach/coral
                        secondary: "#3DD5B0", // Teal netral
                    },
                    bg: {
                        primary: "#FAFAFA", // Putih netral
                        secondary: "#F5F5F7", // Abu-abu sangat terang
                        tertiary: "#FFFFFF", // Putih murni
                    },
                    text: {
                        primary: "#1F1F1F", // Hitam netral
                        secondary: "#4D4D4D", // Abu-abu gelap netral
                        tertiary: "#808080", // Abu-abu medium netral
                    },
                    btn: {
                        primary: "#5E5CE6", // Sama dengan primary
                        secondary: "#F5F5F7", // Abu-abu sangat terang
                        tertiary: "#FAFAFA", // Putih netral
                    },
                },

                dark: {
                    primary: {
                        DEFAULT: "#6D6AEF", // Ungu-biru terang
                        variant: "#8A88F2", // Ungu-biru sangat terang
                    },
                    secondary: {
                        DEFAULT: "#FF8D73", // Coral terang
                        variant: "#FFAB98", // Coral sangat terang
                    },
                    accent: {
                        primary: "#FFA78C", // Peach terang
                        secondary: "#4EEAC0", // Teal terang
                    },
                    bg: {
                        primary: "#121212", // Hitam netral
                        secondary: "#1E1E1E", // Abu-abu sangat gelap
                        tertiary: "#2A2A2A", // Abu-abu gelap
                    },
                    text: {
                        primary: "#F5F5F5", // Putih netral
                        secondary: "#D4D4D4", // Abu-abu terang
                        tertiary: "#9E9E9E", // Abu-abu medium
                    },
                    btn: {
                        primary: "#6D6AEF", // Sama dengan primary
                        secondary: "#1E1E1E", // Abu-abu sangat gelap
                        tertiary: "#121212", // Hitam netral
                    },
                },
 */
