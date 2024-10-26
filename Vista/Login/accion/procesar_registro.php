<?php
session_start();
$titulo = "TP 5 - Login";
include_once '../../Estructura/header.php';
echo '<div class="divtitulo"> <h1>';
echo $titulo.'</h1></div>';
$objAbmUsuario = new AbmUsuario();
if(!empty(data_submitted())){
    $recibido = data_submitted();
    $nombreUsuario['usnombre'] = $recibido['usuario'];    
    $listaUsuario = $objAbmUsuario->buscar($nombreUsuario);
    $emailUsuario['usemail'] = $recibido['email'];    
    $listaUsuarioEmail = $objAbmUsuario->buscar($emailUsuario);
    if(empty($listaUsuario) && empty($listaUsuarioEmail)){ // ¿verificamos con nombre de usuario y mail?
        if($objAbmUsuario->alta($recibido)){
            $mensaje = "Se a registrado exitosamente.";
            // Se REDIRIGE al formulario de login si el registro fue exitoso
            header("Location: login.php");
            exit();
        }
    }else{
        $mensaje = "Esos datos ya se encuentran en la base de datos";
    }
}

?>
