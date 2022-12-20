export class Form {
	form
	fields
	formSchema
	constructor(form, fields, formSchema) {
		;(this.form = form), (this.fields = fields), (this.formSchema = formSchema)
	}
	getFields() {
		const inputs = {}
		this.fields.map((item) => {
			const input = this.form.querySelector(`input[name=${item}]`)
			inputs[input.name] = input.value
		})
		return inputs
	}
	validate() {
		this.clearErrors()
		const fields = this.getFields()

		try {
			this.formSchema.parse(fields)
		} catch (error) {
			this.formatErrors(error.issues)
			throw new Error(error)
		}
	}
	clearErrors() {
		this.fields.map((item) => {
			this.form.querySelector(`input[name=${item}]`).classList.remove("form__error--show")
		})
	}
	formatErrors(errors) {
		console.log(errors)
		errors.forEach((element) => {
			let inputName = element.path[0]
			const input =
				this.form.querySelector(`input[name=${inputName}]`) ||
				this.form.querySelector(`textarea[name=${inputName}]`)
			input.classList.add("form__error--show")

			input.parentNode.querySelector(".form__error").innerHTML = element.message
		})
	}
}
