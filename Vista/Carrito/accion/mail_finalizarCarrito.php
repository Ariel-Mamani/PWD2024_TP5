<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Incluir el autoloader de Composer
require '../../../vendor/autoload.php';

//Obtener la sesion y la informacion del usuario
include_once '../../Estructura/header.php';
$user = $objSession->getUsuario()->getusnombre();
$correo = $objSession->getUsuario()->getusmail();
$idcompra = $objSession->getCompra()->getIdCompra();
$objAbmCompra = new AbmCompra();
$carrito = $objAbmCompra->mostrarCompra();

//Verificar si la compra es valida
if (!$objSession->validarCompra()) {
    echo "No hay productos en el carrito.";
    exit;
}

//Configurar el correo
$mail = new PHPMailer(true);
try {
    //Configuracion del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.mail.yahoo.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'dariofuentealba@yahoo.com.ar';
    $mail->Password = 'tngyquqcynxnkpqk';
    //$mail->SMTPSecure = 'ssl';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    //Remitente
    $mail->setFrom('dariofuentealba@yahoo.com.ar', 'Pelitos');
    $mail->addAddress($correo, $user); //El correo del usuario

    //Contenido del correo
    $mail->CharSet = 'UTF-8';  //Establecer la codificación a UTF-8, sino sale todo feo
    $mail->isHTML(true);
    $mail->Subject = 'Confirmación de Compra';
    
    //Crear el cuerpo del correo con los detalles de la compra
    $body = "<h2>¡Hola, $user!</h2>";
    $body .= "<p>Gracias por tu compra en nuestra tienda. Aquí están los detalles:</p>";
    $body .= "<p><b>Compra Nro:</b> $idcompra</p>";
    $body .= "<p><b>Productos:</b></p><ul>";

    foreach ($carrito as $item) {
        $body .= "<li>" . $item['pronombre'] . " - Cantidad: " . $item['cicantidad'] . " - Precio: $" . $item['proprecio'] . "</li>";
    }
    
    $body .= "</ul>";
    $body .= "<p><b>Total:</b> $" . number_format(($item['proprecio'] * $item['cicantidad']), 2) . "</p>";
    $body .= "<p>Gracias por tu compra. ¡Esperamos verte pronto!</p>";

    $mail->Body = $body;

    //Enviar el correo
    $mail->send();
    echo 'Correo enviado con éxito';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}