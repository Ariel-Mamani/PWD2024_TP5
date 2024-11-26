<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$respuesta = false;

if (isset($data['idcompra'])){
    $objAbmCompra = new AbmCompra();
    if($objAbmCompra->avanzarCompra($data)){
        $respuesta = "Compra avanzada";
    }else{
        $respuesta = "Error - No se avanzo la compra";
    }
}
echo json_encode($respuesta);

?>