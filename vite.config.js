import laravel from "laravel-vite-plugin"
import { defineConfig } from "vite"

export default defineConfig({
	plugins: [
		laravel({
			input: [
				"resources/css/app.css",
				"resources/js/app.js",
				"resources/js/register.js",
				"resources/css/fontawesome.min.css",
				"resources/css/solid.min.css",
			],
			refresh: true,
		}),
	],
})
