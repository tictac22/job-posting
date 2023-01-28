import { z } from "zod"

function containsUppercase(str) {
	return /[A-Z]/.test(str)
}
function containsLowerCase(str) {
	return /[a-z]/.test(str)
}
export const baseForm = z.object({
	email: z.string().email(),
	password: z
		.string()
		.min(8, "at least 8 characters")
		.refine((val) => containsUppercase(val), "Password has to contain one uppercase and one lowercase letter")
		.refine((val) => containsLowerCase(val), "Password has to contain one uppercase and one lowercase letter"),
})
