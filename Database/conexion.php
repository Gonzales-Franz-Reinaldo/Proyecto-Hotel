<?php

    $server = 'localhost';
    $user = 'root';
    $password = '';
    $dataBase = 'bd_hotel_sucre';

    try{
        $connect = new mysqli($server, $user, $password, $dataBase);
        // echo "Conexión existosa";
    } catch (PDOException $Error){
        echo "Error en la conexión" . $Error->getMessage();
    }

?>