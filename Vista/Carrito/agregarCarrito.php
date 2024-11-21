<?php

include_once "../Estructura/header.php";
$datos = data_submitted();
//$objSession = new Session();
$abmCompra = new AbmCompra();

if (!$objSession->validarCompra()){
    $objSession->iniciarCompra();
}

if(!empty($datos)){
    $abmCompra->agregarProducto($datos);

}
?>

