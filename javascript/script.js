document.addEventListener("DOMContentLoaded", () => {
	// BARRAS DE PROGRESO
	// Barra 1
	let campoContrasena = document.getElementById("password")

	campoContrasena.addEventListener("input", () => {
		let contrasena = document.getElementById("password")
		let porcentaje = (contrasena.value.length / 20) * 100

		document.querySelector(".progress-bar").style.width = porcentaje + "%"

		let progressBar = document.querySelector(".progress-bar")

		if (contrasena !== '') {
			if (validarContrasena(contrasena)) {
				progressBar.classList.remove("bg-danger", "bg-warning");
				if (validarContrasenaConEspecial(contrasena) || porcentaje >= 70) {
					progressBar.classList.add("bg-success")
				} else {
					progressBar.classList.add("bg-warning")
				}
			} else {
				progressBar.classList.remove("bg-warning", "bg-success")
				progressBar.classList.add("bg-danger")
			}
		} else {
			progressBar.classList.remove("bg-warning", "bg-success")
			progressBar.classList.add("bg-danger")
		}
	})

	// Barra 2
	let campoContraRepe = document.getElementById('inputPasswordRepeat')

	campoContraRepe.addEventListener('input', () => {
		let contrasenaRepetida = document.getElementById("inputPasswordRepeat").value
		let contrasena = document.getElementById("password").value

		if (contrasenaRepetida === contrasena && contrasenaRepetida != '') {
			document.getElementById('second-bar').classList.remove('bg-danger')
			document.getElementById('second-bar').classList.add('bg-success')
		} else {
			document.getElementById('second-bar').classList.remove('bg-success')
			document.getElementById('second-bar').classList.add('bg-danger')
		}
	})

	// CHECKEO DE USUARIO Y CONTRASENA
	let loginForm = document.getElementById('loginForm')

	loginForm.addEventListener("submit", (event) => {
		let contrasena = document.getElementById("password")
		let mensajeErrorContra = document.getElementById('passwordErrorMessage')

		let usuario = document.getElementById('username')
		let mensajeErrorUser = document.getElementById('userErrorMessage')

		let correo = document.getElementById('email')
		let mensajeErrorCorreo = document.getElementById('emailErrorMessage')

		let error = false

		console.log(contrasena.value)

		if (!validarContrasena(contrasena)) {
			error = true
			mensajeErrorContra.classList.remove("d-none")
		} else {
			mensajeErrorContra.classList.add("d-none")
		}

		if (usuario.value.length < 3) {
			error = true
			mensajeErrorUser.classList.remove("d-none")
		} else {
			mensajeErrorUser.classList.add("d-none")
		}

		if (!validarCorreo(correo)) {
			error = true
			mensajeErrorCorreo.classList.remove('d-none')
		} else {
			mensajeErrorCorreo.classList.add('d-none')
		}

		if (error) {
			event.preventDefault()
		}
	})

	

	// MODO OSCURO

	/*let darkMode = document.getElementById("dark-mode")
  
	darkMode.addEventListener("click", () => {
	  let changeText = document.querySelector("#dark-mode")
	  let html = document.getElementById('html')
	  if (html.getAttribute('data-bs-theme') === "dark") {
		html.setAttribute('data-bs-theme', 'light')
		changeText.textContent = "Modo oscuro"
	  } else {
		html.setAttribute('data-bs-theme', 'dark')
		changeText.textContent = "Modo claro"
	  }
	})*/
})

function validarContrasena(contrasena) {
	let regularExpression = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,20}$/

	if (!regularExpression.test(contrasena.value)) {
		return false
	} else {
		return true
	}
}

function validarContrasenaConEspecial(contrasena) {
	let regularExpression = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+{}|:<>?~\-=[\]\\;',./]).{8,20}$/

	if (!regularExpression.test(contrasena.value)) {
		return false
	} else {
		return true
	}
}

function validarCorreo(correo) {
	let regularExpression = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/

	if (!regularExpression.test(correo.value)) {
		return false
	} else {
		return true
	}
}
