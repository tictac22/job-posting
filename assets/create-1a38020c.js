import { B as k, F as i, m as e } from "./form-420052dc.js"
import "./modulepreload-polyfill-ec808ebb.js"
const a = document.querySelector(".form__button")
document.querySelector(".input__descrp").onkeyup = function () {
	;(document.querySelector(".form__input--hint").innerHTML = 255 - this.value.length + " characters left"),
		console.log(this.value.length),
		this.value.length === 255
			? (a.classList.add("disabled"), (a.disabled = !0))
			: (a.classList.remove("disabled"), (a.disabled = !1))
}
const n = document.querySelector(".form"),
	l = ["name", "title", "location", "tags", "image", "decsr"],
	m = e.object({
		name: e.string().min(5, "at least 5 characters").max(255, "company name length has to between 5 and 255"),
		title: e.string().min(5, "at least 5 characters").max(255, "company title length has to between 5 and 255"),
		location: e.string().min(5, "at least 5 characters").max(255, "location  length has to between 5 and 255"),
		decsr: e.string().min(5, "at least 5 characters").max(255, "description  length has to between 5 and 255"),
		tags: e.string().min(2, "at least 2 characters").max(255, "tagslength has to between 2 and 255"),
		image: e.string().min(10, "expected image"),
	})
n.addEventListener("submit", async (r) => {
	r.preventDefault()
	const s = new i(n, l, m)
	try {
		s.validate()
		a.classList.add("form--loading")
		a.disabled = true
		const t = await fetch(k + "/create", { body: new FormData(n), method: "POST", redirect: "follow" })
		console.log(t)
		if (!t.ok) {
			console.log("oooosss")
			const n = await t.json()
			s.setErrors(n)
		}
		if (t.redirected) {
			console.log("redireecece", t.url)
			window.location.href = t.url
		}
	} catch (e) {
		console.log(e.message)
	} finally {
		a.classList.remove("form--loading")
		a.disabled = false
	}
})

function sleep(ms) {
	return new Promise((resolve) => setTimeout(resolve, ms))
}

