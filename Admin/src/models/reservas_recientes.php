<?php

include "../../../Database/conexion.php";

$sql = "SELECT r.id, r.nombre, r.apellido, r.ci, r.correo, r.telefono, r.nacionalidad, r.fecha_ingreso,	
r.fecha_salida,	r.numero_personas, r.estado, r.id_habitacion, r.id_promocion, r.numero_noches, h.num_habitacion, h.tipo_hab 
FROM reservas r LEFT JOIN habitacion h ON r.id_habitacion = h.id_habitacion WHERE r.estado = 'Pendiente'";


$result = $connect->query($sql);

if ($result->num_rows > 0) {

?>

    <div class="reservas-pendientes">

        <h1>Reservas Pendientes</h1>
        <div class="reservas-container">
            <?php
            $nro = 1;
            while ($row = $result->fetch_assoc()) { ?>
                <div class="reserva-card">

                    <h2 class="text_reserva">Reserva #<?php echo $nro; ?></h2>
                    <div class="datos-reserva">
                        <div class="datos">
                            <h2>Datos personales</h2>
                            <p><strong>Nombre:</strong> <?php echo $row['nombre']; ?></p>
                            <p><strong>Apellido:</strong> <?php echo $row['apellido']; ?></p>
                            <p><strong>CI:</strong> <?php echo $row['ci']; ?></p>
                            <p><strong>Correo:</strong> <?php echo $row['correo']; ?></p>
                            <p><strong>Teléfono:</strong> <?php echo $row['telefono']; ?></p>
                            <p><strong>Nacionalidad:</strong> <?php echo $row['nacionalidad']; ?></p>
                        </div>

                        <div class="detalles-reserva">
                            <h2>Detalles de reserva</h2>
                            <p><strong>Fecha de Ingreso:</strong> <?php echo $row['fecha_ingreso']; ?></p>
                            <p><strong>Fecha de Salida:</strong> <?php echo $row['fecha_salida']; ?></p>
                            <p><strong>Número de Habitación:</strong> <?php echo $row['num_habitacion']; ?></p>
                            <p><strong>Tipo de Habitación:</strong> <?php echo $row['tipo_hab']; ?></p>
                            <p><strong>Número de Personas:</strong> <?php echo $row['numero_personas']; ?></p>
                            <p><strong>Número de días:</strong> <?php echo $row['numero_noches']; ?></p>
                            <p><strong>Estado:</strong> <?php echo $row['estado']; ?></p>
                        </div>

                        <div class="acciones">
                            <button class="confirm-btn" id="confirm-<?php echo $row['id']; ?>" onclick="confirmarReserva(<?php echo $row['id']; ?>)">Confirmar Reserva</button>
                            <button class="cancel-btn" onclick="rechazarReserva(<?php echo $row['id']; ?>)">Rechazar Reserva</button>
                        </div>
                    </div>
                </div>
            <?php
                $nro++;
            } ?>
        </div>
    </div>

<?php
} else {
    echo "<h1>No hay reservas pendientes</h1>";
}
