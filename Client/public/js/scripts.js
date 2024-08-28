
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
    var habitacionesL = document.getElementById("habitacionesLista");
    var menu_title = document.getElementById("menu-title");
    var habitaciones = document.getElementById("habitaciones-menu");


    fetch(url)
        .then(response => response.text())
        .then(data => {
            habitacionesL.innerHTML = data;
            menu_title.style.display = "none";
            habitaciones.style.display = "none";
        })
        .catch(error => console.error('Error al cargar el contenido:', error));
}





function volverHabitaciones(tipo_habitacion){
    // alert("Volver a habitaciones" + tipo_habitacion);
    var habitacionesL = document.getElementById("habitacionesLista");
    var menu_title = document.getElementById("menu-title");
    var habitaciones = document.getElementById("habitaciones-menu");

    fetch('./Client/src/models/habitaciones.php?tipo_hab=' + tipo_habitacion)
        .then(response => response.text())
        .then(data => {
            habitacionesL.innerHTML = data;
            menu_title.style.display = "block";
            habitaciones.style.display = "block";
        })
        .catch(error => console.error('Error al cargar las habitaciones:', error));
}



function cargarForm(id_habitacion){

    cargarFormulario('./Client/src/models/reserva_habitacion.php?id_habitacion=' + id_habitacion);
}
















function OmitirPromocion() {

    document.getElementById("promocion-wrapper").style.display = "none";
    document.getElementById("promociones-disponibles").style.display = "none";
}



function MostrarPromocion() {
    var promocionId = document.getElementById("promocion").value;

    if (promocionId != 0) {
        // Realizar la solicitud AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./Client/src/controllers/detalle_promocion.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // console.log(xhr.responseText); 
        
                try {
                    var promocion = JSON.parse(xhr.responseText);
        
                    if (promocion.error) {
                        document.getElementById("promociones-disponibles").innerHTML = promocion.error;
                    } else {
                        // Mostrar los detalles de la promoción
                        var contenido = `
                            <div class='detalle_promocion'>
                                <div>
                                    <h2>Detalles de la promoción</h2>
                                    <p><strong>Tipo de Promoción:</strong> ${promocion.tipo_promocion}</p>
                                    <p><strong>Descuento:</strong> ${promocion.descuento}%</p>
                                    <p><strong>Descripción:</strong> ${promocion.descripcion}</p>
                                </div>
                                <div class="opciones-promo">
                                    <button type="button" class='btn_promo' 
                                        onclick="incluirPromocion(${promocion.descuento}, '${promocion.tipo_promocion.replace(/'/g, "\\'")}', ${promocion.id_promocion})">Aplicar promoción</button>
                                    <button type="button" class="cancelar-promo" onclick="cancelarPromocion()">Cancelar</button>
                                </div>
                            </div>
                        `;

                        document.getElementById("promociones-disponibles").innerHTML = contenido;
                    }
                } catch (e) {
                    console.error("Error procesando JSON: ", e);
                    console.error(xhr.responseText);
                    document.getElementById("promociones-disponibles").innerHTML = "Error al procesar la respuesta del servidor.";
                }
            }
        };

        xhr.send("id_promocion=" + promocionId);
    } else {
        document.getElementById("promociones-disponibles").innerHTML = "Selecciona una promoción válida.";
    }
}


function incluirPromocion(descuento, tipo_promocion, id_promocion) {
    
    let promocion = document.getElementById("id_promocion");
    let precio_hab = document.getElementById("precio_noche");
    precio_hab = parseInt(precio_hab.innerText);
    // alert("Precio de la habitación: " + (precio_hab));

    promocion.value = id_promocion;
    var precio_descuento = (precio_hab * descuento / 100);
    var total_descuento = precio_hab - precio_descuento;
    
    document.getElementById("detalle_promocion").innerText = tipo_promocion;
    document.getElementById("descuento_promo").innerText = descuento + "%";
    document.getElementById("precio_total_").innerHTML = `
    <strong>Su descuento es de: </strong> <span class="precio_descuento"> ${ precio_descuento}</span>Bs. <br>
    <strong class="total_descuento">Precio habitacion por descuento:</strong> <span class="total_descuento"> ${ total_descuento}</span>Bs.`;
}


function cancelarPromocion() {
    
    let precio_hab = document.getElementById("precio_noche");

    document.getElementById("promociones-disponibles").innerHTML = "<p id='mensaje-promocion'>Las promociones disponibles..</p>";
    document.getElementById("id_promocion").value = "";
    document.getElementById("descuento_promo").innerText = "0%";
    document.getElementById("detalle_promocion").innerText = "Ninguna";
    document.getElementById("precio_total_").innerHTML = `<strong>Precio por noche:</strong> <span>${precio_hab.innerText}</span>Bs.`;
}



//? PARA REGISTRAR LA RESERVA 


const registrarReserva = () => {

    var formulario = document.getElementById("formulario_reserva");
    var parametros = new FormData(formulario);
    // var contenido = document.getElementById("contenido");
    
    // console.log(parametros);
    
    if(confirm("¿Estás seguro de que quieres registrar esta reserva?")){

        fetch("./Client/src/controllers/registrar_reserva.php", { method: "POST", body: parametros })
        .then((response) => response.text())
        .then((data) => {
            // console.log(data);
            alert("La reserva fue registrada.");
            // contenido.innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
        });

    }
};



