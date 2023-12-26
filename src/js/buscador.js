document.addEventListener("DOMContentLoaded", function () {
	iniciarApp();
});

function iniciarApp() {
	buscarPorFechar();
}

function buscarPorFechar() {
	const fechaInput = document.querySelector("#fecha");
	fechaInput.addEventListener("input", function (e) {
		const fechaSeleccionada = e.target.value;
		console.log(fechaSeleccionada);
		window.location = `?fecha=${fechaSeleccionada}`;
	});
}
