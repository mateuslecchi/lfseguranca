<?php
require '../config.inc.php';
require 'assets/phpmailer/src/Exception.php';
require 'assets/phpmailer/src/PHPMailer.php';
require 'assets/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

is_null($_POST['wpp'])? $_POST['wpp']='Não':$_POST['wpp']='Sim';
empty($_POST['empresa'])? $_POST['empresa']='Nao informado':$_POST['empresa']=$_POST['empresa'];
empty($_POST['cnpj'])? $_POST['cnpj']='Nao informado':$_POST['cnpj']=$_POST['cnpj'];

//SMTP needs accurate times, and the PHP time zone MUST be set
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_OFF;
//Set the hostname of the mail server
$mail->Host = $host;
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = $port;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication
$mail->Username = $emailAc;
//Password to use for SMTP authentication
$mail->Password = $emailPass;
//Set who the message is to be sent from
$mail->setFrom($emailSent, utf8_decode('LF Segurança e Engenharia Ocupacional'));
//Set who the message is to be sent to
$mail->addAddress($emailRec, utf8_decode('LF Segurança e Engenharia Ocupacional'));
//Set the subject line
$mail->Subject = 'Contato de '.utf8_decode($_POST['name']);
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML('
    <strong>Nome:</strong> '.utf8_decode($_POST['name']).'<br>
    <strong>Email:</strong> '.$_POST['email'].'<br>
    <strong>Empresa:</strong> '.utf8_decode($_POST['empresa']).'<br>
    <strong>CNPJ:</strong> '.$_POST['cnpj'].'<br>
    <strong>Contato:</strong> '.$_POST['fone'].'<br>
    <strong>WhatsApp:</strong> '.utf8_decode($_POST['wpp']).'<br>
    <strong>Servi&ccedil;o:</strong> '.utf8_decode($_POST['service']).'<br>
    <strong>Messagem:</strong> '.utf8_decode($_POST['message'])
);
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
    header('Location: https://lfseguranca.com.br/');
}