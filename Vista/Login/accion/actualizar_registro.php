<?php
include_once "../../../configuracion.php";
session_start();
$titulo = "TP 5 - Login";

echo "<div class='divtitulo'><h1>{$titulo}</h1>";
$objSession = new Session();
$objAbmUsuario = new AbmUsuario();
$objAbmUsuarioRol = new AbmUsuarioRol();

if(!empty(data_submitted())){
    
    
    $recibido = data_submitted();
    $objUsuario = $objSession->getUsuario();
    $objUsuario->setusnombre($recibido['usnombre']);
    $objUsuario->setusmail($recibido['usmail']);
    $objUsuario->setuspass($recibido['uspass']);
    if($objUsuario->modificar()){
        $mensaje = $objSession->getMensaje(true);
        header("Location: ".$VISTA."Login/paginaSegura.php");
        die();
    }else{
        $mensaje = $objSession->getMensaje();
        echo "<h1>No</h1>";
        header("Location: login.php");
        die();
    }
}

?>
