<?php
include "../conexion.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../loginPHPMailer/PHPMailer-PHPMailer-19debc7/src/Exception.php';
require '../loginPHPMailer/PHPMailer-PHPMailer-19debc7/src/PHPMailer.php';
require '../loginPHPMailer/PHPMailer-PHPMailer-19debc7/src/SMTP.php';

function generarContrasena($longitud = 8)
{
  $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  return substr(str_shuffle($caracteres), 0, $longitud);
}

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $correo = htmlspecialchars($_POST['correo']);
  $sql = "SELECT * FROM usuario WHERE correo = '$correo'";

  $resultado = $conexion->query($sql);
  if ($resultado && $resultado->num_rows > 0) {
    $nuevaContrasena = generarContrasena();
    $passEncripted = hash('sha256', $nuevaContrasena);
    $sqlUpdate = "UPDATE usuario SET contrasena = '$passEncripted' WHERE correo = '$correo'";
    $conexion->query($sqlUpdate);
    // Enviar correo
    $mail = new PHPMailer(true);
    try {
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'chiririnoana213@gmail.com';
      $mail->Password = 'TU_CONTRASEÑA_DE_APLICACION';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port = 465;
      $mail->setFrom('chiririnoana213@gmail.com', 'Soporte');
      $mail->addAddress($correo);
      $mail->isHTML(true);
      $mail->Subject = 'Recuperación de contraseña';
      $mail->Body = 'Tu nueva contraseña es: <b>' . $nuevaContrasena . '</b><br>Por favor, cámbiala después de ingresar.';
      $mail->send();
      $mensaje = '<span style="color:green;">Se ha enviado una nueva contraseña a tu correo.</span>';
    } catch (Exception $e) {
      $mensaje = '<span style="color:red;">No se pudo enviar el correo. Error: ' . $mail->ErrorInfo . '</span>';
    }
  } else {
    $mensaje = '<span style="color:red;">No existe un usuario con ese correo.</span>';
  }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Recuperar Contraseña</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col justify-center items-center bg-gray-100 min-h-screen">
  <div class="mb-8 encabezado">
    <h1 class="mb-4 font-bold text-blue-700 text-2xl text-center">Recuperar Contraseña</h1>
    <?php if ($mensaje) echo $mensaje; ?>
  </div>
  <form action="" method="post" class="bg-white shadow-md px-8 pt-6 pb-8 rounded w-full max-w-sm">
    <div class="mb-4">
      <label for="correo" class="block mb-2 font-bold text-gray-700 text-sm">Correo electrónico</label>
      <input type="email" id="correo" name="correo" required class="shadow px-3 py-2 border rounded focus:shadow-outline focus:outline-none w-full text-gray-700 leading-tight appearance-none" />
    </div>
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded w-full font-bold text-white transition duration-150">Enviar nueva contraseña</button>
  </form>
</body>

</html>
</body>

</html>
</body>

</html>