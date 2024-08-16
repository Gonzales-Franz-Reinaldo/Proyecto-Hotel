<?php
include("../../../Database/conexion.php");

if (isset($_GET['id'])) {

    $reservaId = $_GET['id'];
    echo $reservaId;

    // Actualizar el estado de la reserva en la base de datos
    $updateSql = "UPDATE reservas SET estado = 'Cancelada' WHERE id = $reservaId";
    
    if ($connect->query($updateSql) === TRUE) {

    } else {
        echo json_encode(['success' => false, 'message' => 'Error al confirmar la reserva.']);
    }
    $connect->close();
} 

?>
