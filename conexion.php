<?php

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$nombre_bd = "gestion_solicitud";


$conexion = new mysqli($servidor, $usuario, $contrasena, $nombre_bd);


if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
"¡Conexión exitosa a la base de datos MySQLi!";
