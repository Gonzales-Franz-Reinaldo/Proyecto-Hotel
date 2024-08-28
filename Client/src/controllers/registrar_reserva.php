<?php 

include '../../../Database/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $ci = $_POST['ci'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $nacionalidad = $_POST['nacionalidad'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $fecha_salida = $_POST['fecha_salida'];
    $numero_personas = $_POST['numero_personas'];
    $id_habitacion = $_POST['id_habitacion'];
    $id_promocion = $_POST['id_promocion'];

    if($id_promocion == '') {
        $id_promocion = 'NULL';
    }

    date_default_timezone_set('America/La_Paz');
    $fecha_reserva =  date('Y-m-d');
    $hora_reserva = date('H:i:s');
    $estado = 'Pendiente';

    // Crear objetos DateTime a partir de las fechas proporcionadas
    $fechaIngresoObj = new DateTime($fecha_ingreso);
    $fechaSalidaObj = new DateTime($fecha_salida);
    // Calcular la diferencia entre las dos fechas
    $diferencia = $fechaIngresoObj->diff($fechaSalidaObj);
    // Obtener el número de días de la diferencia
    $totalDias = $diferencia->days;

    $fecha_confirmacion = date('Y-m-d H:i:s');


    // IMPRIMIR LAS T_VARIABLES PARA VER SI ESTAN INGRESANDO CORRECTAMENTE
    // echo 'Nombre: ' . $nombre . '<br>';
    // echo 'Apellido: ' . $apellido . '<br>';
    // echo 'CI: ' . $ci . '<br>';
    // echo 'Correo: ' . $correo . '<br>';
    // echo 'Telefono: ' . $telefono . '<br>';
    // echo 'Nacionalidad: ' . $nacionalidad . '<br>';
    // echo 'Fecha de reserva'. $fecha_reserva .'<br>';
    // echo 'Hora de reserva'. $hora_reserva .'<br>';
    // echo 'Fecha Ingreso: ' . $fecha_ingreso . '<br>';
    // echo 'Fecha Salida: ' . $fecha_salida . '<br>';
    // echo 'Numero Personas: ' . $numero_personas . '<br>';
    // echo 'Estado'. $estado . '<br>';
    // echo 'ID Habitacion: ' . $id_habitacion . '<br>';
    // echo 'ID Promocion: ' . $id_promocion . '<br>';
    // echo 'Total de días: ' . $totalDias . '<br>';
    // echo 'Fecha de confirmacion: ' . $fecha_confirmacion . '<br>';
    

    $sql = "INSERT INTO reservas (id, nombre, apellido, ci, correo, telefono, nacionalidad, fecha_de_reserva, hora_reserva, fecha_ingreso, fecha_salida, numero_personas, estado, id_habitacion, id_promocion, numero_noches, fecha_confirm) 
    VALUES (NULL, '$nombre', '$apellido', '$ci', '$correo', '$telefono', '$nacionalidad', '$fecha_reserva', '$hora_reserva', '$fecha_ingreso', '$fecha_salida', $numero_personas, '$estado', $id_habitacion, $id_promocion, $totalDias, '$fecha_confirmacion')";

    if ($connect->query($sql) === TRUE) {
        // echo json_encode(['success' => 'Reserva realizada con éxito']);
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }

    $connect->close();
} else {
    echo json_encode(['error' => 'Método no permitido']);
}
?>