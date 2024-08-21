<?php

include "../../../Database/conexion.php";

if (isset($_GET['id_reserva'])) {
    $id_reserva = $_GET['id_reserva'];

    // echo $id_reserva;


    $sql = "SELECT r.id AS 'id_reserva', r.nombre, r.apellido, r.ci, r.correo, r.telefono, r.nacionalidad, 
        r.fecha_ingreso, r.fecha_salida, r.numero_personas, r.numero_noches, h.num_habitacion, h.tipo_hab,
        h.precio, p.tipo_promocion, p.descuento, f.id AS 'numero_factura', f.fecha_emision, f.sub_total, f.descuento_aplicado, f.monto_total  
        FROM reservas r LEFT JOIN habitacion h ON r.id_habitacion = h.id_habitacion 
        LEFT JOIN promocion p ON r.id_promocion = p.id_promocion 
        LEFT JOIN factura_pago f ON r.id = f.id_reserva 
        WHERE f.id_reserva = $id_reserva";

    $result = $connect->query($sql);


    if ($result->num_rows > 0) { 

        $row = $result->fetch_assoc();

        ?>

        <div class="factura-contenido">
            <div class="factura-container" id="factura-container">
                <div class="factura-logo">
                    <img src="../../public/images/logo_hotel.png" alt="Hotel Logo" class="logo">
                </div>
                <div class="factura-header">
                    <h1>Factura de Pago</h1>
                    <p><strong>Número de Factura:</strong> <?php echo $row['numero_factura']  ?></p>
                    <p><strong>Fecha de Emisión:</strong> <?php echo $row['fecha_emision']  ?></p>
                </div>

                <div class="factura-body">
                    <div class="factura-section">
                        <h2>Datos del Cliente</h2>
                        <table class="factura-table">
                            <tr>
                                <th>Nombre del Cliente</th>
                                <th>Apellido</th>
                                <th>CI.</th>
                                <th>Teléfono</th>
                            </tr>
                            <tr>
                                <td><?php echo $row['nombre'] ?> </td>
                                <td><?php echo $row['apellido'] ?></td>
                                <td><?php echo $row['ci'] ?></td>
                                <td><?php echo $row['telefono'] ?></td>
                            </tr>
                            <tr>
                                <th>Correo Electrónico</th>
                                <th>Nacionalidad</th>
                                <th>Fecha de Entrada</th>
                                <th>Fecha de Salida</th>
                            </tr>
                            <tr>
                                <td><?php echo $row['correo'] ?></td>
                                <td><?php echo $row['nacionalidad'] ?></td>
                                <td><?php echo $row['fecha_ingreso'] ?></td>
                                <td><?php echo $row['fecha_salida'] ?></td>
                            </tr>
                        </table>
                    </div>

                    <div class="factura-section">
                        <h2>Datos de la Reserva</h2>
                        <table class="factura-table">
                            <tr>
                                <th>ID reserva</th>
                                <th>Tipo de Habitación</th>
                                <th>Número de Personas</th>
                                <th>Número de Habitación</th>
                            </tr>
                            <tr>
                                <td><?php echo $row['id_reserva'] ?></td>
                                <td><?php echo $row['tipo_hab'] ?></td>
                                <td><?php echo $row['numero_personas'] ?></td>
                                <td><?php echo $row['num_habitacion'] ?></td>
                            </tr>
                        </table>
                    </div>

                    <div class="factura-section">
                        <h2>Detalles de la Factura</h2>
                        <table class="factura-table">
                            <tr>
                                <th>Descripción</th>
                                <th>Precio o valor</th>
                                <th>Numero Días</th>
                                <th>Total $</th>
                            </tr>
                            <tr>
                                <td>Habitación <?php echo $row['tipo_hab'] ?></td>
                                <td><?php echo $row['precio'] ?> Bs.</td>
                                <td><?php echo $row['numero_noches'] ?></td>
                                <td><?php echo $row['sub_total'] ?> Bs.</td>
                            </tr>
                            <tr>
                                <td>Promo <?php echo $row['tipo_promocion'] ?> descuento (<?php echo $row['descuento'] ?>%)</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-<?php echo $row['descuento_aplicado'] ?> BS.</td>
                            </tr>
                            <tr>
                                <th colspan="3">Monto Total</th>
                                <th><?php echo $row['monto_total'] ?> Bs.</th>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="factura-footer">
                    <p><strong>Notas:</strong> Gracias por su preferencia. Para cualquier consulta, contáctenos al correo: contacto@hotel.com</p>
                </div>
            </div>

            <div class="factura-print">
                <button onclick="printFactura()" class="print-button">
                    <i class="fa-solid fa-print"></i>
                    Imprimir Factura
                </button>
            </div>


        </div>

<?php
    } else {
        echo "<h1>No hay facturas generadas</h1>";
    }
} else {
    echo "<h1>No hay facturas generadas</h1>";
}

?>