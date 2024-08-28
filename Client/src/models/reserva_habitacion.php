<?php
include '../../../Database/conexion.php';

$id_habitacion = $_GET['id_habitacion'];

// Obtener los detalles de la habitación
$query_habitacion = "SELECT * FROM habitacion WHERE id_habitacion = '$id_habitacion'";
$result_habitacion = $connect->query($query_habitacion);
$habitacion = $result_habitacion->fetch_assoc();

// Obtener las promociones disponibles
$query_promociones = "SELECT * FROM promocion WHERE estado = 'Activo'";
$result_promociones = $connect->query($query_promociones);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Código para manejar la reserva...
}

?>
<link rel="stylesheet" href="./Client/public/css/formulario.css">

<div class="container-formulario">

    <div class="volver-atras">
        <a href="javascript:volverHabitaciones('<?php echo $habitacion['tipo_hab'];  ?>')">
            <i class="fas fa-arrow-left"></i> Volver a Habitaciones
        </a>
    </div>

    <h1 class="title-form">Completa el formulario para la reserva</h1>

    <form class="contenido-formulario" id="formulario_reserva">

        <div class="informacion-formulario">
            <!-- Descripción de la Habitación -->
            <div class="habitacion-descripcion">
                <img src="./Client/public/images/habitaciones/<?php echo $habitacion['foto']; ?>" alt="Foto de la habitación">
                <div class="datos-hab">
                    <h2>Habitación <?php echo $habitacion['num_habitacion']; ?></h2>
                    <br>
                    <p><strong>Tipo de Habitación:</strong> <?php echo ucfirst($habitacion['tipo_hab']); ?></p>
                    <p><strong>Capacidad:</strong> <?php echo $habitacion['capacidad']; ?> personas</p>
                    <p><strong>Precio por Noche:</strong> $<?php echo $habitacion['precio']; ?></p>
                </div>
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


                <!-- Nacionalidad -->
                <label for="nacionalidad">Nacionalidad:</label>
                <!-- <input type="text" id="nacionalidad" name="nacionalidad"> -->
                <select name="nacionalidad" id="nacionalidad">
                    <option value="">Seleccionar Nacionalidad</option>
                    <option value="Boliviana">Boliviana</option>
                    <option value="Peruano">Peruano</option>
                    <option value="Puerano">Argentina</option>
                    <option value="Chileno">Chileno</option>
                    <option value="Colombiana">Colombiana</option>
                    <option value="Ecuatoriana">Ecuatoriana</option>
                    <option value="Guatemalteca">Guatemalteca</option>
                    <option value="Haitiana">Haitiana</option>
                    <option value="Mexicana">Mexicana</option>
                    <option value="Peruana">Peruana</option>
                    <option value="Uruguaya">Uruguaya</option>

                </select>

                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" required>

                <label for="fecha_ingreso">Fecha de Ingreso:</label>
                <input type="date" id="fecha_ingreso" name="fecha_ingreso" class="styled-date" required>

                <label for="fecha_salida">Fecha de Salida:</label>
                <input type="date" id="fecha_salida" name="fecha_salida" class="styled-date" required>

                <!-- Número de Personas -->
                <label for="numero_personas">Número de Personas:</label>
                <input type="number" id="numero_personas" name="numero_personas" min="1" required>


                <input type="hidden" name="id_habitacion" value="<?php echo $habitacion['id_habitacion']; ?>">

            </div>

        </div>



        <div class="detalles-formulario">
            <!-- Selección de Promoción -->
            <div class="promocion-wrapper" id="promocion-wrapper">
                <select id="promocion" name="promocion" onchange="MostrarPromocion()">
                    <option value="0" data-descuento="0">Seleccionar promociones</option>
                    <?php while ($promocion = $result_promociones->fetch_assoc()) { ?>
                        <option value="<?php echo $promocion['id_promocion']; ?>">
                            <?php echo $promocion['tipo_promocion']; ?>
                        </option>
                    <?php } ?>
                </select>
                <button type="button" class="btn_omitir" onclick="OmitirPromocion()">Omitir</button>
            </div>



            <!-- PROMOCIONES DISPONIBLES -->
            <div class="promociones-disponibles" id="promociones-disponibles">
                <p id="mensaje-promocion">Las promociones disponibles..</p>
            </div>

            <!-- Detalles de la Reserva -->
            <div class="detalles-reserva">
                <h2>Detalles de tu Reserva</h2>
                <p><strong>Precio habitacion:</strong> <span id="precio_noche"><?php echo $habitacion['precio']; ?> Bs.</span></p>
                <p><strong>Descuento:</strong> <span id="descuento_promo">0%</span></p>
                <p><strong>Tipo promoción:</strong> <span id="detalle_promocion">Ninguna</span></p>
                <p id="precio_total_"><strong>Precio por noche:</strong> <span><?php echo $habitacion['precio']; ?></span>Bs.</p>

                <input type="hidden" name="id_promocion" value="" id="id_promocion">

                <button type="button" class="boton_reserva" onclick="registrarReserva()">Reservar</button>
            </div>
        </div>
    </form>

</div>
<script src="./Client/public/js/script.js"></script>
<script src="../../public/js/scripts.js"></script>