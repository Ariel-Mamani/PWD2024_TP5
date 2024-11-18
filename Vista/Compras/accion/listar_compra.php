<?php 
include_once "../../../configuracion.php";
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
    $nuevoElem['idcompra']  = $elem->getIdCompra();
    $nuevoElem["cofecha"]   = $elem->getCoFecha();
    $nuevoElem["idusuario"] = $elem->getUsuario()->getidusuario();
    $nuevoElem["usnombre"]  = $elem->getUsuario()->getusnombre();
    array_push($arreglo_salida,$nuevoElem);
}

echo json_encode($arreglo_salida);

?>