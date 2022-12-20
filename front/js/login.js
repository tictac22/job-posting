import "../scss/login.scss"

import { z } from "zod"
import { BASE_URL } from "./config"
import { Form } from "./form.js"

const formQuery = document.querySelector(".form")
const fields = ["email", "password"]

const formSchema = z.object({
	password: z
		.string()
		.min(5, "password length has to between 5 and 255")
		.max(255, "password length has to between 5 and 255"),
	email: z.string().email(),
})

formQuery.addEventListener("submit", async (e) => {
	e.preventDefault()
	const form = new Form(formQuery, fields, formSchema)
	try {
		form.validate()
		const response = await fetch(BASE_URL + "/signin", {
			body: new FormData(formQuery),
			method: "POST",
		})
		if (!response.ok) {
			const errors = await response.json()
			form.setErrors(errors)
		} else {
			const data = await response.json()
		}
	} catch (error) {}
})
