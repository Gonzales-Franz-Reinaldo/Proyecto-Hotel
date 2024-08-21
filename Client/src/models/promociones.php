<?php
include '../../../Database/conexion.php';

$query = "SELECT * FROM promocion";
$result = $connect->query($query);

if ($result->num_rows > 0) {
    echo '<section id="promotions">';
    echo '<h2>Promociones Especiales</h2>';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="promotion-card">';
        echo '<div class="promotion-header">';
        echo '<h3>' . htmlspecialchars($row['tipo_promocion']) . '</h3>';
        echo '</div>';
        echo '<div class="promotion-body">';
        echo '<p>' . htmlspecialchars($row['descripcion']) . '</p>';
        echo '<p><strong>Descuento:</strong> ' . htmlspecialchars($row['descuento']) . '%</p>';
        echo '<p><strong>Válida desde:</strong> ' . htmlspecialchars($row['fecha_ini']) . ' hasta ' . htmlspecialchars($row['fecha_final']) . '</p>';
        echo '</div>';
        echo '<div class="promotion-footer">';
        echo '<a href="javascript:cargarDetalles(\'./Client/src./models/descripciones.php?id_promocion=' . $row['id_promocion'] . '\')" class="boton_detalles">Ver Detalles</a>';
        echo '<a href="javascript:cargarConsultas(\'./Client/src./models/consultas.php?id=' . $row['id_promocion'] . '\')" class="boton_consulta">Consultar</a>';
        echo '</div>';
        echo '</div>';
    }
    echo '</section>';
} else {
    echo '<p>No hay promociones disponibles en este momento.</p>';
}


$connect->close();
?>

<<
<style>
    #promotions {
        padding: 20px;
        background-color: #f0f0f0;
        border-radius: 12px;
        max-width: 1200px;
        margin: 0 auto;
    }

    #promotions h2 {
        text-align: center;
        color: #007bff;
        margin-bottom: 20px;
        font-size: 2rem;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        /* Fuente moderna */
    }

    .promotion-card {
        background-color: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 15px;
        margin-bottom: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .promotion-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .promotion-header h3 {
        color: #007bff;
        font-size: 1.5rem;
        margin-top: 0;
        margin-bottom: 10px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .promotion-body p {
        color: #333;
        font-size: 1rem;
        margin: 8px 0;
    }

    .promotion-body p strong {
        color: #212529;
    }

    .promotion-footer {
        margin-top: 10px;
        text-align: center;
    }

    .promotion-footer a {
        display: inline-block;
        padding: 8px 15px;
        margin: 5px;
        border-radius: 6px;
        color: #ffffff;
        text-decoration: none;
        font-size: 0.9rem;
        text-align: center;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .promotion-footer .boton_detalles {
        background-color: #08bc59;
    }

    .promotion-footer .boton_consulta {
        background-color: #0c8379;
    }

    .promotion-footer a:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }
</style>