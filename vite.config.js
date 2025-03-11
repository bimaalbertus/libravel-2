import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        host: "libravel-2.test",
        hmr: {
            protocol: "wss",
            host: "libravel-2.test",
            watch: {
                usePolling: true,
            },
        },
    },
});
