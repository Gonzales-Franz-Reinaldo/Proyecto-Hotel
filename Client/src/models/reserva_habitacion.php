<?php
include '../../../Database/conexion.php';

$id_habitacion = $_GET['id_habitacion'];

// Obtener los detalles de la habitación
$query_habitacion = "SELECT * FROM habitacion WHERE id_habitacion = '$id_habitacion'";
$result_habitacion = $connect->query($query_habitacion);
$habitacion = $result_habitacion->fetch_assoc();

// Obtener las promociones disponibles
$query_promociones = "SELECT * FROM promocion WHERE estado = 'activo'";
$result_promociones = $connect->query($query_promociones);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Código para manejar la reserva...
}

?>
<link rel="stylesheet" href="./Client/public/css/formulario.css">
<div class="container-formulario">
    <h1 class="title-form">Completa el formulario para la reserva</h1>

    <form method="post" class="contenido-formulario">

        <div class="informacion-formulario">
            <!-- Descripción de la Habitación -->
            <div class="habitacion-descripcion">
                <h2>Habitación <?php echo $habitacion['num_habitacion']; ?></h2>
                <img src="./Client/public/images/habitaciones/<?php echo $habitacion['foto']; ?>" alt="Foto de la habitación">
                <p><strong>Tipo de Habitación:</strong> <?php echo ucfirst($habitacion['tipo_hab']); ?></p>
                <p><strong>Capacidad:</strong> <?php echo $habitacion['capacidad']; ?> personas</p>
                <p><strong>Precio por Noche:</strong> $<?php echo $habitacion['precio']; ?></p>
            </div>

            <!--  Formulario de Reserva -->
            <div id="form-reserva" class="datos-formulario">
                <h2>Datos de Reserva</h2>

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>

                <label for="ci">Cédula de Identidad (CI):</label>
                <input type="text" id="ci" name="ci" required>

                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" required>

                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" required>

                <!-- Nacionalidad -->
                <label for="nacionalidad">Nacionalidad:</label>
                <input type="text" id="nacionalidad" name="nacionalidad" required>

                <!-- Fecha de Ingreso -->
                <label for="fecha_ingreso">Fecha de Ingreso:</label>
                <input type="date" id="fecha_ingreso" name="fecha_ingreso" required>

                <!-- Fecha de Salida -->
                <label for="fecha_salida">Fecha de Salida:</label>
                <input type="date" id="fecha_salida" name="fecha_salida" required>

                <!-- Número de Personas -->
                <label for="numero_personas">Número de Personas:</label>
                <input type="number" id="numero_personas" name="numero_personas" min="1" required>


                <input type="hidden" name="id_habitacion" value="<?php echo $habitacion['id_habitacion']; ?>">

                <!-- Estado de la Reserva (oculto) -->
                <input type="hidden" name="estado" value="pendiente">

                <input type="hidden" id="numero_noches" name="numero_noches" value="">

                <input type="hidden" id="precio_total" name="precio_total" value="<?php echo $habitacion['precio']; ?>">
            </div>

        </div>



        <div class="detalles-formulario">

            <!-- Selección de Promoción -->
            <h2 for="promocion">Ver pormociones disponibles</h2>
            <select id="promocion" name="id_promocion" onchange="MostrarPromocion()">
                <option value="0" data-descuento="0">Seleccionar promociones</option>
                <?php while ($promocion = $result_promociones->fetch_assoc()) { ?>
                    <option value="<?php echo $promocion['id_promocion']; ?>" data-descuento="<?php echo $promocion['descuento']; ?>">
                        <?php echo $promocion['tipo_promocion']; ?>
                    </option>
                <?php } ?>
            </select>
            <button class="btn_omitir">Omitir</button>


            <!-- PROMOCIONES DISPONIBLES  -->
            <div class="promociones-disponibles">
                <p>Las promocioens disponibles..</p>
            </div>


            <!-- 4. Detalles de la Reserva -->
            <div class="detalles-reserva">
                <h2>Detalles de tu Reserva</h2>
                <p><strong>Precio por Noche:</strong> $<span id="precio_noche"><?php echo $habitacion['precio']; ?></span></p>
                <p><strong>Promoción:</strong> <span id="detalle_promocion">Ninguna</span></p>
                <p><strong>Precio Total:</strong> $<span id="precio_total"><?php echo $habitacion['precio']; ?></span></p>
                <button type="submit" form="form-reserva" class="boton_reserva">Reservar</button>
            </div>
        </div>
    </form>
</div>



<!-- <style>
    .reserva-container {
        display: flex;
        flex-direction: row;
        gap: 20px;
        margin: 20px;
        font-family: Arial, sans-serif;
    }

    /* Descripción de la Habitación */
    .habitacion-descripcion {
        background-color: #FFF;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 300px;
    }

    .habitacion-descripcion img {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .habitacion-descripcion p {
        margin: 10px 0;
    }

    .habitacion-descripcion p strong {
        color: #FF7F50;
        /* Coral */
    }

    /* Formulario de Reserva */
    #form-reserva {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 15px;
        background-color: #FFF;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    #form-reserva label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    #form-reserva input[type="text"],
    #form-reserva input[type="email"],
    #form-reserva input[type="date"],
    #form-reserva input[type="number"],
    #form-reserva select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #D3D3D3;
        /* Gris Claro */
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    #form-reserva input[type="date"] {
        font-family: Arial, sans-serif;
    }

    /* Selección de Promoción */
    select#promocion {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #D3D3D3;
        /* Gris Claro */
        background-color: #FFF;
    }

    /* Detalles de la Reserva */
    .detalles-reserva {
        background-color: #FFF;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    .detalles-reserva p {
        margin: 10px 0;
    }

    .detalles-reserva p strong {
        color: #FF7F50;
        /* Coral */
    }

    .detalles-reserva button.boton_reserva {
        background: linear-gradient(90deg, #B0E0E6, #FF7F50);
        /* Azul Pastel y Coral */
        color: #FFF;
        border: none;
        padding: 15px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .detalles-reserva button.boton_reserva:hover {
        background: linear-gradient(90deg, #87CEFA, #FF6347);
        /* Azul Pastel y Coral en hover */
    }
</style> -->