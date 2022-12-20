import "../scss/create.scss"

const button = document.querySelector(".form__button")

document.querySelector(".input__descrp").onkeyup = function () {
	document.querySelector(".form__input--hint").innerHTML = 255 - this.value.length + " characters left"

	console.log(this.value.length)
	if (this.value.length === 255) {
		button.classList.add("disabled")
		button.disabled = true
	} else {
		button.classList.remove("disabled")
		button.disabled = false
	}
}

import { z } from "zod"
import { BASE_URL } from "./config"
import { Form } from "./form.js"

const formQuery = document.querySelector(".form")
const fields = ["name", "title", "location", "tags", "image"]

const formSchema = z.object({
	name: z.string().min(5, "at least 5 characters").max(255, "company name length has to between 5 and 255"),
	title: z.string().min(5, "at least 5 characters").max(255, "company title length has to between 5 and 255"),
	location: z.string().min(5, "at least 5 characters").max(255, "location  length has to between 5 and 255"),
	decsr: z.string().min(5, "at least 5 characters").max(255, "description  length has to between 5 and 255"),
	tags: z.string().min(2, "at least 2 characters").max(255, "tagslength has to between 2 and 255"),
	image: z.instanceof(File, "expected image"),
})

formQuery.addEventListener("submit", async (e) => {
	e.preventDefault()
	const form = new Form(formQuery, fields, formSchema)
	try {
		form.validate()
		const response = await fetch(BASE_URL + "/create", {
			body: new FormData(formQuery),
			method: "POST",
		})
		const data = await response.json()
		console.log(data)
	} catch (error) {}
})
