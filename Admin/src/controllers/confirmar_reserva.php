<?php
include("../../../Database/conexion.php");

if (isset($_GET['id'])) {
    $reservaId = $_GET['id'];

    // Actualizar el estado de la reserva en la base de datos
    $updateSql = "UPDATE reservas SET estado = 'Confirmada' WHERE id = $reservaId";
    
    if ($connect->query($updateSql) === TRUE) {
        
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al confirmar la reserva.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de reserva no proporcionado.']);
}

$connect->close();
?>
