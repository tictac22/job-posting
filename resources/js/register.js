console.log("hello register")

document.querySelector(".form").addEventListener("submit", async (event) => {
	event.preventDefault()

	const request = await fetch("api/register")
})
