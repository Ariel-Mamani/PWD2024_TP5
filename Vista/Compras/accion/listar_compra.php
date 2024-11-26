<?php 
include_once "../../../configuracion.php";
$data = data_submitted();
if(empty($data)){
    $param['idcompraestadotipo'] = 2; //Compra ingresada
}else{
    $param = $data;
}
$cetNombre = '';
$objAbmCompraEstado = new AbmCompraEstado();
$listaCompraEstado = $objAbmCompraEstado->buscar($param);
$listaCompra = array();
if(count($listaCompraEstado) > 0){
    $cetNombre = $listaCompraEstado[0]->getCompraEstadoTipo()->getcetdescripcion();
    foreach($listaCompraEstado as $objCompraEstado){
        if( $objCompraEstado->getCeFechaFin() == NULL){   
            array_push($listaCompra, $objCompraEstado->getCompra());
        }
    }
}
$arreglo_salida =  array();
foreach ($listaCompra as $elem ){
 /*   $objAbmCompraItem = new AbmCompraItem();
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
    }*/
    $nuevoElem['idcompra']          = $elem->getIdCompra();
    $nuevoElem["cofecha"]           = $elem->getCoFecha();
    $nuevoElem["idusuario"]         = $elem->getUsuario()->getidusuario();
    $nuevoElem["usnombre"]          = $elem->getUsuario()->getusnombre();
    $nuevoElem['cetdescripcion']    = $cetNombre;
    array_push($arreglo_salida,$nuevoElem);
}
//var_dump($arreglo_salida);
echo json_encode($arreglo_salida);
?>