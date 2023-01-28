import { z } from "zod"
import { HandlerError } from "./CustomErrors.js"
import { Form } from "./form.js"
const form = document.querySelector(".form")
function containsUppercase(str) {
	return /[A-Z]/.test(str)
}

const schemaForm = z
	.object({
		name: z.string().max(255).min(2, "name at least 2 characters"),
		lastname: z.string().max(255).min(2, "lastname at least 2 characters"),
		email: z.string().email(),
		password: z
			.string()
			.min(8, "at least 8 characters")
			.refine((val) => containsUppercase(val), "Password has to contain one uppercase letter"),
		password_confirmation: z.string(),
	})
	.refine((data) => data.password === data.password_confirmation, {
		message: "Passwords don't match",
		path: ["password_confirmation"], // path of error
	})
const formHandle = new Form(form, schemaForm)

form.addEventListener("submit", async (event) => {
	event.preventDefault()
	// await fetch("sanctum/csrf-cookie", {
	// 	credentials: "include",
	// 	headers: {
	// 		"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
	// 	},
	// })
	formHandle.sendRequest(async (formFields) => {
		const request = await fetch("auth/register", {
			body: formFields,
			method: "POST",
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
			},
			credentials: "include",
			redirect: "follow",
		})
		if (!request.ok) {
			const body = await request.json()
			throw new HandlerError("invalid request", body)
		}
		window.location.href = request.url
	})
})

const sleep = (ms = 1000) => new Promise((resolve, reject) => setTimeout(() => resolve(), ms))
