<?php
include_once '../../configuracion.php';
// Crea el objeto de la sesion
$objSession = new Session();
if(!empty(data_submitted())){
    $recibido = data_submitted();

    if(isset($recibido['cerrarSession']) and $recibido['cerrarSession'] == 1){
        if($objSession->cerrar()){
            header("Location: ".$VISTA."Inicio/principal.php");
            die();
        }
    }

    //carga nombre y pass sin validar aun
    $objSession->iniciar($recibido['usnombre'],$recibido['uspass']);

    if($objSession->validar()){
        // Si es correcto, redirige a la página segura
        header("Location: ".$VISTA."Login/paginaSegura.php");
        die();
    }else{
        // Si es incorrecto, cierra la sesión y redirige al login
        $objSession->cerrar();
        $_SESSION['mensaje'] = "Usuario o contraseña incorrectos.";
        header("Location: ".$VISTA."Login/login.php");
        die();
    }
    ?>

<?php
}
include_once '../Estructura/footer.php';
?>