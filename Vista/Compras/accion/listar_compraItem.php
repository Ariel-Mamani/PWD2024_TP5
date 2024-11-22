<?php 
include_once "../../Estructura/header.php";
$data = data_submitted();
$param['idcompraestadotipo'] = 1; //Compra ingresada
$objAbmCompraEstado = new AbmCompraEstado();
$listaCompraEstado = $objAbmCompraEstado->buscar($param);
$listaCompra = array();
if(count($listaCompraEstado) > 0){
    foreach($listaCompraEstado as $objCompraEstado){
        if( $objCompraEstado->getCeFechaFin() == NULL){   
            array_push($listaCompra, $objCompraEstado->getCompra());
        }
    }
}
$arreglo_salida =  array();
foreach ($listaCompra as $elem ){
    $objAbmCompraItem = new AbmCompraItem();
    $param['idcompra']  = $elem->getIdCompra();
    $listaCompraItem = $objAbmCompraItem->buscar($param);
    if(count($listaCompraItem) > 0){
        $nuevo = array();
        foreach ($listaCompraItem as $objCompraItem ){
            $arrCompraItem["idcompraitem"]  = $objCompraItem->getIdCompraItem();
            $arrCompraItem["idproducto"]    = $objCompraItem->getProducto()->getIdProducto();
            $arrCompraItem['idcompra']      = $objCompraItem->getCompra()->getIdCompra();
            $arrCompraItem["cicantidad"]    = $objCompraItem->getCiCantidad();
            array_push($nuevo,$arrCompraItem);
        }
        $nuevoElem['item'] = $nuevo;
    }
    $nuevoElem['idcompra']  = $elem->getIdCompra();
    $nuevoElem["cofecha"]   = $elem->getCoFecha();
    $nuevoElem["idusuario"] = $elem->getUsuario()->getidusuario();
    $nuevoElem["usnombre"]  = $elem->getUsuario()->getusnombre();
    array_push($arreglo_salida,$nuevoElem);
}
//var_dump($arreglo_salida);
echo json_encode($arreglo_salida);
?>