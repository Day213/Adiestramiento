<?php

$servidor = "localhost";
// $servidor = "https://q914mbk0-3306.use2.devtunnels.ms/";
$usuario = "root";
$contrasena = "";
$nombre_bd = "gestion_solicitud";


$conexion = new mysqli($servidor, $usuario, $contrasena, $nombre_bd);


if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
"¡Conexión exitosa a la base de datos MySQLi!";
