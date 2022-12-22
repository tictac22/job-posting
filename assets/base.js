import { B as r } from "./form-420052dc.js"
document.querySelector(".logout")?.addEventListener("click", async () => {
	const e = await fetch(r + "/delete", { method: "DELETE", redirect: "follow" })
	if (!e.ok) {
		console.log("oooosss")
		const n = await e.json()
	}
	console.log(e)
	if (e.redirected) {
		window.location.href = e.url
	}
})
