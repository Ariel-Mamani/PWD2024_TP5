<?php
session_start();
$titulo = "TP 5 - Login";
include_once '../Estructura/header_N.php';
echo "<div class='divtitulo'><h1>{$titulo}</h1>";
$objSession = new Session();
$objAbmUsuario = new AbmUsuario();
$objAbmUsuarioRol = new AbmUsuarioRol();
if(!empty(data_submitted())){
    $recibido = data_submitted();
    $param = Array();
    $param['usnombre']  = $recibido['usnombre'];
    $param['usmail']    = $recibido['usmail'];  
    $listaUsuario = $objAbmUsuario->buscar($param);
    if($objAbmUsuario->alta($recibido)){
        // Cuando se cargue el usuario lo busco
        $usuario = $objAbmUsuario->buscar($param);
        if(!empty($usuario)){
            // Le doy un rol y lo cargo a la tabla usuarioRol
            $usuarioRol = ['idusuario' => $usuario[0]->getidusuario(), 'idrol' => 4];
            $objAbmUsuarioRol->alta($usuarioRol);
        }
        $mensaje = $objSession->getMensaje(true);
        header("Location: ".$VISTA."Login/login.php");
        die();
    }else{
        $mensaje = $objSession->getMensaje();
        echo "<h1>No</h1>";
        header("Location: login.php");
        die();
    }
}

?>
