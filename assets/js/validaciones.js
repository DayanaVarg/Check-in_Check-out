function comprobarCodigo() {
	var cod = document.getElementById("cod").value;
	var mensajeError = document.getElementById("mensajeError");

	if (cod !== "15D49") {
		mensajeError.innerHTML =  "El codigo de acceso es incorrecto.";
		return false;
	} else {
		mensajeError.innerHTML = "";
		return true;
	}
}

function mostrarMotivo() {
	var rol = document.getElementById("rol").value;
	var reason = document.getElementById("reason");

	if (rol === "2") {
		reason.style.display = "block";
	} else {
		reason.style.display = "none";
	}
}


