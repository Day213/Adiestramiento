<?php include "../conexion.php";
session_start();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $cedula = htmlspecialchars($_POST['cedula']);
  $contrasena = htmlspecialchars($_POST['contrasena']);

  $passEncripted = hash('sha256', $contrasena);

  $sql_user = "SELECT * FROM usuario  WHERE cedula = '$cedula' AND contrasena = '$passEncripted'";



  $resultado = $conexion->query($sql_user);

  if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $_SESSION['user_id'] = $fila['id'];
    header('location:./ListarFormulario.php');
  } else {
    echo "error";
  }



  // if (isset($_SESSION['user_id'])) {
  //   header("location: /soporte/tecnicos/dashboard");
}
