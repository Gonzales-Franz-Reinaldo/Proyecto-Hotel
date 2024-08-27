
function cargarContenido(promocion) {
    var contenido = document.getElementById("contenido");

    fetch(promocion)
        .then(response => response.text())
        .then(data => {
            contenido.innerHTML = data;
        })
        .catch(error => console.error('Error al cargar el contenido:', error));
}


function cargarPrincipal(url) {
    var contenido = document.getElementById("contenido");

    fetch(url)
        .then(response => response.text())
        .then(data => {
            contenido.innerHTML = data;
        })
        .catch(error => console.error('Error al cargar el contenido:', error));
}

function toggleRolesMenu() {
    var menu = document.getElementById("rolesMenu");
    if (menu.style.display === "block") {
        menu.style.display = "none";
    } else {
        menu.style.display = "block";
    }
}

function cargarDetalles(url) {
    var contenido = document.getElementById("contenido");

    fetch(url)
        .then(response => response.text())
        .then(data => {
            contenido.innerHTML = data;
        })
        .catch(error => console.error('Error al cargar el contenido:', error));
}


function cargarConsultas(consulta) {
    var contenido = document.getElementById("contenido");

    fetch(consulta)
        .then(response => response.text())
        .then(data => {
            contenido.innerHTML = data;
        })
        .catch(error => console.error('Error al cargar el contenido:', error));
}

document.addEventListener('DOMContentLoaded', function() {
    // Manejo de los enlaces "Ver Detalles"
    document.querySelectorAll('.promotion-actions .boton_detalles a').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var url = this.getAttribute('href');
            cargarDetalles(url);
        });
    });

    // Manejo de los enlaces "Consultar"
    document.querySelectorAll('.promotion-actions .boton_consulta a').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var url = this.getAttribute('href');
            cargarConsultas(url);
        });
    });
});

window.onscroll = function() {
    var encabezado = document.querySelector('.container-encabezado');
    var sticky = encabezado.offsetTop;

    if (window.pageYOffset > sticky) {
        encabezado.classList.add('fixed');
    } else {
        encabezado.classList.remove('fixed');
    }
};

function cargarInicioHabitaciones(url) {
    var habitaciones = document.getElementById("contenido");

    fetch(url)
        .then(response => response.text())
        .then(data => {
            habitaciones.innerHTML = data;
        })
        .catch(error => console.error('Error al cargar las habitaciones:', error));
}

function cargarHabitaciones(url) {
    var habitacionesL = document.getElementById("habitacionesLista");

    fetch(url)
        .then(response => response.text())
        .then(data => {
            habitacionesL.innerHTML = data;
        })
        .catch(error => console.error('Error al cargar las habitaciones:', error));
}

function cargarDescripcionesH(url) {
    var habitacionesL = document.getElementById("habitacionesLista");

    fetch(url)
        .then(response => response.text())
        .then(data => {
            habitacionesL.innerHTML = data;
        })
        .catch(error => console.error('Error al cargar el contenido:', error));
}

function cargarFormulario(url) {
    var habitacionesL = document.getElementById("contenido");

    fetch(url)
        .then(response => response.text())
        .then(data => {
            habitacionesL.innerHTML = data;
        })
        .catch(error => console.error('Error al cargar el contenido:', error));
}


// document.addEventListener('DOMContentLoaded', () => {
//     const promocionSelect = document.getElementById('promocion');
//     const precioNocheElem = document.getElementById('precio_noche');
//     const precioTotalElem = document.getElementById('precio_total');
//     const detallePromocionElem = document.getElementById('detalle_promocion');

//     promocionSelect.addEventListener('change', () => {
//         const selectedOption = promocionSelect.options[promocionSelect.selectedIndex];
//         const descuento = parseFloat(selectedOption.getAttribute('data-descuento')) || 0;
//         const precioNoche = parseFloat(precioNocheElem.textContent);
//         let precioTotal = precioNoche;

//         if (descuento > 0) {
//             precioTotal = precioNoche - (precioNoche * (descuento / 100));
//             detallePromocionElem.textContent = selectedOption.textContent;
//         } else {
//             detallePromocionElem.textContent = 'Ninguna';
//         }

//         precioTotalElem.textContent = precioTotal.toFixed(2);
//     });
// });



/* document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.seleccionar-promocion').forEach(button => {
        button.addEventListener('click', () => {
            const promoId = button.getAttribute('data-id');
            const promoItem = button.closest('.promocion-item');
            
            // Actualizar el valor del radio button correspondiente
            document.querySelector(`input[name="id_promocion"][value="${promoId}"]`).checked = true;
            
            // Actualizar el detalle de la reserva
            const descripcion = promoItem.querySelector('p').innerText;
            const descuento = promoItem.querySelector('p:nth-of-type(2)').innerText;
            
            document.getElementById('descuento').innerText = descuento;
            // Calcula el nuevo total con descuento aplicado
            const precioPorNoche = parseFloat(document.getElementById('total-precio').innerText);
            const nuevoTotal = precioPorNoche - (precioPorNoche * parseFloat(descuento) / 100);
            document.getElementById('total-precio').innerText = nuevoTotal.toFixed(2);
        });
    });
});
 */


/* document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.seleccionar-promocion').forEach(button => {
        button.addEventListener('click', () => {
            const promoId = button.getAttribute('data-id');
            const promoItem = button.closest('.promocion-item');

            // Actualizar el valor del radio button correspondiente
            document.querySelector(`input[name="id_promocion"][value="${promoId}"]`).checked = true;

            // Actualizar el detalle de la reserva
            const descripcion = promoItem.querySelector('p').innerText;
            const descuento = promoItem.querySelector('p:nth-of-type(2)').innerText.replace('Descuento: ', '').replace('%', '');

            document.getElementById('descuento').innerText = descuento + '%';
            // Calcula el nuevo total con descuento aplicado
            const precioPorNoche = parseFloat(document.getElementById('total-precio').innerText);
            const nuevoTotal = precioPorNoche - (precioPorNoche * parseFloat(descuento) / 100);
            document.getElementById('total-precio').innerText = nuevoTotal.toFixed(2);
        });
    });
}); */


