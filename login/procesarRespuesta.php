<?php include "../conexion.php";

$correo = htmlspecialchars($_GET["correo"]);
$asunto = htmlspecialchars($_GET["asunto"]);
$cuerpo = htmlspecialchars($_GET["cuerpo"]);
$id_gestion = htmlspecialchars($_GET["id"]);

$sql_gestion = "UPDATE `gestion` SET `status` = '1' WHERE `gestion`.`id` = $id_gestion";

$respuesta = $conexion->query($sql_gestion);
if ($respuesta === true) {
  $sql = "INSERT INTO respuesta (`id`, `gestion_id`, `correo`, `asunto`, `cuerpo`) VALUES (NULL, $id_gestion, '$correo', '$asunto', '$cuerpo')";
  $respuestaaa = $conexion->query($sql);
  if ($respuestaaa === true) {
    header('location: ./ListarFormulario.php?exito=1');
  }
}





  // $resultado = $conexion->query($sql);
