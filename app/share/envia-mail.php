<?php

require_once VCONFIG.'config.php';
require_once('../publico/vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../publico/vendor/phpmailer/phpmailer/src/Exception.php';
require '../publico/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../publico/vendor/phpmailer/phpmailer/src/SMTP.php';

function EnviaEmail($name, $email, $subject, $message){

   $mail = new PHPMailer(false);  // Passing `true` enables exceptions

   $mail->CharSet = EMAIL_CHARSET; //"UTF-8";
   $mail->SMTPDebug = EMAIL_SMTPDEBUG; //0 produção, 2 debug
   $mail->isSMTP();
   $mail->Host = EMAIL_HOST; //'smtp.gmail.com';
   $mail->SMTPAuth = EMAIL_SMTPAUTH; //true;
   $mail->Username = EMAIL_USER; //'noreply@alphalumen.org.br';
   $mail->Password = EMAIL_PASS; //'AlphaMasterBR';
   $mail->SMTPSecure = EMAIL_SMTPSECURE; //'tls';
   $mail->Port = EMAIL_PORT; //587;
   $mail->setFrom( EMAIL_FROM_EMAIL, EMAIL_FROM_NAME); //'seja.alpha@alphalumen.org.br', 'Processo Seletivo - ALPHA LUMEN');
   $mail->isHTML(EMAIL_ISHTML); //true);
   
   
   $mail->AltBody = "Por favor use um cliente de E-mail que suporte HTML";
   $mail->Subject = utf8_decode($subject); //"Alteracão de Senha - Processo Seletivo - ALPHA LUMEN");
   $mail->addAddress( $email, $name );
   
   $message_out = "
   <html>
   <head>
   <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
   <title>Processo Seletivo</title>
   <style>
       .button {
           background-color: #4CAF50;
           border: none;
           color: white;
           padding: 15px 32px;
           text-align: center;
           text-decoration: none;
           display: inline-block;
           font-size: 16px;
           margin: 4px 2px;
           cursor: pointer;
       }
   </style>
   </head>
   <body>
   <hr class='my-1'>
   <h3 style='color:red;'><strong>NÃO RESPONDA ESTA MENSAGEM, ENDEREÇO UTILIZADO APENAS PARA ENVIO DE NOTIFICAÇÃO</strong></h3>
   <hr class='my-1'>
   <br>
   <p>Olá, <strong>$name</strong></p>
   <p>";
   $message_out .= $message;
   $message_out .= "</p>
      
   <hr class='my-1'>
   
   <br><strong>Plataforma ial360&#176; - ALPHA LUMEN</strong><br>
   <a href='https://ial360.alphalumen.org.br' class='button'>Clique Aqui</a>
   
   <p>Você também pode copiar o link abaixo e colar num navegador web.</p>
   https://ial360.alphalumen.org.br<br><br>
   
   <hr class='my-1'>
 
   <p>Qualquer dúvidas nos envie uma mensagem para seja.alpha@alphalumen.org.br</p><br>
   
   Atenciosamente,<br><br>
   Equipe Alpha<br><br>
   
   
   <hr class='my-1'>
   <h3 style='color:red;'><strong>NÃO RESPONDA ESTA MENSAGEM, ENDEREÇO UTILIZADO APENAS PARA ENVIO DE NOTIFICAÇÃO</strong></h3>
   <hr class='my-1'>";

   $mail->Body = utf8_decode($message_out);
   $mail->send();
  
}


?>