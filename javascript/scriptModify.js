document.addEventListener("DOMContentLoaded", () => {
    //checkeo de contraseña en
    let loginForm = document.getElementById("loginForm")

    loginForm.addEventListener("submit", (event) => {
        let contrasena = document.getElementById("password")
		let mensajeErrorContra = document.getElementById('passwordErrorMessage')
        let error = false

        if (!validarContrasena(contrasena)) {
			// esto evita que se envíe el formulario
			error = true
			mensajeErrorContra.classList.remove("d-none")
		} else {
			mensajeErrorContra.classList.add("d-none")
		}

        if (error) {
			event.preventDefault()
		}
    })
})

function validarContrasena(contrasena) {
	let regularExpression = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,20}$/

	if (!regularExpression.test(contrasena.value)) {
		console.log('false')
		return false
	} else {
		console.log('true')
		return true
	}
}