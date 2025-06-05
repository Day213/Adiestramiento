<?php include "../conexion.php";


use PHPMailer\PHPMailer\PHPMailer;


require '../vendor/autoload.php';

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

    $mail = new PHPMailer();
    $mail->isSMTP();
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->SMTPAuth = true;
    $mail->Username = 'chirinoana213@gmail.com';
    $mail->Password = 'iejokxpiekznbaxs';
    $mail->setFrom('chirinoana213@gmail.com', 'Departamento de Adiestramiento y control UNEFM');
    $mail->addReplyTo('adiestramiento@correo.unefm.edu.ve', 'Departamento de adiestramiento.');
    $mail->addAddress($correo, 'Solicitante');

    $mail->isHTML(true);
    $mail->Subject = $asunto;
    $mail->Body    = $cuerpo;


    if (!$mail->send()) {
      echo 'Mailer Error: ' . $mail->ErrorInfo;
      header("Location:./ListarFormulario.php?error=1");
      exit;
    }
    header('location: ./ListarFormulario.php?exito=1');
  }
}





  // $resultado = $conexion->query($sql);
