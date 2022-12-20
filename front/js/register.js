import { z } from "zod"
import "../scss/register.scss"
import { BASE_URL } from "./config"
import { Form } from "./form.js"

const formQuery = document.querySelector(".form")
const fields = ["name", "email", "password", "confirm"]

const formSchema = z
	.object({
		name: z
			.string()
			.min(2, "name length has to between 2 and 255")
			.max(255, "name length has to between 2 and 255"),
		password: z
			.string()
			.min(5, "password length has to between 5 and 255")
			.max(255, "password length has to between 5 and 255"),
		email: z.string().email(),
		confirm: z.string().min(5, "at least 5 characters").max(255, "max 255 characters"),
	})
	.superRefine(({ confirm, password }, ctx) => {
		if (confirm !== password) {
			ctx.addIssue({
				code: "custom",
				message: "The passwords did not match",
				path: ["confirm"],
			})
		}
	})

formQuery.addEventListener("submit", async (e) => {
	e.preventDefault()
	const form = new Form(formQuery, fields, formSchema)
	try {
		form.validate()
		const response = await fetch(BASE_URL + "/register", {
			body: new FormData(formQuery),
			method: "POST",
		})
		if (!response.ok) {
			const errors = await response.json()
			form.setErrors(errors)
		} else {
			const data = await response.json()
		}
	} catch (error) {
		console.log(error)
	}
})
