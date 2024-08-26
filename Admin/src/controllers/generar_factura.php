<?php

include("../../../Database/conexion.php");


if (isset($_GET['id_reserva'])) {

    $id_reserva = $_GET['id_reserva'];

    date_default_timezone_set('America/La_Paz'); // Zona horaria de Bolivia
    $fecha_emision = (new DateTime())->format('Y-m-d H:i:s');


    $sql_ope = "SELECT r.numero_noches, h.precio, p.descuento 
                FROM reservas r 
                LEFT JOIN habitacion h ON r.id_habitacion = h.id_habitacion 
                LEFT JOIN promocion p ON r.id_promocion = p.id_promocion 
                WHERE r.id = $id_reserva";

    $result_ope = $connect->query($sql_ope);

    if ($result_ope->num_rows > 0) {
        $row_oper = $result_ope->fetch_assoc();

        $sub_total = $row_oper['numero_noches'] * $row_oper['precio'];
        $descuento_aplicado = $sub_total * ($row_oper['descuento'] / 100);
        $monto_total = $sub_total - $descuento_aplicado;

        $sql = "INSERT INTO factura_pago (id, fecha_emision, sub_total, descuento_aplicado, monto_total, id_reserva) 
        VALUES (NULL, '$fecha_emision', $sub_total, $descuento_aplicado, $monto_total, $id_reserva)";

        if ($connect->query($sql) === TRUE) {
            // echo "Factura generada con éxito";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al confirmar la reserva.']);
    }
    $connect->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Error al confirmar la reserva.']);
}

?>



<!-- $fecha_inicio = '2024-08-14'; // Fecha de inicio de la reserva
$fecha_fin = '2024-08-20';    // Fecha final de la reserva

// Convertir las fechas a objetos DateTime
$datetime_inicio = new DateTime($fecha_inicio);
$datetime_fin = new DateTime($fecha_fin);

// Calcular la diferencia
$interval = $datetime_inicio->diff($datetime_fin);

// Obtener el número de días como un entero
$num_noches = $interval->days;

echo "Número de noches: " . $num_noches; // Debería mostrar 6 -->
