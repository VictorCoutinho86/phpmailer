<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

if(isset($_POST['enviar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];

    try {
        //Server settings
       //$mail->SMTPDebug = 2;               
       $mail->isSMTP();                               
       $mail->Host = "smtp.gmail.com";  
       $mail->SMTPAuth = true;        
       $mail->Username = "victormelo@id.uff.br";
       $mail->Password = "*********"; 
       $mail->SMTPSecure = "tls";               
       $mail->Port = 587;                                 
   
       //Recipients
       $mail->setFrom('victormelo@id.uff.br', 'Victor Coutinho');
       $mail->addAddress($email, $nome);  
       $mail->addReplyTo('fonsa19@hotmail.com');
       $mail->CharSet = 'UTF-8';
       $mail->isHTML(true);     
       $mail->Subject = "Teste de Envio!";
       $mail->msgHTML("<html><center>de: {$nome}<br/>email: {$email}<br/>mensagem: <strong>{$msg}</strong></center></html>");
       $mail->AltBody = "de: {$nome}\nemail: {$email}\nmensagem: {$msg}";
       $mail->send();
       echo 'Message Sent!';
   } catch (Exception $e) {
       echo 'Message could not be sent.';
   }
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teste PHPMailer</title>
</head>
<body>
    <form action="<? $PHP_SELF; ?>" method="POST">
        <input type="text" name="nome" placeholder="Seu nome"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <textarea name="msg" rows="4" cols="50" placeholder="Sua mensagem!"></textarea><br>
        <input type="submit" name="enviar" value="Enviar">
    </form>
</body>
</html>