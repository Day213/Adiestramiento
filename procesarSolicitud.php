<?php
include "./conexion.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $tipo_solicitud = htmlspecialchars($_POST["tipo_solicitud"]);
    $nombre_solicitante = htmlspecialchars($_POST["nombre_solicitante"]);
    $cantidad_asistente = htmlspecialchars($_POST["cantidad_asistente"]);
    $fecha_aproximada = htmlspecialchars($_POST["fecha_aproximada"]);
    $tema_solicitante = htmlspecialchars($_POST["tema_solicitante"]);
    $telefono = htmlspecialchars($_POST["telefono"]);
    $correo = htmlspecialchars($_POST["correo"]);


    $sql = "INSERT INTO `gestion` (`id`, `tipo_solicitud`, `nombre_solicitante`, `cantidad_asistente`, `fecha_aproximada`, `tema_solicitante`, `telefono`, `status`, `correo`) VALUES (NULL, '$tipo_solicitud', '$nombre_solicitante', '$cantidad_asistente', '$fecha_aproximada', '$tema_solicitante', '$telefono', 0, '$correo')";

    $resultado = $conexion->query($sql);

    if ($resultado) {
        $mail = new PHPMailer();
        $mail->isSMTP();
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = 'desarrollodie@correo.unefm.edu.ve';
        $mail->Password = '<ubM9=jhV76P4yF<';
        $mail->setFrom('desarrollodie@correo.unefm.edu.ve', 'Departamento de Adiestramiento y control UNEFM');
        $mail->addReplyTo('adiestramiento@correo.unefm.edu.ve', 'Departamento de adiestramiento.');
        $mail->addAddress($correo, 'Solicitante');

        $mail->isHTML(true);
        $mail->Subject = 'Gestion de solicitud para el ' . $tipo_solicitud . ' de ' . $tema_solicitante;
        $mail->Body    = '<h1>Su solicitud ha sido enviada exitosamente</h1></br><p>Tan pronto nos sea posible le responderemos, validaremos si la fecha aproximada <b>' . $fecha_aproximada . '</b>, está disponible, muchas gracias.</p>';
        $mail->AltBody = 'This is a plain-text message body';
        $mail->send();

        $mail2 = new PHPMailer();
        $mail2->isSMTP();
        // $mail2->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail2->Host = 'smtp.gmail.com';
        $mail2->Port = 465;
        $mail2->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail2->SMTPAuth = true;
        $mail2->Username = '.com';
        $mail2->Password = 'iejokxpiekznbaxs';
        $mail2->setFrom('desarrollodie@correo.unefm.edu.ve', 'Departamento de Adiestramiento y control UNEFM');
        $mail2->addReplyTo('adiestramiento@correo.unefm.edu.ve', 'Departamento de adiestramiento.');
        $mail2->addAddress('freddyskull11@gmail.com', 'Administrador');
        $mail2->isHTML(true);
        $mail2->Subject = 'Nueva solicitud recibida: ' . $tipo_solicitud . ' de ' . $tema_solicitante;
        $mail2->Body    = '<h1>Se ha recibido una nueva solicitud</h1></br>
        <p>Solicitante: <b>' . $nombre_solicitante . '</b><br>
        Correo: <b>' . $correo . '</b><br>
        Fecha aproximada: <b>' . $fecha_aproximada . '</b><br>
        Tipo de solicitud: <b>' . $tipo_solicitud . '</b><br>
        Nombre de solicitante: <b>' . $nombre_solicitante . '</b><br>
        Cantidad de solicitante: <b>' . $cantidad_asistente . '</b><br>
        Tema: <b>' . $tema_solicitante . '</b><br>
        Teléfono: <b>' . $telefono . '</b><br>
        </p>';
        $mail2->AltBody = 'Nueva solicitud recibida.';

        if (!$mail2->send()) {
            echo 'Mailer Error: ' . $mail2->ErrorInfo;
            header("Location: index.php?error=1");
            exit;
        }

        header("Location: index.php?exito=1");
        exit;
    } else {
        echo "<p style='color: red; font-weight: bold;'>Error al ingresar los datos: " . $conexion->error . "</p>";
    }
    mysqli_close($conexion);
}
