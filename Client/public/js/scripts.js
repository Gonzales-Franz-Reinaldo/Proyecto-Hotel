
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



