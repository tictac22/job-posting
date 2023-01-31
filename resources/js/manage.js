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
		const formData = new FormData()
		formData.append("id", id)
		const request = await fetch("/delete", {
			method: "POST",
			body: formData,
			headers: {
				"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
			},
		})
		if (!request.ok) {
			const body = await request.json()
			console.log(body)
			item.disabled = false
			item.querySelector(".button-text").style.display = "block"
			item.querySelector(".loader").style.display = "none"
			throw new HandlerError("invalid request", body)
		}
		location.reload()
	})
})
