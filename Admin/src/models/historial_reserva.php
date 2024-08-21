<?php

include "../../../Database/conexion.php";

$sql = "SELECT *, r.id, r.estado AS 'estado_reserva', h.tipo_hab, f.id AS 'id_factura' 
        FROM reservas r LEFT JOIN habitacion h ON r.id_habitacion = h.id_habitacion 
        LEFT JOIN factura_pago f ON r.id = f.id_reserva  
        WHERE r.estado = 'Confirmada'";

$result = $connect->query($sql);

if ($result->num_rows > 0) {

?>

    <div class="historial-reservas">
        <h1>Historial de Reservas Confirmadas</h1>
        <div class="reservas-lista">

            <?php
            $num = 1;
            while ($row = $result->fetch_assoc()) { ?>
                <div class="reserva-card">
                    <h2>Reserva #<?php echo $num ?></h2>
                    <div class="detalles">
                        <div class="datos">
                            <p><strong>Fecha de Ingreso: </strong> <?php echo $row['fecha_ingreso'] ?></p>
                            <p><strong>Fecha de Salida: </strong> <?php echo $row['fecha_ingreso'] ?></p>
                            <p><strong>Tipo de Habitación: </strong> <?php echo $row['tipo_hab'] ?></p>
                            <p><strong>Número de Personas: </strong> <?php echo $row['numero_personas'] ?></p>
                            <p><strong>Estado: </strong> <?php echo $row['estado_reserva'] ?></p>
                        </div>
                        <div class="cliente">
                            <i class="fa-solid fa-user"></i>
                            <p><strong>Nombre:</strong> <?php echo $row['nombre'] ?> <?php echo $row['apellido'] ?></p>

                        </div>
                    </div>
                    <div class="acciones">
                        <!-- validar si la reserva tiene factura -->
                        <?php if($row['id_factura'] == null) {  ?>
                            <button class="generar-factura-btn" onclick="generarFactura(<?php echo $row['id'] ?>)">Generar Factura de Pago</button>
                        <?php } else { ?>

                            <button class="visualizar-factura-btn" onclick="visualizarFactura(<?php echo $row['id'] ?>)">Visualizar Factura de Pago</button>
                        <?php } ?>
                    </div>
                </div>

            <?php
                $num++;
            }
            ?>

        </div>
    </div>
<?php
} else {
    echo "<h1>No hay reservas confirmadas</h1>";
}
