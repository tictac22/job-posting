import { z } from "zod"
import { Form } from "./utils/form.js"
const form = document.querySelector(".form")
const schemaForm2 = z.object({
	company_name: z.string().max(255).min(2, "name at least 2 characters"),
	job_title: z.string().max(255).min(2, "lastname at least 2 characters"),
	location: z.string().max(255).min(2, "lastname at least 2 characters"),
	tags: z.string().max(255).min(2, "lastname at least 2 characters"),
	logo: z.any().refine((val) => {
		if (!val) return false
		return true
	}, "Logo is required"),
	description: z.string().max(255).min(2, "lastname at least 2 characters"),
})
const formHandle = new Form(form, schemaForm2)

form.addEventListener("submit", async (event) => {
	event.preventDefault()
	const formData = new FormData(form)
	if (formData.get("logo").size === 0) {
		formData.set("logo", form.querySelector("#logo").getAttribute("data-value"))
	}
	formData.append("postId", getIdFromUrl())
	formHandle.sendRequest(async (data) => {
		const request = await fetch("/edit", {
			method: "POST",
			body: formData,
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

document.querySelector("#logo").onchange = (evt) => {
	const [file] = evt.target.files
	if (file) {
		imagePreview.src = URL.createObjectURL(file)
		imagePreview.style.display = "block"
	}
}

document.querySelector("#logoLabel").addEventListener("keypress", (event) => {
	if (event.key === "Enter") {
		event.preventDefault()
		event.target.click()
	}
})

function getIdFromUrl() {
	let url = new URL(window.location.href)
	return url.pathname.split("/").at(-1)
}
