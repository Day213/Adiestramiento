<?php
include "./conexion.php";

// Ejemplo de envío de correo con PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './loginPHPMailer/PHPMailer-PHPMailer-19debc7/src/Exception.php';
require './loginPHPMailer/PHPMailer-PHPMailer-19debc7/src/PHPMailer.php';
require './loginPHPMailer/PHPMailer-PHPMailer-19debc7/src/SMTP.php';



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
        // AQUI VA LO DE EL ENVIO DEL COREO

        // $mail = new PHPMailer(true);

        // try {
        //     // Configuración del servidor SMTP
        //     $mail->isSMTP();
        //     $mail->Host       = 'smtp.gmail.com';
        //     $mail->SMTPAuth   = true;
        //     $mail->Username   = 'chiririnoana213@gmail.com'; // Tu 
        //     $mail->Password   = 'iejo kxpi ekzn baxs';
        //     $mail->Port = 465;
        //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //     // Remitente y destinatario
        //     $mail->setFrom('chirinoana213@gmail.com', 'day');
        //     $mail->addAddress('feddyskull11@gmail.com', 'fredy');

        //     // Contenido del correo
        //     $mail->isHTML(true);
        //     $mail->Subject = 'Asunto del correo';
        //     $mail->Body    = 'Este es el <b>mensaje</b> de prueba usando PHPMailer.';

        //     $mail->send();
        //     echo 'El mensaje ha sido enviado correctamente';
        // } catch (Exception $e) {
        //     echo "No se pudo enviar el mensaje. Error: {$mail->ErrorInfo}";
        // }
        header("Location: index.php?exito=1");
        exit;
    } else {
        echo "<p style='color: red; font-weight: bold;'>Error al ingresar los datos: " . $conexion->error . "</p>";
    }

    mysqli_close($conexion);
}
