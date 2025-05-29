<?php
include "./conexion.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $tipo_solicitud = htmlspecialchars($_POST["tipo_solicitud"]);
    $nombre_solicitante = htmlspecialchars($_POST["nombre_solicitante"]);
    $cantidad_asistente = htmlspecialchars($_POST["cantidad_asistente"]);
    $fecha_aproximada = htmlspecialchars($_POST["fecha_aproximada"]);
    $tema_solicitud = htmlspecialchars($_POST["tema_solicitud"]);
    $telefono = htmlspecialchars($_POST["telefono"]);
    $correo = htmlspecialchars($_POST["correo"]);

    $sql = "INSERT INTO `gestion` (`id`, `tipo_solicitud`, `nombre_solicitante`, `cantidad_asistente`, `fecha_aproximada`, `tema_solicitante`, `telefono`, `correo`) VALUES (NULL, '$tipo_solicitud', '$nombre_solicitante', '$cantidad_asistente', '$fecha_aproximada', '$tema_solicitud', '$telefono', '$correo')";

    $resultado = $conexion->query($sql);

    if ($resultado) {

        header("Location: index.php?exito=1");
        exit;
    } else {
        echo "<p style='color: red; font-weight: bold;'>Error al ingresar los datos: " . $conexion->error . "</p>";
    }

    mysqli_close($conexion);
}
