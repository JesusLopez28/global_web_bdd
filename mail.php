<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_POST)) {

   $mail = new PHPMailer(true);
   $nombre = trim($_POST['name']);
   $correo = trim($_POST['email']);
   $asunto = "Información desde página web";
   $mensaje = trim($_POST['message']);

   try {
      //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->isSMTP();
      $mail->Host = 'smtp.hostinger.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'gerencia@invict.mx';
      $mail->Password = 'HigieneLaboral23$';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587;

      $mail->setFrom('pagina@invict.mx');
      $mail->addAddress('contacto@invict.mx');

      $mail->isHTML(true);
      $mail->Subject = utf8_decode($asunto);
      $mail->Body = 'Nombre:'.$nombre.
      '<br>Correo:'.$correo.
      '<br>Mensaje:'.$mensaje;
      $mail->send();

      echo "Hemos recibido tu mensaje, gracias por escribirnos";
   } catch (Exception $e) {
      echo "Algo ha salido mal";
   }
}
