import { HandlerError } from "./utils/CustomErrors.js"
import { Form } from "./utils/form.js"
import { baseForm } from "./utils/zod.js"
const form = document.querySelector(".form")

const schemaForm = baseForm
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
		const request = await fetch("auth/login", {
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
			console.log(body)
			throw new HandlerError("invalid request", body)
		}
		window.location.href = request.url
	})
})

const sleep = (ms = 1000) => new Promise((resolve, reject) => setTimeout(() => resolve(), ms))
