function cargarContenido(abrir) {
  var contenido = document.getElementById("contenido");

  fetch(abrir)
    .then((response) => response.text())
    .then((data) => {
      contenido.innerHTML = data;
    });
}

// Para cargar las reservas
function cargarReservas(abrir) {
  var contenido = document.getElementById("reserva-contenido");

  fetch(abrir)
    .then((response) => response.text())
    .then((data) => {
      contenido.innerHTML = data;
    });
}
