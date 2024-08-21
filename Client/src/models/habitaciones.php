<?php
include '../../../Database/conexion.php';
//echo '<h1>HABITACIONES</h1>';
$tipo_hab = $_GET['tipo_hab'];

$query = "SELECT * FROM habitacion WHERE tipo_hab = '$tipo_hab'";
$result = $connect->query($query);

while ($row = $result->fetch_assoc()) {
    echo '<div class="habitacion-item">';
    echo '<img src="./Client/public/images/habitaciones/' . $row['foto'] . '" alt="Foto de la habitación">';
    echo '<div class="habitacion-detalle">';
    echo '<h3>Habitación ' . $row['num_habitacion'] . ' - Piso ' . $row['num_piso'] . '</h3>';
    echo '<p>' . $row['descripcion'] . '</p>';
    echo '<p>Capacidad: ' . $row['capacidad'] . ' personas</p>';
    echo '<p>Precio: $' . $row['precio'] . ' por noche</p>';
    echo '<p>Estado: ' . ucfirst($row['estado']) . '</p>';  // Muestra el estado de la habitación
    echo '<div class="habitacion-actions">';
    echo '<div class="boton_detalles"><a href="javascript:cargarDescripcionesH(\'./Client/src/models/detalle_habitacion.php?id_habitacion=' . $row['id_habitacion'] . '\')">Ver Detalles</a></div>';
   // echo '<div class="boton_reserva"><a href="javascript:cargarConsultas(\'./Client/src/models/reservar_habitacion.php?id_habitacion=' . $row['id_habitacion'] . '\')">Reservar Ahora</a></div>';
    echo '</div>'; 
    echo '</div>'; 
    echo '</div>'; 
}
$connect->close();

?>

<style>
    /* Estilos para las habitaciones */
.habitacion-item {
    background-color: #FFF; /* Fondo blanco para las tarjetas de habitaciones */
    border: 1px solid #D3D3D3; /* Borde gris claro */
    border-radius: 8px;
    margin: 10px;
    padding: 15px;
    width: 300px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
    background-color: #FFF9E3; /* Fondo crema para las tarjetas */
}

.habitacion-item img {
    max-width: 100%;
    border-radius: 5px;
}

.habitacion-detalle {
    margin-top: 10px;
}

.habitacion-detalle h3 {
    font-size: 20px;
    color: #2c3e50; /* Color gris oscuro */
    margin-bottom: 10px;
}

.habitacion-detalle p {
    font-size: 16px;
    color: #6e6666; /* Gris oscuro para el texto */
    margin-bottom: 10px;
}

/* Estilos para los botones de acción */
.habitacion-actions {
    display: flex;
    justify-content: space-around;
    margin-top: 15px;
}

.habitacion-actions .boton_detalles a,
.habitacion-actions .boton_reserva a {
    color: #FFF; /* Texto en blanco */
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease;
    font-weight: 500;
    font-size: 16px;
}

.boton_detalles a {
    background-color: #B0E0E6; /* Celeste */
}

.boton_detalles a:hover {
    background-color: #FF7F50; /* Coral */
    color: #6e6666; /* Gris oscuro para el texto */
}

.boton_reserva a {
    background-color: #FF7F50; /* Coral */
}

.boton_reserva a:hover {
    background-color: #B0E0E6; /* Celeste */
    color: #6e6666; /* Gris oscuro para el texto */
}

</style>
