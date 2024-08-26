<?php

include "../../../Database/conexion.php";
?>

<div class="reservas-pendientes">

    <h1>Reservas Pendientes</h1>

    <div class="buscar-reservas">
        <!-- Formulario para búsqueda -->
        <form id="formBusqueda" action="javascript:void(0);" onsubmit="return realizarBusqueda2();">
            <div class="input-contenedor">
                <span class="icono-busqueda">
                    <i class="fa fa-search"></i> <!-- Icono de Font Awesome -->
                </span>
                <input type="text" id="busquedaDatos" name="busquedaGeneral" placeholder="Buscar por el dato.." class="input-busqueda">
            </div>

            <!-- Campo de fecha para buscar por fecha de reserva -->
            <div class="fecha-reserva">
                <label for="fechaReserva">Fecha Reserva:</label>
                <input type="date" id="fechaReserva" name="fechaReserva" class="input-fecha">
            </div>

            <!-- Botón de búsqueda -->
            <button type="submit" class="btn-buscar">Buscar</button>
        </form>


        <!-- Opciones de ordenación -->
        <div class="opciones-ordenacion">
            <!-- Selector de tipo de habitación -->
            <select id="tipoHabitacion" class="select-ordenar" name="tipoHabitacion" onchange="ordenarPorTipoHabitacion2()">
                <option value="">Ordenar por tipo de habitación</option>
                <option value="Simple">Simple</option>
                <option value="Especial">Especial</option>
                <option value="Familiar">Familiar</option>
                <option value="Matrimonial">Matrimonial</option>
            </select>

            <!-- Selector de ordenación por fecha de modificación -->
            <select id="ordenarTipo" class="select-ordenar" onchange="ordenarPorTipo2()">
                <option value="">Agrupar por..</option>
                <option value="numero_personas">Numero de personas</option>
                <option value="proxima_reserva">Reservas Próximas</option>
                <option value="fecha_salida">Fecha de salida</option>
            </select>

        </div>
    </div>

    <?php
    $sql = "SELECT r.id, r.nombre, r.apellido, r.ci, r.correo, r.telefono, r.nacionalidad, r.fecha_de_reserva, r.fecha_ingreso,	
    r.fecha_salida,	r.numero_personas, r.estado, r.id_habitacion, r.id_promocion, r.numero_noches, h.num_habitacion, h.tipo_hab 
    FROM reservas r LEFT JOIN habitacion h ON r.id_habitacion = h.id_habitacion 
    WHERE r.estado = 'Pendiente'";


    if (isset($_GET['busquedaGeneral']) || isset($_GET['fechaReserva'])) {

        if ($_GET['busquedaGeneral'] !== '') {

            $dato = $_GET['busquedaGeneral'];
            // echo $dato;
            $sql .= " AND (r.nombre LIKE '%$dato%' OR r.apellido LIKE '%$dato%' OR r.ci 
            LIKE '%$dato%' OR r.correo LIKE '%$dato%' OR r.telefono LIKE '%$dato%' OR 
            r.nacionalidad LIKE '%$dato%' OR r.fecha_de_reserva LIKE '%$dato%' OR h.tipo_hab LIKE '%$dato%')";
        }

        if ($_GET['fechaReserva'] !== '') {
            $fecha = $_GET['fechaReserva'];
            // echo $fecha;
            $sql .= " AND r.fecha_de_reserva = '$fecha'";
        }
    }

    if(isset($_GET['tipoHabitacion'])){

        if ($_GET['tipoHabitacion'] !== '') {
            $tipoHabitacion = $_GET['tipoHabitacion'];
            // echo $tipoHabitacion;
            $sql .= " AND h.tipo_hab = '$tipoHabitacion'";
        }
    }

    if (isset($_GET['ordenarTipo'])) {
        if ($_GET['ordenarTipo'] !== '') {
            // Lista blanca de columnas permitidas para ordenar
            if ($_GET['ordenarTipo'] == 'numero_personas') {
                $sql .= " ORDER BY r.numero_personas DESC";
            } else if ($_GET['ordenarTipo'] == 'proxima_reserva') {
                // Mostrar solo reservas cuya fecha de ingreso sea entre la fecha actual y dos días después
                $sql .= " AND r.fecha_ingreso BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 DAY)";
                $sql .= " ORDER BY r.fecha_ingreso ASC";
            } else if ($_GET['ordenarTipo'] == 'fecha_salida') {
                $sql .= " ORDER BY r.fecha_salida ASC";
            }
        }
    }
    

    $result = $connect->query($sql);

    if ($result->num_rows > 0) {

    ?>


        <div class="reservas-container">
            <?php
            $nro = 1;
            while ($row = $result->fetch_assoc()) { ?>
                <div class="reserva-card">

                    <h2 class="text_reserva">Reserva #<?php echo $nro; ?></h2>
                    <div class="datos-reserva">
                        <div class="datos">
                            <h2>Datos personales</h2>
                            <p><strong>Nombre:</strong> <?php echo $row['nombre']; ?></p>
                            <p><strong>Apellido:</strong> <?php echo $row['apellido']; ?></p>
                            <p><strong>CI:</strong> <?php echo $row['ci']; ?></p>
                            <p><strong>Correo:</strong> <?php echo $row['correo']; ?></p>
                            <p><strong>Teléfono:</strong> <?php echo $row['telefono']; ?></p>
                            <p><strong>Nacionalidad:</strong> <?php echo $row['nacionalidad']; ?></p>
                            <p class="numero_personas"><strong>Número de Personas:</strong> <?php echo $row['numero_personas']; ?></p>
                        </div>

                        <div class="detalles-reserva">
                            <h2>Detalles de reserva</h2>
                            <p><strong>Fecha de reserva:</strong> <?php echo $row['fecha_de_reserva']; ?></p>
                            <p class="proxima_reserva"><strong>Fecha de Ingreso:</strong> <?php echo $row['fecha_ingreso']; ?></p>
                            <p class="fecha_salida"><strong>Fecha de Salida:</strong> <?php echo $row['fecha_salida']; ?></p>
                            <p><strong>Número de Habitación:</strong> <?php echo $row['num_habitacion']; ?></p>
                            <p><strong>Tipo de Habitación:</strong> <?php echo $row['tipo_hab']; ?></p>
                            <p><strong>Número de días:</strong> <?php echo $row['numero_noches']; ?></p>
                            <p><strong>Estado:</strong> <?php echo $row['estado']; ?></p>
                        </div>

                        <div class="acciones">
                            <button class="confirm-btn" id="confirm-<?php echo $row['id']; ?>" onclick="confirmarReserva(<?php echo $row['id']; ?>)">Confirmar Reserva</button>
                            <button class="cancel-btn" onclick="rechazarReserva(<?php echo $row['id']; ?>)">Rechazar Reserva</button>
                        </div>
                    </div>
                </div>
            <?php
                $nro++;
            } ?>
        </div>
    <?php
    } else {
        echo "<h2 style='text-align: center;';>No se encontraron resultados</h2>";
    } ?>
</div>