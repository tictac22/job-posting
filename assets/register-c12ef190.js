import { B as r, F as m, m as t } from "./form-420052dc.js"
import "./modulepreload-polyfill-ec808ebb.js"
const o = document.querySelector(".form"),
	i = ["name", "email", "password", "confirm"],
	c = t
		.object({
			name: t
				.string()
				.min(2, "name length has to between 2 and 255")
				.max(255, "name length has to between 2 and 255"),
			password: t
				.string()
				.min(5, "password length has to between 5 and 255")
				.max(255, "password length has to between 5 and 255"),
			email: t.string().email(),
			confirm: t.string().min(5, "at least 5 characters").max(255, "max 255 characters"),
		})
		.superRefine(({ confirm: s, password: a }, e) => {
			s !== a && e.addIssue({ code: "custom", message: "The passwords did not match", path: ["confirm"] })
		})
o.addEventListener("submit", async (s) => {
	s.preventDefault()
	const a = new m(o, i, c)
	a.validate()
	const e = await fetch("https://job-post.store/register", { body: new FormData(o), method: "POST", redirect: "follow" })
	console.log(e)
	if (!e.ok) {
		console.log("oooosss")
		const n = await e.json()
		a.setErrors(n)
	}
	if (e.redirected) {
		window.location.href = e.url
	}
})

