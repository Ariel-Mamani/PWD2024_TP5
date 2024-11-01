<?php
session_start();
$titulo = "TP 5 - Login";
include_once '../Estructura/header.php';
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
    if($objAbmUsuario->alta($recibido)) {
        $usuario = $objAbmUsuario->buscar($param);
        if (!empty($usuario)) {
            $usuarioRol = ['idusuario' => $usuario[0]->getidusuario(), 'idrol' => 2];
            $objAbmUsuarioRol->alta($usuarioRol);
        }
        $mensaje = $objSession->getMensaje(true);
        header("Location: login.php");
        exit();
    }else{
        $mensaje = $objSession->getMensaje();
        echo "<h1>No</h1>";
        header("Location: login.php");
        exit();
    }
}

?>
