import.meta.glob(["../images/**", "../fonts/**"])

document.querySelector(".logout")?.addEventListener("click", async () => {
	const request = await fetch("auth/logout", {
		method: "POST",
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
		},
		credentials: "include",
		redirect: "follow",
	})
	if (!request.ok) {
		const body = await request.json()
		console.log(body)
		return
	}
	window.location.href = request.url
})

