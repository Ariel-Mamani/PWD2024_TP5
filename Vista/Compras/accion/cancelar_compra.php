<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$respuesta = false;

if (isset($data['idcompra'])){
    $objAbmCompra = new AbmCompra();
    if($objAbmCompra->cancelarCompra($data)){
        $respuesta = "Compra cacelada";
    }else{
        $respuesta = "Error - No se cancelo la compra";
    }
}
echo json_encode($respuesta);

?>