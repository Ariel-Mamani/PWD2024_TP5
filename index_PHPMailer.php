<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.mail.yahoo.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'dariofuentealba@yahoo.com.ar';                     //SMTP username
    $mail->Password   = 'pvhxdvgsctwaukrv';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('dariofuentealba@yahoo.com.ar', 'Pelitos');
    $mail->addAddress('dario.fuentealba@est.fi.uncoma.edu.ar'); //('CORREO DEL CLIENTE joe@example.net', 'NOMBRE DEL CLIENTE, BORRO EL PARAMETRO SI NO SE EL NOMBRE');     //Add a recipient
    //PUEDO AGREGAR MAS CORREOS
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //ESTOS 3 SON LAS COPIAS
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments ESTOS SON ARCHIVOS QUE ADJUNTO
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Asunto: Respuesta de formulario';

    //$file = fopen('repuesta_mail_contacto.php', 'r');
    //$str = fread ($file, filesize('repuesta_mail_contacto.php'));
    //$str = trim($str);
    //fclose($file);
    $mail->Body = 'Aquí está la respuesta a su consulta en el formulario.';//$str; //'Aquí está la respuesta a su consulta en el formulario.';
    //ALTERNATIVA AL BODY
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Envio de e-mail satisfactorio';
} catch (Exception $e) {
    echo "Error al enviar el e-mail: {$mail->ErrorInfo}";
}