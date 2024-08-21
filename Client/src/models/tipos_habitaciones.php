<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   

    <title>Document</title>
</head>
<body>
    <h2>Menú de Habitaciones</h2>
   
    <div class="habitaciones-menu">
       <div class="menu-opcion"><a href="javascript:cargarHabitaciones('./Client/src/models/habitaciones.php?tipo_hab=Simple')">Simple</a></div>
       <div class="menu-opcion"><a href="javascript:cargarHabitaciones('./Client/src/models/habitaciones.php?tipo_hab=familiar')">Familiar</a></div>
       <div class="menu-opcion"><a href="javascript:cargarHabitaciones('./Client/src/models/habitaciones.php?tipo_hab=matrimonial')">Matrimonial</a></div> 
       <div class="menu-opcion"><a href="javascript:cargarHabitaciones('./Client/src/models/habitaciones.php?tipo_hab=especial')">Especial</a></div> 
      <!-- <div class="secciones"><a href="javascript:cargarPrincipal('./Client/src/views/inicio.html')">Inicio</a></div>-->
    </div>

    <div id="habitacionesLista" class="habitacionesLista">
    <!-- Aquí se cargarán las habitaciones según el tipo seleccionado -->
    </div>
   
   

</body>
</html>

<style>
    
html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    overflow-x: hidden;
}

body {
    font-family: 'Roboto', sans-serif; 
    background-color:blanco; 
    color: #333;
}

/* Estilo para el encabezado */
h2 {
    text-align: center;
    margin: 0;
    font-size: 24px;
    color: #37393B;
    font-family: 'Roboto', sans-serif;
    background-color: #EAF1F1; /* Azul Pastel */
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%; /* Asegura que el h2 ocupe todo el ancho */
    box-sizing: border-box; /* Incluye padding y border en el ancho total */
}

/* Asegura que el menú ocupe todo el ancho de la pantalla */
.habitaciones-menu {
    display: flex;
    justify-content: center;
    margin: 0;
    padding: 0;
    list-style-type: none;
    background-color: #B0E0E6; /* Azul Pastel */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%; /* Asegura que el menú ocupe todo el ancho */
    box-sizing: border-box; /* Incluye padding y border en el ancho total */
}

/* Asegura que cada opción en el menú ocupe un espacio flexible */
.menu-opcion {
    flex: 1; /* Esto asegura que las opciones ocupen el espacio disponible */
    text-align: center;
}

/* Asegura que el enlace en cada opción del menú ocupe todo el espacio de su contenedor */
.menu-opcion a {
    text-decoration: none; /* Elimina el subrayado */
    color: #2c3e50; /* Color de texto inicial */
    font-size: 18px;
    font-weight: 500;
    padding: 12px 25px;
    display: block;
    border-radius: 8px;
    transition: color 0.3s ease;
    background-color: transparent; /* Fondo transparente */
    font-weight: 700;
}

/* Cambia el color del texto en hover */
.menu-opcion a:hover {
    color: #FF7F50; /* Coral */
}

/* Opcional para mejorar la visualización de los enlaces en dispositivos móviles */
@media (max-width: 768px) {
    .menu-opcion a {
        padding: 12px 15px;
        font-size: 16px;
    }
}

/* Estilo para la lista de habitaciones */
.habitacionesLista {
    display: flex;
    flex-direction: column; /* Cambia la dirección a columna */
    align-items: center; /* Centra los elementos horizontalmente */
    margin-top: 20px;
    padding: 0 15px; /* Agrega un poco de espacio a los lados */
}

/* Estilo para cada ítem de habitación */
.habitacion-item {
    background-color: #FFF;
    border: 1px solid #D3D3D3;
    border-radius: 8px;
    margin: 15px 0; /* Espacio vertical entre recuadros */
    padding: 20px;
    width: 90%; /* Más ancho */
    max-width: 800px; /* Ancho máximo más amplio */
    height: auto; /* Ajusta la altura automáticamente */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Imagen en el recuadro de habitación */
.habitacion-item img {
    width: 100%; /* Ajusta el ancho al 100% del contenedor */
    max-width: 700px; /* Limita el ancho máximo de la imagen */
    height: 300px; /* Establece una altura fija para la imagen */
    object-fit: cover; /* Ajusta la imagen para cubrir el contenedor sin deformarla */
    border-radius: 5px;
}

/* Detalles de la habitación */
.habitacion-detalle {
    margin-top: 10px;
}

.habitacion-detalle h3 {
    font-size: 22px;
    color: #FF7F50; /* Coral para el título */
    margin-bottom: 10px;
}

.habitacion-detalle p {
    font-size: 16px;
    color: #000; /* Negro para la descripción */
    margin-bottom: 10px;
}

/* Estilo para los botones de acción */
.habitacion-actions {
    display: flex;
    flex-direction: column; /* Los botones estarán uno debajo del otro */
    align-items: center;
    margin-top: 15px;
}

.habitacion-actions .boton_detalles a,
.habitacion-actions .boton_reserva a {
    color: #FFF; /* Texto en blanco */
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease;
    font-weight: 700; /* Letra más gruesa (negrilla) */
    font-size: 16px;
    margin: 5px;
    display: block;
}

/* Botón de Ver Detalles */
.boton_detalles a {
    background: linear-gradient(to right, #B0E0E6, #FF7F50); /* Mezcla de celeste y coral */
}

.boton_detalles a:hover {
    background-color: #D3D3D3; /* Gris claro */
    color: #6e6666; /* Gris oscuro para el texto */
}

/* Botón de Reservar Ahora */
.boton_reserva a {
    background: linear-gradient(to right, #FF7F50, #B0E0E6); /* Mezcla de coral y celeste */
}

.boton_reserva a:hover {
    background-color: #D3D3D3; /* Gris claro */
    color: #6e6666; /* Gris oscuro para el texto */
}

/* Cambiar color y estilo para Capacidad, Precio y Estado */
.habitacion-item .detalle-item {
    color: #B0E0E6; /* Celeste */
    font-weight: 700; /* Letra más gruesa (negrilla) */
}

</style>