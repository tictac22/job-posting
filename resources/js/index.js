document.querySelector("#form__search").addEventListener("submit", (event) => {
	event.preventDefault()

	const searchValue = event.target.querySelector("#input__search").value
	const url = new URL(window.location.href)
	url.searchParams.set("search", searchValue)
	window.location.href = url
})
document.querySelectorAll(".tag__item").forEach((item) => {
	item.addEventListener("keypress", (event) => {
		if (event.key === "Enter") {
			console.log(event.key)
			event.target.click()
		}
	})
	item.addEventListener("click", (event) => {
		const tagValue = item.getAttribute("data-value")
		const url = new URL(window.location.href)
		url.searchParams.set("tag", tagValue)
		window.location.href = url
	})
})
