<?php
    include_once "../../configuracion.php";
    $objSession = new Session();
    if(!$objSession->validar()){
        header("Location: ./login.php");
    }else{
        $titulo = "TP 5 - Login ";
        include_once '../Estructura/header.php';
    }
?>

<h1>Header Seguro</h1>