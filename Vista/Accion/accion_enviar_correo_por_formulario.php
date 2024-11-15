<?php
//Importar las clases de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Cargar el autoloader de Composer
require '../../vendor/autoload.php';

//Validar que los datos se hayan enviado correctamente
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Obtener los datos del formulario
    $nombre = $_POST['apellido_y_nombre'];
    $ciudad = $_POST['ciudad'];
    $email = $_POST['mail'];
    $comentarios = $_POST['comentarios'];

    //Crear una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);

    try{
        //Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.mail.yahoo.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'dariofuentealba@yahoo.com.ar'; // Tu correo de Yahoo
        $mail->Password   = 'woefxtxooazdvnjx';             // Tu contraseña de aplicación
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        //Remitente
        $mail->setFrom('dariofuentealba@yahoo.com.ar', 'Pelitos');

        //Destinatario (correo ingresado en el formulario)
        $mail->addAddress($email);

        //Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Gracias por contactarnos';
        $mail->Body = "
            <h1>¡Hola, $nombre!</h1>
            <p>Gracias por contactarte con nosotros desde $ciudad.</p>
            <p>Tu mensaje:</p>
            <p><i>$comentarios</i></p>
            <br>
            <p>Nos pondremos en contacto contigo lo antes posible.</p>
            ";

        //Enviar el correo
        $mail->send();
        echo "<script>alert('Correo enviado exitosamente.'); window.location.href='../Paginas/01_reservar.php';</script>";
    }catch (Exception $e){
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }
}else{
    echo "No se recibieron datos del formulario.";
}
