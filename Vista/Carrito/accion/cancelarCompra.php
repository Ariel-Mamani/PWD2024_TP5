<?php

include_once "../../../configuracion.php";
$datos = data_submitted();
$objSession = new Session();
$abmCompra = new AbmCompra();
$array = $abmCompra->mostrarCompra();


if($abmCompra->cancelarCompra($datos)){
    foreach($array as $producto){
        $abmCompra->cancelarProducto($datos);    
    }
    $objSession->cerrarCompra();
    $respuesta = "Compra cancelada";
}else{
    $respuesta = "No se pudo cancelar la compra";
}

echo json_encode($respuesta);


?>

