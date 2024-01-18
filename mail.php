<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_POST)) {

   $mail = new PHPMailer(true);
   $nombre = "Jesus";
   $correo = "jesale.lopro@gmail.com";
   $asunto = "Información desde página web";
   $mensaje = "Prueba";

   try {
      //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'jesus.lopez280402@gmail.com';
      $mail->Password = 'wkfdylemjcmvvuao';
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
  
      $mail->setFrom('jesus.lopez280402@gmail.com', 'Jesús');
      $mail->addAddress('jesale.lopro@gmail.com', 'Alejandro');
  
      $mail->isHTML(true);
      $mail->Subject = 'Asunto del correo';
      $mail->Body = 'Contenido del correo en HTML';
  
      $mail->send();

      echo "Hemos recibido tu mensaje, gracias por escribirnos";
   } catch (Exception $e) {
      echo "Algo ha salido mal";
   }
}
