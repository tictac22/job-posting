document.querySelector(".logout")?.addEventListener("click", async () => {
	const e = await fetch("https://usebluecollar.xyz/delete", { method: "DELETE", redirect: "follow" })
	window.location.href = "https://usebluecollar.xyz"
})

