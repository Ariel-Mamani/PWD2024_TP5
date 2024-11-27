<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Random\Engine\Secure;

// Incluir el autoloader de Composer
require '../../../vendor/autoload.php';
include_once '../../../configuracion.php';

error_log("Inicio del script mail_cancelacion_compra.php");

// Obtener la sesión y la información del usuario
$objSession = new Session();
error_log("Se instanció Session");

$user = null;
$correo = null;
$idcompra = null;

try {
    //$user = $data['usnombre'];
    $correo = $objSession->getUsuario()->getusmail();
    $idcompra = $data['idcompra'];
    error_log("Usuario obtenido: $user, Correo: $correo, ID Compra: $idcompra");
} catch (Exception $e) {
    error_log("Error al obtener datos de la sesión: " . $e->getMessage());
}

$objAbmCompra = new AbmCompra();

// Configurar el correo
$mail = new PHPMailer(true);
try {
    error_log("Inicio de configuración de PHPMailer");

    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.mail.yahoo.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'dariofuentealba@yahoo.com.ar';
    $mail->Password = 'ksqnvhactxgsvqwc';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    error_log("Configuración SMTP completada");

    // Remitente
    $mail->setFrom('dariofuentealba@yahoo.com.ar', 'Pelitos');
    $mail->addAddress($correo, $user); // El correo del usuario
    error_log("Destinatario configurado: $correo ($user)");

    // Contenido del correo
    $mail->CharSet = 'UTF-8';  // Establecer la codificación a UTF-8, sino sale todo feo
    $mail->isHTML(true);
    $mail->Subject = 'Confirmación de Cancelación';

    // Crear el cuerpo del correo con los detalles de la compra
    $body = "<h2>¡Hola!</h2>";
    $body .= "<p>Su compra ha sido cancelada.</p>";
    $body .= "<p>Gracias por tu compra. ¡Esperamos verte pronto!</p>";
    error_log("Cuerpo del correo creado");

    $mail->Body = $body;

    // Enviar el correo
    $mail->send();
    error_log("Correo enviado con éxito");
    echo 'Correo enviado con éxito';
} catch (Exception $e) {
    error_log("Error al enviar el correo: {$mail->ErrorInfo}");
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
} catch (Throwable $t) {
    error_log("Error inesperado: " . $t->getMessage());
}
