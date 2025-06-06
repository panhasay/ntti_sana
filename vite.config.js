import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { fileURLToPath, URL } from "node:url";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    build: {
        outDir: "public/build",
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name.endsWith(".css")) {
                        return "css/ntti-app-[hash].css";
                    }
                    if (assetInfo.name.endsWith(".js")) {
                        return "js/ntti-app-[hash].js";
                    }
                    if (
                        assetInfo.name.match(/\.(png|jpe?g|gif|svg|webp|bmp)$/)
                    ) {
                        return "images/[name]-[hash][extname]";
                    }
                    if (assetInfo.name.match(/\.(woff|woff2|ttf|otf|eot)$/)) {
                        return "fonts/[name]-[hash][extname]";
                    }
                    return "assets/[name][extname]";
                },
                entryFileNames: (chunkInfo) => {
                    return `js/ntti-app-[hash].js`;
                },
                chunkFileNames: (chunkInfo) => {
                    return `js/ntti-app-[hash].js`;
                },
            }
        },
    },
    resolve: {
        alias: {
            "@public": fileURLToPath(new URL("./public", import.meta.url))
        },
    },
});
