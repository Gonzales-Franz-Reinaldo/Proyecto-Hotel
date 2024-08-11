<?php

include("../../Database/conexion.php");

$sql = "SELECT * FROM reservas WHERE estado = 'Pendiente'";

$result = $connect->query($sql);

if ($result->num_rows > 0) {

?>

    <div class="reservas-pendientes">
        <h1>Nueva Reserva de Habitaciones</h1>
        <div class="reservas-container">

            <?php
            $nro = 1;
            while ($row = $result->fetch_assoc()) { ?>
                <div class="reserva-card">
                    <h2>Reserva #<?php echo $nro; ?></h2>
                    <p><strong>Nombre:</strong> <?php echo $row['nombre']; ?></p>
                    <p><strong>Apellido:</strong> <?php echo $row['apellido']; ?></p>
                    <p><strong>CI:</strong> <?php echo $row['ci']; ?></p>
                    <p><strong>Correo:</strong> <?php echo $row['correo']; ?></p>
                    <p><strong>Teléfono:</strong> <?php echo $row['telefono']; ?></p>
                    <p><strong>Nacionalidad:</strong> <?php echo $row['nacionalidad']; ?></p>
                    <p><strong>Fecha de Ingreso:</strong> <?php echo $row['fecha_ingreso']; ?></p>
                    <p><strong>Fecha de Salida:</strong> <?php echo $row['fecha_salida']; ?></p>
                    <p><strong>Número de Habitaciones:</strong> <?php echo $row['numero_habitaciones']; ?></p>
                    <p><strong>Tipo de Habitación:</strong> <?php echo $row['tipo_habitacion']; ?></p>
                    <p><strong>Número de Personas:</strong> <?php echo $row['numero_personas']; ?></p>
                    <p><strong>Estado:</strong> <?php echo $row['estado']; ?></p>
                    <div class="acciones">
                        <button class="confirm-btn">Confirmar</button>
                        <button class="cancel-btn">Cancelar</button>
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
