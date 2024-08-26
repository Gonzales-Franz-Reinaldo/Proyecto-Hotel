<?php
include("../../../Database/conexion.php");

if (isset($_GET['id'])) {
    $reservaId = $_GET['id'];

    date_default_timezone_set('America/La_Paz'); // Zona horaria de Bolivia
    $fecha_confirmacion = (new DateTime())->format('Y-m-d H:i:s');

    // Actualizar el estado de la reserva en la base de datos y la fecha de confirmación
    $updateSql = "UPDATE reservas SET estado = 'Confirmada', fecha_confirm = '$fecha_confirmacion' WHERE id = $reservaId";
    
    if ($connect->query($updateSql) === TRUE) {
        
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al confirmar la reserva.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de reserva no proporcionado.']);
}

$connect->close();
?>
