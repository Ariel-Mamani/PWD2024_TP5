<?php
//session_start();

$titulo = "TP 5 - Login";
include_once '../Estructura/header.php';
echo "<div class='divtitulo'><h1>{$titulo}</h1>";
if(!empty(data_submitted())){
    $recibido = data_submitted();
    $objUsuario = new AbmUsuario;
    // Crea el objeto de la sesion
    $objSession = new Session();
    $param['usnombre'] = $recibido['usuario'];
    $param['uspass']= $recibido['clave_md5'];
    //carga nombre y pass sin validar aun
    $objSession->iniciar($param['usnombre'],$param['uspass']);

    if($objSession->validar()){
        // Si es correcto, redirige a la página segura
        header("Location: ./paginaSegura.php");
    }else{
        // Si es incorrecto, cierra la sesión y redirige al login
        $objSession->cerrar();
        $_SESSION['mensaje'] = "Usuario o contraseña incorrectos.";
        header("Location: ./login.php");
    }
    ?>

<?php
}
include_once '../Estructura/footer.php';
?>