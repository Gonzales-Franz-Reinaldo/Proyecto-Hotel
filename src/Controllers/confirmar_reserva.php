<?php
include("../../Database/conexion.php");

if (isset($_GET['id'])) {
    $reservaId = $_GET['id'];

    // Actualizar el estado de la reserva en la base de datos
    $updateSql = "UPDATE reservas SET estado = 'Confirmada' WHERE id = $reservaId";
    
    if ($connect->query($updateSql) === TRUE) {
        // Obtener los datos de la reserva para el envío del correo
        $sql = "SELECT * FROM reservas WHERE id = $reservaId";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $to = $row['correo'];
            $subject = "Confirmación de Reserva en Hotel SUCRE";
            $message = "Estimado " . $row['nombre'] . " " . $row['apellido'] . ",\n\n";
            $message .= "Su reserva ha sido confirmada.\n";
            $message .= "Detalles de la Reserva:\n";
            $message .= "Fecha de Ingreso: " . $row['fecha_ingreso'] . "\n";
            $message .= "Fecha de Salida: " . $row['fecha_salida'] . "\n";
            $message .= "Tipo de Habitación: " . $row['tipo_habitacion'] . "\n";
            $message .= "Número de Personas: " . $row['numero_personas'] . "\n\n";
            $message .= "Gracias por elegirnos.\n";
            $message .= "Hotel SUCRE";

            // Enviar el correo electrónico
            if (mail($to, $subject, $message)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al enviar el correo.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Reserva no encontrada.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al confirmar la reserva.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de reserva no proporcionado.']);
}

$connect->close();
?>
