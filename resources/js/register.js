console.log("hello register")
const form = document.querySelector(".form")
const getFields = () => {
	const inputs = {}
	const fields = [...form.querySelectorAll(".field")]
	fields.map((item) => {
		inputs[item.name] = item.value
	})
	return inputs
}

form.addEventListener("submit", async (event) => {
	event.preventDefault()
	const fields = getFields()
	// await fetch("sanctum/csrf-cookie", {
	// 	credentials: "include",
	// 	headers: {
	// 		"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
	// 	},
	// })
	const request = await fetch("auth/register", {
		body: JSON.stringify(fields),
		method: "POST",
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
		},
		credentials: "include",
	})
	if (!request.ok) {
		const body = await request.json()
		console.log(body)
	}
})
