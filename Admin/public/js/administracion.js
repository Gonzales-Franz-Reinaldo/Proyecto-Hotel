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


//? PARA CONFIRMAR LA RESERVA POR CORREO
function confirmarReserva(reservaId) {

  var contenido = document.getElementById("reserva-contenido");

  if (confirm("¿Estás seguro de que quieres confimar la reserva?")) {

    fetch(`../../src/controllers/confirmar_reserva.php?id=${reservaId}`)
      .then((response) => response.text())
      .then((data) => {
        contenido.innerHTML = data;
      });

      alert("Reserva confirmada.");
      cargarReservas('../../src/models/reservas_recientes.php');
      
  }
}

//? PARA RECHAZAR LA RESERVA POR CORREO
function rechazarReserva(id) {
  var contenido = document.getElementById("reserva-contenido");

  if (confirm("¿Estás seguro de que quieres rechazar esta reserva?")) {

    fetch(`../../src/controllers/rechazar_reserva.php?id=${id}`)
      .then((response) => response.text())
      .then((data) => {
        contenido.innerHTML = data;
      });

      alert("Reserva rechazada.");
      cargarReservas('../../src/models/reservas_recientes.php');
      
  }

}
