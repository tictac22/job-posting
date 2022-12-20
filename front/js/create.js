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
