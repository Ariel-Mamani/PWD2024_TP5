<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$respuesta = false;

if (isset($data['idcompra'])){
    $objAbmCompra = new AbmCompra();
    $respuesta = $objAbmCompra->cancelarCompra($data);
    if (!$respuesta){
        $mensaje = " La accion CANCELAR No pudo concretarse";
    }
    $retorno['respuesta'] = $respuesta;
    if (isset($mensaje)){
        $retorno['errorMsg']=$mensaje;
    }
}
echo json_encode($retorno);
?>
