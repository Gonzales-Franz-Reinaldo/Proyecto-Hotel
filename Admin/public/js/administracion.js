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
    cargarReservas("../../src/models/reservas_recientes.php");
  }
}

//? PARA RECHAZAR LA RESERVA
function rechazarReserva(id) {
  var contenido = document.getElementById("reserva-contenido");

  if (confirm("¿Estás seguro de que quieres rechazar esta reserva?")) {
    fetch(`../../src/controllers/rechazar_reserva.php?id=${id}`)
      .then((response) => response.text())
      .then((data) => {
        contenido.innerHTML = data;
      });

    alert("Reserva rechazada.");
    cargarReservas("../../src/models/reservas_recientes.php");
  }
}

// PARA GENERAR LA FACTURA DE LA RESERVA
function generarFactura(id_reserva) {
  var contenido = document.getElementById("reserva-contenido");

  if (confirm("¿Desea generar la factura para este cliente?")) {
    fetch(`../../src/controllers/generar_factura.php?id_reserva=${id_reserva}`)
      .then((response) => response.text())
      .then((data) => {
        contenido.innerHTML = data;
      });

    alert("Factura generada.");
    cargarReservas("../../src/models/historial_reserva.php");
  }
}


function visualizarFactura(id_reserva) {
  
  var contenido = document.getElementById("reserva-contenido"); 

  fetch(`../../src/models/factura_pagos.php?id_reserva=${id_reserva}`)
  .then((response) => response.text())
  .then((data) => {
    contenido.innerHTML = data;
  })
  .catch((error) => {
    console.error("Error al cargar la factura:", error);
  });
}



function printFactura() {
  // Obtén el contenido del div con id "factura-container"
  var facturaContent = document.getElementById("factura-container").innerHTML;

  // Crea una nueva ventana en blanco
  var printWindow = window.open("", "_blank", "width=800,height=600");

  // Escribe el contenido HTML en la nueva ventana
  printWindow.document.write(`
      <html>
      <head>
          <title>Imprimir Factura</title>
          <style>

              body {
                background-color: #f0f0f0;
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
              }
              .factura-container {
                  background-color: white;
                  padding: 20px;
                  border-radius: 8px;
                  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                  width: auto;
              }

              .factura-logo {
                  text-align: left;
              }

              .factura-logo .logo {
                  width: 70px;
                  height: 70px;
              }

              .factura-header {
                  text-align: center;
                  margin-bottom: 20px;
              }

              .factura-header h1 {
                  font-size: 32px;
                  color: #333;
              }

              .factura-header p {
                  margin: 5px 0;
                  font-size: 14px;
                  color: #666;
              }

              .factura-body {
                  border-top: 2px solid #007bff;
                  border-bottom: 2px solid #007bff;
                  padding: 20px 0;
                  margin-bottom: 20px;
              }

              .factura-body .factura-section {
                  margin-bottom: 20px;
              }

              .factura-body .factura-section h2 {
                  font-size: 18px;
                  color: #007bff;
                  margin-bottom: 10px;
                  border-bottom: 1px solid #ddd;
                  padding-bottom: 5px;
              }

              .factura-body .factura-section p {
                  font-size: 14px;
                  color: #333;
                  margin: 4px 0;
              }

              .factura-body .factura-section .factura-table {
                  width: 100%;
                  border-collapse: collapse;
                  margin-bottom: 20px;
              }

              .factura-body .factura-section .factura-table th,
              .factura-body .factura-section .factura-table td {
                  border: 1px solid #ddd;
                  padding: 8px;
                  text-align: left;
              }

              .factura-body .factura-section .factura-table th {
                  background-color: #f0f0f0;
                  font-size: 14px;
                  color: #333;
              }

              .factura-footer {
                  text-align: center;
                  padding-top: 10px;
                  border-top: 1px solid #ddd;
              }

              .factura-footer p {
                  font-size: 12px;
                  color: #666;
              }

              .factura-footer strong {
                  color: #333;
              }

          </style>
      </head>
      <body>
          ${facturaContent}
          <script>
              // Ejecuta el comando de impresión automáticamente
              window.print();
              // Cierra la ventana después de imprimir
              window.onafterprint = function() {
                  window.close();
              };
          </script>
      </body>
      </html>
  `);

  // Cierra la escritura para que la impresión se pueda iniciar
  printWindow.document.close();
}


function generatePDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF('p', 'mm', 'a4');

  // Selecciona el elemento que contiene la factura
  const content = document.getElementById('factura-container');

  // Aumenta la escala para mejorar la calidad
  html2canvas(content, { scale: 2 }).then((canvas) => {
      const imgData = canvas.toDataURL('image/png');

      // Calcular las dimensiones para ajustar a A4
      const imgWidth = 210; // Ancho de A4 en mm
      const pageHeight = 297; // Altura de A4 en mm
      const imgHeight = (canvas.height * imgWidth) / canvas.width;
      let heightLeft = imgHeight;

      let position = 0;

      // Añadir la imagen al PDF
      doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
      heightLeft -= pageHeight;

      // Si la imagen excede la altura de la página, agregar otra página
      while (heightLeft >= 0) {
          position = heightLeft - imgHeight;
          doc.addPage();
          doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
          heightLeft -= pageHeight;
      }

      // Guarda el PDF
      doc.save('factura_pago.pdf');
  }).catch((error) => {
      console.error('Error al generar el PDF', error);
  });
}






function realizarBusqueda(){
  var busqueda = document.getElementById("busquedaDatos").value;
  var fechaReserva = document.getElementById("fechaReserva").value;

  cargarReservas(`../../src/models/historial_reserva.php?busquedaGeneral=${busqueda}&fechaReserva=${fechaReserva}`);
  
}

const ordenarPorTipoHabitacion = () =>{
  var tipoHabitacion = document.getElementById("tipoHabitacion").value;
  
  cargarReservas(`../../src/models/historial_reserva.php?tipoHabitacion=${tipoHabitacion}`)
} 

const ordenarPorTipo = () =>{
  let ordenarTipo = document.getElementById("ordenarTipo").value;
  let tipoOrdenar = document.getElementsByClassName(`${ordenarTipo}`);
  var contenido = document.getElementById("reserva-contenido");

  fetch(`../../src/models/historial_reserva.php?ordenarTipo=${ordenarTipo}`)
    .then((response) => response.text())
    .then((data) => {

      contenido.innerHTML = data;
      // Iteramos sobre los elementos de tipoOrdenar
      for (let i = 0; i < tipoOrdenar.length; i++) {
        tipoOrdenar[i].style.color = "black";
        tipoOrdenar[i].style.fontWeight = "bold";
      }
    });

}


// PARA LAS RESERVAS RECIENTES 
function realizarBusqueda2(){
  var busqueda = document.getElementById("busquedaDatos").value;
  var fechaReserva = document.getElementById("fechaReserva").value;

  cargarReservas(`../../src/models/reservas_recientes.php?busquedaGeneral=${busqueda}&fechaReserva=${fechaReserva}`);
  
}
const ordenarPorTipoHabitacion2 = () =>{
  var tipoHabitacion = document.getElementById("tipoHabitacion").value;
  
  cargarReservas(`../../src/models/reservas_recientes.php?tipoHabitacion=${tipoHabitacion}`)
} 


const ordenarPorTipo2 = () =>{
  let ordenarTipo = document.getElementById("ordenarTipo").value;
  let tipoOrdenar = document.getElementsByClassName(`${ordenarTipo}`);
  var contenido = document.getElementById("reserva-contenido");

  fetch(`../../src/models/reservas_recientes.php?ordenarTipo=${ordenarTipo}`)
    .then((response) => response.text())
    .then((data) => {

      contenido.innerHTML = data;
      // Iteramos sobre los elementos de tipoOrdenar
      for (let i = 0; i < tipoOrdenar.length; i++) {
        tipoOrdenar[i].style.color = "black";
        tipoOrdenar[i].style.fontWeight = "bold";
      }
    });

}