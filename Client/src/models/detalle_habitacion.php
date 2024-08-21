<?php
include '../../../Database/conexion.php';

$id_habitacion = isset($_GET['id_habitacion']) ? $_GET['id_habitacion'] : null;

if ($id_habitacion) {
    $query = "SELECT * FROM habitacion WHERE id_habitacion='$id_habitacion'";
    $result = $connect->query($query);

    if ($result->num_rows > 0) {
        $habitacion = $result->fetch_assoc();
    } else {
        echo "<p>Habitación no encontrada.</p>";
        exit;
    }
} else {
    echo "<p>ID de habitación no especificado.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Habitación</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="detalle-habitacion">
        <div class="descripcion">
            <h1>Habitación <?php echo $habitacion['num_habitacion']; ?></h1>
            <p class="mensaje-inicial">¡Descubre la comodidad y el lujo de nuestra habitación <?php echo $habitacion['num_habitacion']; ?>! Perfecta para tu descanso y relajación.</p>
            <div class="detalle-contenido">
                <div class="detalle-info">
                    <p><?php echo $habitacion['descripcion_completa']; ?></p>
                </div>
                <img src="./Client/public/images/habitaciones/<?php echo $habitacion['foto']; ?>" alt="Foto de la habitación" class="habitacion-img">
            </div>
        </div>
        <div class="descripcion-detalle">
            
            <div class="detalle-item">
                <i class="fas fa-hashtag"></i>
                <span>Habitación: <?php echo $habitacion['num_habitacion']; ?></span>
            </div>
            <div class="detalle-item">
                <i class="fas fa-building"></i>
                <span>Piso: <?php echo $habitacion['num_piso']; ?></span>
            </div>
            <div class="detalle-item">
                <i class="fas fa-bed"></i>
                <span>Capacidad: <?php echo $habitacion['capacidad']; ?> personas</span>
            </div>
            <div class="detalle-item">
                <i class="fas fa-tag"></i>
                <span>Precio: $<?php echo number_format($habitacion['precio'], 2); ?> por noche</span>
            </div>
            <div class="detalle-item">
                <i class="fas fa-info-circle"></i>
                <span>Tipo: <?php echo ucfirst($habitacion['tipo_hab']); ?></span>
            </div>
            <div class="detalle-item">
                <i class="fas fa-circle"></i>
                <span>Estado: <?php echo ucfirst($habitacion['estado']); ?></span>
            </div>

            <div class="detalle-item">
                <i class="fas fa-circle"></i>
                <span>Teléfono</span>
            </div>

            <div class="detalle-item">
                <i class="fas fa-circle"></i>
                <span>Wifi</span>
            </div>

            <div class="detalle-item">
                <i class="fas fa-circle"></i>
                <span>Frigobar</span>
            </div>

            <div class="detalle-item">
                <i class="fas fa-circle"></i>
                <span>Aire Acondicionado</span>

            
            </div>

            <div class="detalle-item">
                <i class="fas fa-circle"></i>
                <span>TV cable</span>
            </div>

            
        </div>
    </div>
</body>
</html>

<style>
body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.detalle-habitacion {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.descripcion {
    margin-bottom: 30px;
}

.descripcion h1 {
    margin: 0;
    color: #FF7F50; /* Coral */
    font-size: 32px;
    text-align: center;
    font-weight: 700;
}

.mensaje-inicial {
    font-size: 18px;
    color: #666;
    margin: 10px 0 20px;
    text-align: center;
}

.detalle-contenido {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}

.detalle-info {
    max-width: 600px;
    text-align: left;
    margin-right: 20px; /* Aleja el texto del borde derecho */
    margin-left: 20px; /* Agrega espacio en el lado izquierdo */
    padding: 0 10px; /* Agrega padding para más separación */
}

.detalle-info p {
    margin: 10px 0;
    font-size: 18px;
    color: #333;
}

.habitacion-img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.descripcion-detalle {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.descripcion-detalle h2 {
    margin-top: 0;
    color: #007bff;
    font-size: 24px;
    font-weight: 700;
    text-align: center;
}

.detalle-item {
    display: flex;
    align-items: center;
    margin: 10px 0;
    font-size: 18px;
    color: #333;
}

.detalle-item i {
    font-size: 24px;
    color: #007bff;
    margin-right: 10px;
}

.detalle-item span {
    font-weight: 400;
}

@media (min-width: 768px) {
    .detalle-contenido {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }

    .detalle-info {
        max-width: 60%;
    }

    .habitacion-img {
        max-width: 35%;
    }
}
</style>