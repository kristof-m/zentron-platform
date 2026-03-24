import { defineConfig } from "vite";
import { resolve } from "node:path";
import { globSync } from "node:fs";

export default defineConfig({
  plugins: [],
  build: {
    rolldownOptions: {
      input: {
        ...globSync("**/*.html").reduce(
          (acc, file) => {
            if (file.startsWith("dist/") || file.startsWith("dist\\")) {
              return acc;
            }
            const key = file.replace(".html", "");
            acc[key] = resolve(import.meta.dirname, file);
            return acc;
          },
          {} as Record<string, string>,
        ),
      },
    },
  },
});
