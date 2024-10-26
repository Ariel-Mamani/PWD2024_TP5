<?php
session_start();
$titulo = "TP 5 - Login";
include_once '../Estructura/header.php';
echo "<div class='divtitulo'><h1>{$titulo}</h1>";
$objAbmUsuario = new AbmUsuario();
if(!empty(data_submitted())){
    $recibido = data_submitted();
    $nombreUsuario['usnombre'] = $recibido['usuario'];    
    $listaUsuario = $objAbmUsuario->buscar($nombreUsuario);
    $emailUsuario['usemail'] = $recibido['email'];    
    $listaUsuarioEmail = $objAbmUsuario->buscar($emailUsuario);
    if(empty($listaUsuario) && empty($listaUsuarioEmail)){ // ¿verificamos con nombre de usuario y mail?
        if($objAbmUsuario->alta($recibido)){
            $_SESSION['mensaje'] = "Se ha registrado exitosamente.";
            // Se REDIRIGE al formulario de login si el registro fue exitoso
            header("Location: login.php");
            exit();
        }
    }else{
        $_SESSION['mensaje'] = "El usuario o el email ya están registrados.";
        header("Location: login.php");
        exit();
    }
}

?>
