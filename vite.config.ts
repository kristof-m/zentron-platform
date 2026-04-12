import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { globSync } from "node:fs";

export default defineConfig({
    plugins: [
        laravel({
            input: globSync("resources/**/*.{css,ts,js,png,jpg,svg}"),
            refresh: true,
        }),
    ],
    server: {
        watch: {
            ignored: ["**/storage/framework/views/**"],
        },
    },
});
