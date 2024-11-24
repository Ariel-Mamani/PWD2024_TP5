<?php
include_once "../../../configuracion.php";
$data = data_submitted();
$respuesta = false;
//if(!empty($data)){
    $objAbmCompra = new AbmCompra();
    if($objAbmCompra->finalizar()){
        $respuesta = "Compra Finalizada";
    }else{
        $respuesta = "Error - No se cerro la compra";
    }
//}
echo json_encode($respuesta);

  
    

