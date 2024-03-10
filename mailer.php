<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

$mail =  new PHPMailer(true);

//$mail->SMTPDebug = SMTP::DEBUG_SERVER;  #Linea de comando para verificar algún error con la conexion con el servidor SMTP.

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp-mail.outlook.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "foroecochange@outlook.com";
$mail->Password = "eco.change.2";

$mail->isHTML(true);

$mail->CharSet = 'UTF-8';

return $mail;