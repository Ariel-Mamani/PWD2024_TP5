<?php
$titulo = "TP 5 - Login";
include_once '../Estructura/header.php';

// Crea el objeto de la sesion
$objSession = new Session();
if(!empty(data_submitted())){
    $recibido = data_submitted();
    if(isset($recibido['salirSession']) and $recibido['salirSession'] == 1){
        $objSession->cerrar();
        header("Location: ../Inicio/principal.php");
    }

    //carga nombre y pass sin validar aun
    $objSession->iniciar($recibido['usuario'],$recibido['clave_md5']);

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