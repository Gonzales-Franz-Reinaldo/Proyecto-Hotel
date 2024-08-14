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


// PARA CONFIRMAR LA RESERVA POR CORREO 
function confirmarReserva(reservaId) {
  if (confirm("¿Estás seguro de que quieres confirmar esta reserva?")) {
      fetch(`../../src/Controllers/confirmar_reserva.php?id=${reservaId}`, {
          method: 'GET',
      })
      .then(response => response.json())
      .then(data => {

        // cargarReservas('./reservas_recientes.php')
          if (data.success) {
              alert('Reserva confirmada y correo enviado.');
              // location.reload(); 
          } else {
              alert('Hubo un error al confirmar la reserva.');
          }
      })
      .catch(error => console.error('Error:', error));
  }
}



function rechazarReserva(reservaId) {
  if (confirm("¿Estás seguro de que quieres rechazar esta reserva?")) {
      fetch(`../../src/Controllers/rechazar_reserva.php?id=${reservaId}`, {
          method: 'GET',
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              // location.reload(); 
          } else {
              alert('La reserva fue rechazada.');
          }
      })
      .catch(error => console.error('Error:', error));
  }
}


