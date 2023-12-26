// Funcion para mostrar y ocultar contraseña
function toggleVisible() {
	const button = document.querySelector(".icono-ojo");
	const password = document.querySelector("#password");
	const atribute = password.getAttribute("type");

	if (atribute == "password") {
		password.setAttribute("type", "text");
		button.setAttribute("src", "./build/img/closed-eye.png");
		button.classList.add("icono-ojo-animacion");
	} else {
		password.setAttribute("type", "password");
		button.setAttribute("src", "./build/img/eye.png");
		button.classList.add("icono-ojo-animacion");
	}

	setTimeout(() => {
		button.classList.remove("icono-ojo-animacion");
	}, 100);
}

// Mostrar secciones en pagina de citas
let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
	id: "",
	nombre: "",
	fecha: "",
	hora: "",
	servicios: [],
};

document.addEventListener("DOMContentLoaded", function () {
	iniciarApp();
});

function iniciarApp() {
	mostrarSeccion(); // Muestra y oculta las secciones
	tabs(); // Cambia la sección cuando se presionen los tabs
	botonesPaginador(); // Agrega o quita los botones del paginador
	paginaSiguiente();
	paginaAnterior();

	consultarAPI(); // Consulta la API en el backend de PHP

	idCliente(); // Añade el id del cliente al objeto de cita
	nombreCliente(); // Añade el nombre del cliente al objeto de cita
	seleccionarFecha(); // Añade la fecha de la cita en el objeto de cita
	seleccionarHora(); // Añade la hora de la cita en el objeto
	mostrarResumen(); // Muestra el resumen de la cita
}

function mostrarSeccion() {
	// Ocultar la seccion que tenga la clase mostrar
	const seccionAnterior = document.querySelector(".mostrar");
	if (seccionAnterior) {
		seccionAnterior.classList.remove("mostrar");
	}
	// Seleccionar la sección con el paso
	const seccion = document.querySelector(`#paso-${paso}`);
	seccion.classList.add("mostrar");

	// Quita el tab anterior
	const tabAnterior = document.querySelector(".actual");
	if (tabAnterior) {
		tabAnterior.classList.remove("actual");
	}

	// Resalta el tab actual
	const tab = document.querySelector(`[data-paso="${paso}"]`);
	tab.classList.add("actual");
}

function tabs() {
	const botones = document.querySelectorAll(".tabs button");
	botones.forEach((boton) => {
		boton.addEventListener("click", function (e) {
			paso = parseInt(e.target.dataset.paso);
			mostrarSeccion();
			botonesPaginador();
		});
	});
}

function botonesPaginador() {
	const paginaAnterior = document.querySelector("#anterior");
	const paginaSiguiente = document.querySelector("#siguiente");

	if (paso === 1) {
		paginaAnterior.classList.add("ocultar");
	} else if (paso === 3) {
		paginaAnterior.classList.remove("ocultar");
		paginaSiguiente.classList.add("ocultar");
		mostrarResumen(); // Este esta en caso de que haya alerta de resumen en otra seccion la elimina
	} else {
		paginaAnterior.classList.remove("ocultar");
		paginaSiguiente.classList.remove("ocultar");
	}
}

function paginaAnterior() {
	const paginaAnterior = document.querySelector("#anterior");

	paginaAnterior.addEventListener("click", function () {
		if (paso <= pasoInicial) return;
		paso--;
		botonesPaginador();
		mostrarSeccion();
	});
}

function paginaSiguiente() {
	const paginaSiguiente = document.querySelector("#siguiente");

	paginaSiguiente.addEventListener("click", function () {
		if (paso >= pasoFinal) return;
		paso++;
		botonesPaginador();
		mostrarSeccion();
	});
}

// Consumir API y mostrar los servicios
async function consultarAPI() {
	try {
		const url = "http://localhost:8001/api/services";
		const resultado = await fetch(url);
		const servicios = await resultado.json();
		mostrarServicios(servicios);
	} catch (error) {
		console.log(error);
	}
}

function mostrarServicios(servicios) {
	servicios.forEach((servicio) => {
		const { id, nombre, precio } = servicio;
		const nombreServicio = document.createElement("P");
		nombreServicio.classList.add("nombre-servicio");
		nombreServicio.textContent = nombre;

		const precioServicio = document.createElement("P");
		precioServicio.classList.add("precio-servicio");
		precioServicio.textContent = `$${precio}`;

		const servicioDiv = document.createElement("DIV");
		servicioDiv.classList.add("servicio");
		servicioDiv.dataset.idServicio = id;
		servicioDiv.appendChild(nombreServicio);
		servicioDiv.appendChild(precioServicio);

		servicioDiv.onclick = function () {
			seleccionarServicio(servicio);
		};

		document.querySelector("#servicios").appendChild(servicioDiv);
	});
}

function seleccionarServicio(servicio) {
	const { id } = servicio;
	const { servicios } = cita;

	// Identifica el elemento al que se le da click
	const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

	// Comprobar si el servicio fue agregado
	if (servicios.some((agregado) => agregado.id === id)) {
		// Eliminarlo
		cita.servicios = servicios.filter((agregado) => agregado.id !== id); // Crea un nuevo arreglo con los servicios que sean diferentes al id del servicio que se esta deseleccionando
		divServicio.classList.remove("seleccionado");
	} else {
		// Agregarlo
		cita.servicios = [...servicios, servicio];
		divServicio.classList.add("seleccionado");
	}
}

function nombreCliente() {
	const nombre = document.querySelector("#nombre").value;
	cita.nombre = nombre;
}

function idCliente() {
	const id = document.querySelector("#id").value;
	cita.id = id;
}

function seleccionarFecha() {
	const inputFecha = document.querySelector("#fecha");
	inputFecha.addEventListener("input", function (e) {
		const dia = new Date(e.target.value).getUTCDay();
		if ([6, 0].includes(dia)) {
			e.target.value = "";
			mostrarAlerta(
				"Fines de semana no permitidos",
				"error",
				".formulario"
			);
		} else {
			cita.fecha = e.target.value;
		}
	});
}

function seleccionarHora() {
	const inputHora = document.querySelector("#hora");
	inputHora.addEventListener("input", function (e) {
		const horaCita = e.target.value;
		const hora = horaCita.split(":")[0];
		if (hora < 10 || hora > 18) {
			mostrarAlerta("Hora no válida", "error", ".formulario");
			cita.hora = "";
		} else {
			cita.hora = e.target.value;
		}
	});
}

function mostrarAlerta(mensaje, tipo, elemento, remover = true) {
	// Previene mas de una alerta
	const alertaPrevia = document.querySelector(".alerta");
	if (alertaPrevia) {
		alertaPrevia.remove();
	}

	// Creación de la alerta
	const alerta = document.createElement("DIV");
	alerta.textContent = mensaje;
	alerta.classList.add("alerta");
	alerta.classList.add(tipo);

	const referencia = document.querySelector(elemento);
	referencia.appendChild(alerta);
	// referencia.insertAdjacentElement("beforebegin", alerta);

	if (remover) {
		// Elimina la alerta
		setTimeout(() => {
			alerta.remove();
		}, 5000);
	}
}

function mostrarResumen() {
	const resumen = document.querySelector(".contenido-resumen");

	// Limpiar contenido resumen
	while (resumen.firstChild) {
		resumen.removeChild(resumen.firstChild);
	}

	if (Object.values(cita).includes("") || cita.servicios.length === 0) {
		mostrarAlerta(
			"Faltan datos o seleccionar algun servicio",
			"error",
			"#paso-3",
			false
		);

		return;
	}

	// Formatear div de resumen
	const { nombre, fecha, hora, servicios } = cita;

	// Titulo para servicios en resumen
	const tituloServicios = document.createElement("H3");
	tituloServicios.textContent = "Resumen de servicios";

	resumen.appendChild(tituloServicios);

	// Muestra los servicios
	servicios.forEach((servicio) => {
		const { id, precio, nombre } = servicio;
		const contenedorServicio = document.createElement("DIV");
		contenedorServicio.classList.add("contenedor-servicio");

		const textoServicio = document.createElement("P");
		textoServicio.textContent = nombre;

		const precioServicio = document.createElement("P");
		precioServicio.innerHTML = `<span>Precio: </span> $${precio}`;

		contenedorServicio.appendChild(textoServicio);
		contenedorServicio.appendChild(precioServicio);

		resumen.appendChild(contenedorServicio);
	});

	const tituloCita = document.createElement("H3");
	tituloCita.textContent = "Resumen de la cita";

	resumen.appendChild(tituloCita);

	const nombreCliente = document.createElement("P");
	nombreCliente.innerHTML = `<span>Nombre: </span>${nombre}`;

	// Formatear fecha
	const fechaObj = new Date(fecha);
	const mes = fechaObj.getMonth();
	const dia = fechaObj.getDate() + 2; // getDate retorna el numero y getDay el dia de la semana
	const year = fechaObj.getFullYear();

	const fechaUTC = new Date(Date.UTC(year, mes, dia));

	const opciones = {
		weekday: "long",
		year: "numeric",
		month: "long",
		day: "numeric",
	};

	const fechaFormateada = fechaUTC.toLocaleDateString("es-MX", opciones);

	const fechaCita = document.createElement("P");
	fechaCita.innerHTML = `<span>Fecha: </span>${fechaFormateada}`;

	const horaCita = document.createElement("P");
	horaCita.innerHTML = `<span>Hora: </span>${hora}`;

	// Boton para crear una cita
	const botonReservar = document.createElement("BUTTON");
	botonReservar.classList.add("boton");
	botonReservar.textContent = "Reservar cita";
	botonReservar.onclick = reservarCita;

	resumen.appendChild(nombreCliente);
	resumen.appendChild(fechaCita);
	resumen.appendChild(horaCita);

	resumen.appendChild(botonReservar);
}

async function reservarCita() {
	const { id, fecha, hora, servicios } = cita;

	const idServicios = servicios.map((servicio) => servicio.id);

	const datos = new FormData();
	datos.append("id_usuario", id);
	datos.append("fecha", fecha);
	datos.append("hora", hora);
	datos.append("servicios", idServicios);

	try {
		// Petición hacia la API
		const url = `${location.origin}/api/appointments`;

		const respuesta = await fetch(url, {
			method: "POST",
			body: datos,
			// mode: 'cors' En caso de que queramos hacer peticiones de otro dispositivo
		});

		Swal.fire({
			icon: "success",
			title: "Cita creada!",
			text: "Tu cita fue agendada correctamente.",
			// footer: '<a href="#">Why do I have this issue?</a>',
		}).then(() => {
			window.location.reload();
		});
	} catch (error) {
		Swal.fire({
			icon: "error",
			title: "Error",
			text: "Hubo un error al agendar la cita!",
		});
	}
}
