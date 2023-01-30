document.querySelector("#form__search").addEventListener("submit", (event) => {
	event.preventDefault()

	const searchValue = event.target.querySelector("#input__search").value
	const url = new URL(window.location.href)
	url.searchParams.set("search", searchValue)
	window.location.href = url
})
