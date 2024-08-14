<?php
$id_promocion = isset($_GET['id']) ? intval($_GET['id']) : 0;

include '../../Database/conexiones.php';


$query = "SELECT tipo_promocion FROM promocion WHERE id_promocion = $id_promocion";
$result = $connect->query($query);


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre_promocion = htmlspecialchars($row['tipo_promocion']);

    echo '<section id="consulta">';
    echo '<h2>Consulta sobre Promoción</h2>';
    echo '<p>Para consultas sobre la promoción <strong>' . $nombre_promocion . '</strong>, por favor contacta al siguiente número de WhatsApp:</p>';
    echo '<div class="consulta-actions">';
    echo '<a href="https://wa.me/1234567890" class="whatsapp-button" target="_blank">WhatsApp</a>';
    echo '</div>';
    echo '</section>';
} else {
    echo '<p>No se encontró la promoción.</p>';
}


$connect->close();
?>



<style>

#consulta {
    padding: 20px;
    background-color: #f9f9f9; 
    border-radius: 8px;
    border: 1px solid #ddd; 
    max-width: 600px;
    margin: 20px auto; 
}

#consulta h2 {
    text-align: center;
    color: #333; 
    margin-bottom: 20px;
    font-size: 1.8rem;
    font-family: 'Arial', sans-serif;
}

#consulta p {
    color: #555; 
    font-size: 1rem;
    margin-bottom: 20px;
    text-align: center;
}

.consulta-actions {
    text-align: center;
}

.whatsapp-button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 1.1rem;
    color: #fff;
    background-color: #25d366;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.whatsapp-button:hover {
    background-color: #1ebe57;
}


</style>