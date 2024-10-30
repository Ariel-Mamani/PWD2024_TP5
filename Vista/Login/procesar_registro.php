<?php
session_start();
$titulo = "TP 5 - Login";
include_once '../Estructura/header.php';
echo "<div class='divtitulo'><h1>{$titulo}</h1>";
$objSession = new Session();
$objAbmUsuario = new AbmUsuario();
if(!empty(data_submitted())){
    $recibido = data_submitted();
    $param = Array();
    $param['usnombre']  = $recibido['usnombre'];
    $param['usmail']    = $recibido['usmail'];  
    $listaUsuario = $objAbmUsuario->buscar($param);
    if(empty($listaUsuario)){ // ¿verificamos con nombre de usuario y mail?
        if($objAbmUsuario->alta($recibido)){
            $mensaje = $objSession->getMensaje(true);
            // Se REDIRIGE al formulario de login si el registro fue exitoso
            echo "<h1>SI</h1>";
            header("Location: login.php");
            exit();
        }
    }else{
        $mensaje = $objSession->getMensaje();
        echo "<h1>No</h1>";
        header("Location: login.php");
        exit();
    }
}

?>
