import { F as m, m as o } from "./form-420052dc.js"
import "./modulepreload-polyfill-ec808ebb.js"
const t = document.querySelector(".form"),
	i = ["email", "password"],
	c = o.object({
		password: o
			.string()
			.min(5, "password length has to between 5 and 255")
			.max(255, "password length has to between 5 and 255"),
		email: o.string().email(),
	})
t.addEventListener("submit", async (r) => {
	r.preventDefault()
	const s = new m(t, i, c)
	try {
		s.validate()
		const e = await fetch("https://usebluecollar.xyz/signin", { body: new FormData(t), method: "POST" })
		if (!e.ok) {
			const n = await e.json()
			s.setErrors(n)
		}
		if (e.redirected) {
			window.location.href = e.url
		}
	} catch (e) {
		console.log(e.message)
	}
})
