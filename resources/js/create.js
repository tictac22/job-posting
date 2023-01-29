import { z } from "zod"
import { HandlerError } from "./utils/CustomErrors.js"
import { Form } from "./utils/form.js"
const form = document.querySelector(".form")
const schemaForm2 = z.object({
	company_name: z.string().max(255).min(2, "name at least 2 characters"),
	job_title: z.string().max(255).min(2, "lastname at least 2 characters"),
	location: z.string().max(255).min(2, "lastname at least 2 characters"),
	tags: z.string().max(255).min(2, "lastname at least 2 characters"),
	logo: z.string().min(10, "expected image"),
	description: z.string().max(255).min(2, "lastname at least 2 characters"),
})
const schemaForm = z.object({})
const formHandle = new Form(form, schemaForm)

form.addEventListener("submit", async (event) => {
	event.preventDefault()

	formHandle.sendRequest(async (data) => {
		const request = await fetch("/create", {
			method: "POST",
			body: new FormData(form),
			headers: {
				"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
			},
		})
		if (!request.ok) {
			const body = await request.json()
			console.log(body)
			throw new HandlerError("invalid request", body)
		}
		window.location.href = request.url
	})

	// await fetch("sanctum/csrf-cookie", {
	// 	credentials: "include",
	// 	headers: {
	// 		"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
	// 	},
	// })
	// formHandle.sendRequest(async (formFields) => {
	// 	const request = await fetch("auth/login", {
	// 		body: formFields,
	// 		method: "POST",
	// 		headers: {
	// 			"Content-Type": "application/json",
	// 			"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
	// 		},
	// 		credentials: "include",
	// 		redirect: "follow",
	// 	})
	// 	if (!request.ok) {
	// 		const body = await request.json()
	// 		console.log(body)
	// 		throw new HandlerError("invalid request", body)
	// 	}
	// 	window.location.href = request.url
	// })
})

form.querySelector("textarea").onkeyup = function (event) {
	const button = form.querySelector("button")
	form.querySelector("[data-attr='hint']").innerHTML = 255 - this.value.length + " characters left"

	console.log(this.value.length)
	if (this.value.length === 255) {
		button.classList.add("disabled")
		button.disabled = true
	} else {
		button.classList.remove("disabled")
		button.disabled = false
	}
}
