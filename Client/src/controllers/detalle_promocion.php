<?php
include '../../../Database/conexion.php';

if (isset($_POST['id_promocion'])) {
    $id_promocion = $_POST['id_promocion'];

    // Consulta para obtener los detalles de la promoción
    $query_promocion = "SELECT * FROM promocion WHERE id_promocion = $id_promocion AND estado = 'Activo'";
    $result_promocion = $connect->query($query_promocion);

    if ($result_promocion->num_rows > 0) {
        $promocion = $result_promocion->fetch_assoc();
        header('Content-Type: application/json'); // Esto asegura que la salida es JSON
        echo json_encode($promocion);
    } else {
        echo json_encode(['error' => 'Promoción no encontrada']);
    }
}
?>
