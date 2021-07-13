<?php
require("PHPMailer.php");
require("SMTP.php");
 $mail = new PHPMailer\PHPMailer\PHPMailer();
 $mail->IsSMTP(); // enable SMTP
 $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
 $mail->SMTPAuth = true; // authentication enabled
 $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
 $mail->Host = "gator4054.hostgator.com";
 $mail->Port = 465; // or 587
 $mail->IsHTML(true);
 $mail->Username = "reforesta@conservamos.org";
 $mail->Password = "NaranjaLima10";
 $mail->SetFrom("reforesta@conservamos.org");
 $mail->Subject = "Asunto del mensaje";
 $mail->Body = "Ingrese el texto del correo electrónico aquí";
 $mail->AddAddress("reytuerto@gmail.com");
 if(!$mail->Send()) {
 echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
 echo "Mensaje enviado correctamente";
 }
?>