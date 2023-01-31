document.querySelectorAll(".popup__delete").forEach((item) => {
	item.addEventListener("click", (event) => {
		const parent = item.closest(".parent")
		const popup = parent.querySelector(".popup")
		popup.classList.add("popup__show")
	})
})

document.querySelectorAll(".popup__close").forEach((item) => {
	item.addEventListener("click", (event) => {
		const parent = item.closest(".parent")
		const popup = parent.querySelector(".popup")
		popup.classList.remove("popup__show")
	})
})

document.querySelectorAll(".popup__confirm").forEach((item) => {
	item.addEventListener("click", async (event) => {
		const id = event.target.getAttribute("data-value")
		item.disabled = true
		item.querySelector(".button-text").style.display = "none"
		item.querySelector(".loader").style.display = "block"
		// const request = await fetch("/delete", {
		// 	method: "DELETE",
		// 	body: JSON.stringify({ id }),
		// 	headers: {
		// 		"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
		// 	},
		// })
		// if (!request.ok) {
		// 	const body = await request.json()
		// 	console.log(body)
		// 	throw new HandlerError("invalid request", body)
		// }
		location.reload()
	})
})
