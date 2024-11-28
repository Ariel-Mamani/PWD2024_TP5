<?php

include_once "../Estructura/header.php";
$datos = data_submitted();
//$objSession = new Session();
$abmCompra = new AbmCompra();

if (!$objSession->validarCompra()){
    $objSession->iniciarCompra();
}

if(!empty($datos)){
    if($abmCompra->agregarProducto($datos)){
        echo json_encode(['success' => true]);
    }else{
        echo json_encode(['success' => false, 'message'=> 'No se pudo eliminar el producto.']);
    }
}else{
    echo json_encode(['success'=> false, 'message' => 'Metodo no  permitido']);
}




?>

