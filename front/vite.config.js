import { defineConfig } from "vite"

import { resolve } from "path"
export default defineConfig({
	build: {
		rollupOptions: {
			input: {
				main: resolve(__dirname, "index.html"),
				register: resolve(__dirname, "register.html"),
				manage: resolve(__dirname, "manage.html"),
				login: resolve(__dirname, "login.html"),
				job: resolve(__dirname, "job.html"),
				create: resolve(__dirname, "register.html"),
			},
		},
	},
})
