import { FormValidaiton } from "./CustomErrors"

export class Form {
	constructor(form, schema) {
		this.schema = schema
		this.form = form
	}
	getFields() {
		const inputs = {}
		const fields = [...this.form.querySelectorAll(".field")]
		fields.map((item) => {
			if (item?.files) {
				inputs[item.name] = item.files[0] ?? item.dataset.value
			} else {
				inputs[item.name] = item.value
			}
		})
		return inputs
	}
	async validate() {
		const fields = this.getFields()
		try {
			this.schema.parse(fields)
		} catch (error) {
			throw new FormValidaiton("invalid form", error.issues)
		}
	}
	async sendRequest(cb) {
		this.clearErrors()
		try {
			this.form.querySelector("button").disabled = true
			this.form.querySelector(".button-text").style.display = "none"
			this.form.querySelector(".loader").style.display = "block"
			await this.validate()
			await cb(JSON.stringify(this.getFields()))
		} catch (error) {
			if (error instanceof FormValidaiton) {
				this.setErrors(error.body)
			} else {
				this.setBackendErrors(error.body)
			}
			this.form.querySelector("button").disabled = false
			this.form.querySelector(".button-text").style.display = "block"
			this.form.querySelector(".loader").style.display = "none"
		}
	}
	clearErrors() {
		for (const property in this.getFields()) {
			const input = this.form.querySelector(`#${property}`)
			input.classList.remove("input__error")
			input.nextElementSibling.classList.remove("label__error")
			input.nextElementSibling.nextElementSibling.classList.remove("text__error")
		}
	}
	setErrors(body) {
		console.log(body)
		body.forEach((item) => {
			const input = this.form.querySelector(`#${item.path[0]}`)
			this.addError(input)

			input.nextElementSibling.nextElementSibling.innerText = item.message
		})
	}
	setBackendErrors(body) {
		for (const key in body) {
			const input = this.form.querySelector(`#${key}`)
			this.addError(input)

			input.nextElementSibling.nextElementSibling.innerText = body[key]
		}
	}
	addError(input) {
		input.classList.add("input__error")
		input.nextElementSibling.classList.add("label__error")
		input.nextElementSibling.nextElementSibling.classList.add("text__error")
	}
}
