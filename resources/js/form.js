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
			inputs[item.name] = item.value
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
				console.log(error.body, "else")
			}
			this.form.querySelector("button").disabled = false
			this.form.querySelector(".button-text").style.display = "block"
			this.form.querySelector(".loader").style.display = "none"
		}
	}

	setErrors(body) {
		body.forEach((item) => {
			console.log(item)
			const input = this.form.querySelector(`#${item.path[0]}`)
			input.style.borderColor = "red"
			input.style.boxShadow = "none"
			input.nextElementSibling.style.color = "red"
			input.nextElementSibling.nextElementSibling.style.display = "block"
			input.nextElementSibling.nextElementSibling.innerText = item.message
		})
	}
}
