<?php
include '../../../Database/conexion.php';


if (isset($_GET['id_promocion'])) {
    $id_promocion = intval($_GET['id_promocion']);

    $query = "SELECT * FROM promocion WHERE id_promocion = ?";

    $stmt = $connect->prepare($query);
    if ($stmt === false) {
        die('Error en la preparación de la consulta: ' . $connect->error);
    }

    $stmt->bind_param("i", $id_promocion);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<div class="detalle-promocion">';
        echo '<h2>' . htmlspecialchars($row['tipo_promocion']) . '</h2>';
        echo '<img src="./Client/public/images/promociones/' . htmlspecialchars($row['imagen']) . '" alt="Imagen de la promoción">';
        echo '<p>' . htmlspecialchars($row['descripcion_completa']) . '</p>';
        echo '<p><strong>Descuento:</strong> ' . htmlspecialchars($row['descuento']) . '%</p>';
        echo '<p><strong>Válida desde:</strong> ' . htmlspecialchars($row['fecha_ini']) . ' hasta ' . htmlspecialchars($row['fecha_final']) . '</p>';
        echo '<div class="boton_consulta"><a href="javascript:cargarConsultas(\'./Client/src/models/consultas.php?id=' . $row['id_promocion'] . '\')">Consultar</a></div>';
        echo '</div>';
    } else {
        echo '<p>Detalles no disponibles.</p>';
    }

    $stmt->close();
} else {
    echo '<p>ID de promoción no proporcionado.</p>';
}

if (isset($_GET['id_promocion'])) {
    $id_promocion = intval($_GET['id_promocion']);
    var_dump($id_promocion);
} else {
    echo '<p>ID de promoción no proporcionado.</p>';
}


$connect->close();
?>

<style>
    .detalle-promocion {
        padding: 20px;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 20px auto;
        font-family: 'Arial', sans-serif;
    }

    .detalle-promocion h2 {
        color: #333;
        font-size: 2rem;
        margin-bottom: 15px;
    }

    .detalle-promocion .promocion-imagen {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .detalle-promocion p {
        color: #555;
        line-height: 1.6;
        margin: 10px 0;
    }

    .detalle-promocion p strong {
        color: #333;
    }

    .boton_consulta a {
        display: inline-block;
        padding: 10px 20px;
        color: #fff;
        background-color: #dc3545;
        border-radius: 4px;
        text-decoration: none;
        font-size: 1rem;
        text-align: center;
        transition: background-color 0.3s ease;
    }

    .boton_consulta a:hover {
        background-color: #c82333;
    }
</style>