<!-- Incluir jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<!-- Incluir la versión más reciente de html2canvas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<?php
include "../../../Database/conexion.php";

if (isset($_GET['id_reserva'])) {
    $id_reserva = $_GET['id_reserva'];

    $sql = "SELECT r.id AS 'id_reserva', r.nombre, r.apellido, r.ci, r.correo, r.telefono, r.nacionalidad, r.fecha_de_reserva, 
            r.fecha_ingreso, r.fecha_salida, r.numero_personas, r.numero_noches, h.num_habitacion, h.tipo_hab,
            h.precio, p.tipo_promocion, p.descuento, f.id AS 'numero_factura', f.fecha_emision, f.sub_total, f.descuento_aplicado, f.monto_total  
            FROM reservas r 
            LEFT JOIN habitacion h ON r.id_habitacion = h.id_habitacion 
            LEFT JOIN promocion p ON r.id_promocion = p.id_promocion 
            LEFT JOIN factura_pago f ON r.id = f.id_reserva 
            WHERE f.id_reserva = $id_reserva";

    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <div class="factura-contenido">

            <div class="factura-container" id="factura-container">
                <div class="factura-header">
                    <div class="factura-logo">
                        <img src="../../public/images/logo_hotel.png" alt="Hotel Logo" class="logo">
                    </div>
                    <div class="factura-info">
                        <h1>Factura de Pago</h1>
                        <p><strong>Número de Factura:</strong> <?php echo $row['numero_factura'] ?></p>
                        <p><strong>Fecha de Emisión:</strong> <?php echo $row['fecha_emision'] ?></p>
                    </div>
                </div>

                <div class="factura-body">
                    <div class="factura-section">
                        <h2>Datos del Cliente</h2>
                        <div class="factura-date">
                            <div class="factura-column">
                                <p><strong>Nombre:</strong> <?php echo $row['nombre'] ?></p>
                                <p><strong>Apellido:</strong> <?php echo $row['apellido'] ?></p>
                                <p><strong>C.I.:</strong> <?php echo $row['ci'] ?></p>
                                <p><strong>Teléfono:</strong> <?php echo $row['telefono'] ?></p>
                            </div>
                            <div class="factura-column">
                                <p><strong>Correo:</strong> <?php echo $row['correo'] ?></p>
                                <p><strong>Nacionalidad:</strong> <?php echo $row['nacionalidad'] ?></p>
                                <p><strong>Fecha de Ingreso:</strong> <?php echo $row['fecha_ingreso'] ?></p>
                                <p><strong>Fecha de salida:</strong> <?php echo $row['fecha_salida'] ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="factura-section">
                        <h2>Datos de la Reserva</h2>
                        <div class="factura-column">
                            <p><strong>Número de Reserva:</strong><?php echo $id_reserva ?></p>
                            <p><strong>Fecha de Reserva:</strong> <?php echo $row['fecha_de_reserva'] ?></p>
                            <p><strong>Tipo de Habitación:</strong> <?php echo $row['tipo_hab'] ?></p>
                            <p><strong>Número de Personas:</strong> <?php echo $row['numero_personas'] ?></p>
                            <p><strong>Número de Habitación:</strong> <?php echo $row['num_habitacion'] ?></p>
                        </div>
                    </div>

                    <div class="factura-section">
                        <h2>Detalles de la Factura</h2>
                        <div class="factura-column">
                            <p><strong>Tipo Habitación:</strong> <?php echo $row['tipo_hab'] ?></p>
                            <p><strong>Precio:</strong> <?php echo $row['precio'] ?> Bs.</p>
                            <p><strong>Número de Noches:</strong> <?php echo $row['numero_noches'] ?></p>
                            <p><strong>Sub-Total:</strong> <?php echo $row['sub_total'] ?> Bs.</p>
                            <p><strong>Promoción:</strong> <?php echo $row['tipo_promocion'] ?> (<?php echo $row['descuento'] ?>%)</p>
                            <p><strong>Descuento Aplicado:</strong> <?php echo $row['descuento_aplicado'] ?> Bs.</p>
                            <p><strong>Monto Total:</strong> <?php echo $row['monto_total'] ?> Bs.</p>
                        </div>
                    </div>
                </div>

                <div class="factura-footer">
                    <p><strong>Notas:</strong> Gracias por su preferencia. Para cualquier consulta, contáctenos al correo: contacto@hotel.com</p>
                </div>

            </div>

            <div class="factura-print">
                <button onclick="generatePDF()" class="print-button">
                    <i class="fa-solid fa-print"></i>
                    Generar PDF
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