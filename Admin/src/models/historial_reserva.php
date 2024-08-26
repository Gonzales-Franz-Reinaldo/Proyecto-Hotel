<?php

include "../../../Database/conexion.php";


?>

<div class="historial-reservas">
    <h1>Historial de Reservas Confirmadas</h1>

    <div class="buscar-reservas">
        <!-- Formulario para búsqueda -->
        <form id="formBusqueda" action="javascript:void(0);" onsubmit="return realizarBusqueda();">
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
            <select id="tipoHabitacion" class="select-ordenar" name="tipoHabitacion" onchange="ordenarPorTipoHabitacion()">
                <option value="">Ordenar por tipo de habitación</option>
                <option value="Simple">Simple</option>
                <option value="Especial">Especial</option>
                <option value="Familiar">Familiar</option>
                <option value="Matrimonial">Matrimonial</option>
            </select>

            <!-- Selector de ordenación por fecha de modificación -->
            <select id="ordenarTipo" class="select-ordenar" name="ordenarTipo" onchange="ordenarPorTipo()">
                <option value="">Ver reservas por..</option>
                <option value="fecha_confirm">Fecha de confirmación</option>
                <option value="fecha_ingreso">Fecha de entrada</option>
                <option value="fecha_salida">Fecha de salida</option>
            </select>

        </div>
    </div>

    <?php
    $sql = "SELECT *, r.id, r.fecha_de_reserva, r.estado AS 'estado_reserva', h.tipo_hab, f.id AS 'id_factura' 
        FROM reservas r LEFT JOIN habitacion h ON r.id_habitacion = h.id_habitacion 
        LEFT JOIN factura_pago f ON r.id = f.id_reserva  
        WHERE r.estado = 'Confirmada'";



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
            $sql .= " AND r.fecha_de_reserva = '$fecha'";
        }
    }

    if(isset($_GET['tipoHabitacion'])){

        if ($_GET['tipoHabitacion'] !== '') {
            $tipoHabitacion = $_GET['tipoHabitacion'];
            $sql .= " AND h.tipo_hab = '$tipoHabitacion'";
        }
    }

    if (isset($_GET['ordenarTipo'])) {
        if ($_GET['ordenarTipo'] !== '') {
            // Lista blanca de columnas permitidas para ordenar
            if ($_GET['ordenarTipo'] == 'fecha_confirm') {
                $sql .= " ORDER BY r.fecha_de_reserva DESC";

            } else if ($_GET['ordenarTipo'] == 'fecha_ingreso') {
                
                $sql .= " ORDER BY r.fecha_ingreso ASC";
            } else if ($_GET['ordenarTipo'] == 'fecha_salida') {

                $sql .= " ORDER BY r.fecha_salida ASC";
            }
        }
    }


    $result = $connect->query($sql);

    if ($result->num_rows > 0) {

    ?>
        <div class="reservas-lista">
            <?php
            $num = 1;
            while ($row = $result->fetch_assoc()) { ?>
                <div class="reserva-card">
                    <h2>Reserva #<?php echo $num; ?></h2>
                    <div class="detalles">
                        <div class="datos">
                            <p><strong>Fecha de reserva: </strong> <?php echo $row['fecha_de_reserva'] ?></p>
                            <p class="fecha_ingreso"><strong>Fecha de Ingreso: </strong> <?php echo $row['fecha_ingreso'] ?></p>
                            <p class="fecha_salida"><strong>Fecha de Salida: </strong> <?php echo $row['fecha_salida'] ?></p>
                            <p><strong>Tipo de Habitación: </strong> <?php echo $row['tipo_hab'] ?></p>
                            <p><strong>Número de Personas: </strong> <?php echo $row['numero_personas'] ?></p>
                            <p><strong>Estado: </strong> <?php echo $row['estado_reserva'] ?></p>
                            <p class="fecha_confirm"><strong>F.Confirm: </strong> <?php echo $row['fecha_confirm'] ?></p>
                        </div>
                        <div class="cliente">
                            <i class="fa-solid fa-user"></i>
                            <p><strong>Nombre:</strong> <?php echo $row['nombre'] ?> <?php echo $row['apellido'] ?></p>

                        </div>
                    </div>
                    <div class="acciones">
                        <!-- validar si la reserva tiene factura -->
                        <?php if ($row['id_factura'] == null) {  ?>
                            <button class="generar-factura-btn" onclick="generarFactura(<?php echo $row['id'] ?>)">Generar Factura de Pago</button>
                        <?php } else { ?>

                            <button class="visualizar-factura-btn" onclick="visualizarFactura(<?php echo $row['id'] ?>)">Visualizar Factura de Pago</button>
                        <?php } ?>
                    </div>
                </div>

            <?php
                $num++;
            }
            ?>

        </div>
    <?php
    } else {
        echo "<h2 style='text-align: center;';>No se encontraron resultados</h2>";
    }
    ?>
</div>