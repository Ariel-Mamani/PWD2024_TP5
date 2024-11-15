<?php
// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Crear conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdcarritocompras";

// Conectar a la base de datos
$conn = new mysqli ($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener correos de los usuarios habilitados
$sql = "SELECT usmail FROM usuario WHERE usdeshabilitado IS NULL";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Crear una instancia de PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Configuración del servidor SMTP
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host       = 'smtp.mail.yahoo.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'dariofuentealba@yahoo.com.ar';
        $mail->Password   = 'ahjoxjgftksziwsi';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // Remitente del correo
        $mail->setFrom('dariofuentealba@yahoo.com.ar', 'Pelitos');

        // Agregar destinatarios de la base de datos
        while ($row = $result->fetch_assoc()) {
            $mail->addAddress($row['usmail']);
        }

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Asunto: Respuesta de formulario';

        // Cargar el contenido del archivo respuesta_mail_contacto.php
        $file = 'respuesta_mail_contacto.php';
        if (file_exists($file) && is_readable($file)) {
            $mail->Body = trim(file_get_contents($file));
        } else {
            throw new Exception("El archivo $file no existe o no se puede leer.");
        }

        // Enviar el correo
        $mail->send();
        echo 'Envio de e-mail satisfactorio';
    } catch (Exception $e) {
        echo "Error al enviar el e-mail: {$mail->ErrorInfo}";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    echo "No se encontraron usuarios habilitados en la base de datos.";
}
