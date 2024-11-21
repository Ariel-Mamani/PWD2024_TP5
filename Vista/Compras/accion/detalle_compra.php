<?php
include_once "../../Estructura/header.php.php";
$data = data_submitted();

$arreglo_salida =  array();
if (isset($data['idcompra'])){
    $objAbmCompraItem = new AbmCompraItem();
    $listaCompraItem = $objAbmCompraItem->buscar($data);
    if(count($listaCompraItem) > 0){
        foreach ($listaCompraItem as $objCompraItem ){
            $arrCompraItem["idcompraitem"]  = $objCompraItem->getIdCompraItem();
            $arrCompraItem["idproducto"]    = $objCompraItem->getProducto()->getIdProducto();
            $arrCompraItem['idcompra']      = $objCompraItem->getIdCompra();
            $arrCompraItem["cicantidad"]    = $objCompraItem->getCiCantidad();
            array_push($arreglo_salida,$arrCompraItem);
        } 
    }     
}
echo json_encode($arreglo_salida);








/*
if (isset($data['idcompra'])){
    $objC = new AbmCompra();
    $respuesta = $objC->modificacion($data);
    
    if (!$respuesta){

        $sms_error = " La accion  MODIFICACION No pudo concretarse";
        
    }else $respuesta =true;
    
}
$retorno['respuesta'] = $respuesta;
if (isset($mensaje)){
    
    $retorno['errorMsg']=$sms_error;
    
}
echo json_encode($retorno);*/
?>