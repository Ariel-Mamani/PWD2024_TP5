<?php
include_once '../../configuracion.php';
// Crea el objeto de la sesion
$objSession = new Session();
if(!empty(data_submitted())){
    $recibido = data_submitted();

    if((isset($recibido['cerrarSession'])) and ($recibido['cerrarSession'] == '1')){
        if($objSession->cerrar()){
            header("Location: ".$VISTA."Inicio/principal.php");
            die();
        }
    }
    $auto = 'assadasdasdasddsadsdsa';
    //carga nombre y pass sin validar aun
    if(isset($recibido['usnombre']) and isset($recibido['uspass'])){
        $respuesta = $objSession->iniciar($recibido['usnombre'],$recibido['uspass']);
        if($respuesta){
            // Si es correcto, redirige a la página segura
            header("Location: ".$VISTA."Login/paginaSegura.php");
            die();
        }else{
            // Si sacamos la instancia del objetoSesion no llega el mensaje al login
            $objSession = new Session(); 
            $mensaje = $objSession->getMensaje($respuesta);            
            // Guarda los datos de la sesión antes de redirigir porque sino se pierde el mensaje
            session_write_close();
            // Si es incorrecto, cierra la sesión y redirige al login
            $objSession->cerrar();
            header("Location: ".$VISTA."Login/login.php");
        }
    }
}
?>