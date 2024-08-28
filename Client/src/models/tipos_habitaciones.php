<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   

    <title>Document</title>
</head>
<body>
    <h2 id="menu-title">Menú de Habitaciones</h2>
   
    <div class="habitaciones-menu" id="habitaciones-menu">
       <div class="menu-opcion"><a href="javascript:cargarHabitaciones('./Client/src/models/habitaciones.php?tipo_hab=Simple')">Simple</a></div>
       <div class="menu-opcion"><a href="javascript:cargarHabitaciones('./Client/src/models/habitaciones.php?tipo_hab=familiar')">Familiar</a></div>
       <div class="menu-opcion"><a href="javascript:cargarHabitaciones('./Client/src/models/habitaciones.php?tipo_hab=matrimonial')">Matrimonial</a></div> 
       <div class="menu-opcion"><a href="javascript:cargarHabitaciones('./Client/src/models/habitaciones.php?tipo_hab=especial')">Especial</a></div> 
      <!-- <div class="secciones"><a href="javascript:cargarPrincipal('./Client/src/views/inicio.html')">Inicio</a></div>-->
    </div>

    <div id="habitacionesLista" class="habitacionesLista">
    <!-- Aquí se cargarán las habitaciones -->
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
    background-color: #FFFFFF; /* Blanco */
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
    width: 100%;
    box-sizing: border-box;
}

/* Estilo para el menú de habitaciones */




.habitaciones-menu {
    display: flex; /* Esto asegura que los elementos estén en una fila */
    justify-content: center;
    margin: 0;
    padding: 0;
    background-color: #B0E0E6; /* Azul Pastel */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    box-sizing: border-box;
}


/* Estilo para cada opción del menú */
.menu-opcion {
    flex: 1;
    text-align: center;
}

/* Estilo para los enlaces del menú */
.menu-opcion a {
    text-decoration: none;
    color: #2c3e50;
    font-size: 18px;
    font-weight: 500;
    padding: 12px 25px;
    display: block;
    border-radius: 8px;
    transition: color 0.3s ease;
    background-color: transparent;
    font-weight: 700;
}

/* Cambia el color del texto en hover */
.menu-opcion a:hover {
    color: #FF7F50; /* Coral */
}

/* Estilo para la lista de habitaciones */
.habitacionesLista {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    margin-top: 20px;
    padding: 0 15px;
}

/* Estilo para cada ítem de habitación */
.habitacion-item {
    background-color: #FFF;
    border: 1px solid #D3D3D3;
    border-radius: 8px;
    padding: 20px;
    width: calc(50% - 120px); /* Ajuste del ancho de los ítems */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    box-sizing: border-box;
    margin-bottom: 20px;
}

/* Imagen en el recuadro de habitación */
.habitacion-item img {
    width: 100%;
    max-width: 700px;
    height: 300px;
    object-fit: cover;
    border-radius: 5px;
}

/* Estilo para los botones de acción */
.habitacion-actions {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

/* Botones de acción */
.habitacion-actions .boton_detalles a,
.habitacion-actions .boton_reserva a {
    color: #FFF;
    padding: 12px 20px;
    border-radius: 8px;
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease;
    font-weight: 700;
    font-size: 16px;
    display: block;
}

/* Botón de Ver Detalles */
.boton_detalles a {
    background: linear-gradient(to right, #B0E0E6, #FF7F50);
}

.boton_detalles a:hover {
            background: linear-gradient(to right, #FF7F50, #B0E0E6); 
        }

.boton_detalles a:hover {
    background-color: #D3D3D3;
    color: #6e6666;
}

/* Botón de Reservar Ahora */
.boton_reserva a {
    background: linear-gradient(to right, #FF7F50, #B0E0E6);
}

.boton_reserva a:hover {
            background: linear-gradient(to left, #FF7F50, #B0E0E6); 
        }

.boton_reserva a:hover {
    background-color: #D3D3D3;
    color: #6e6666;
}


</style>