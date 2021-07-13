<?php
require 'class.phpmailer.php';

try {
	$mail = new PHPMailer(true); //Nueva instancia, con las excepciones habilitadas
	$body             = '<p>Este es un Mensaje de Prueba</p>';
	$body             = preg_replace('/\\\\/','', $body); //Escapar backslashes
	$mail->IsSMTP();                           // Usamos el metodo SMTP de la clase PHPMailer
	$mail->SMTPAuth   = true;                  // habilitado SMTP autentificación
	$mail->Port       = 587;                    // puerto del server SMTP
	$mail->Host       = "smtp.gmail.com"; // SMTP server
	$mail->Username   = "reytuerto@gmail.com";     // SMTP server Usuario
	$mail->Password   = "TecsNorat";            // SMTP server password
	$mail->From       = "reytuerto@gmail.com"; //Remitente de Correo
	$mail->FromName   = "art"; //Nombre del remitente
	$to = "reytuerto@gmail.com"; //Para quien se le va enviar
	$mail->AddAddress($to);
	$mail->Subject  = "Mi primer mensaje con PhpMailer"; //Asunto del correo
	$mail->MsgHTML($body);
	$mail->IsHTML(true); // Enviar como HTML
	$mail->Send();//Enviar
	echo 'El Mensaje a sido enviado.';
} catch (phpmailerException $e) {
	echo $e->errorMessage();//Mensaje de error si se produciera.
}
?>