import { B as r } from "./form-420052dc.js"
document.querySelector(".logout")?.addEventListener("click", async () => {
	const e = await fetch("https://job-post.store/delete", { method: "DELETE", redirect: "follow" })
		window.location.href = 'https://job-post.store'
})
