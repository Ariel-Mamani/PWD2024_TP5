<?php

include_once "../../../configuracion.php";
$datos = data_submitted();
$objSession = new Session();
$abmCompra = new AbmCompra();

if (!$objSession->validarCompra()){
    $objSession->iniciarCompra();
}

if(!empty($datos)){
    if($abmCompra->agregarProducto($datos)){
        $respuesta = "producto agregado al carrito";
    }else{
        $respuesta = "No se agrego al carrito";
    }
}
echo json_encode($respuesta);
?>

