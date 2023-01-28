export class HandlerError extends Error {
	constructor(message, body) {
		super(message)
		this.body = body
	}
}
export class FormValidaiton extends Error {
	constructor(message, body) {
		super(message)
		this.body = body
	}
}
