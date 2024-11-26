<?php 
include_once "../../../configuracion.php";
$data = data_submitted();
if(empty($data)){
    $param['idcompraestadotipo'] = 2; //Compra ingresada
}else{
    $param = $data;
}

$objAbmCompraEstado = new AbmCompraEstado();
$listaCompraEstado = $objAbmCompraEstado->buscar($param);
$listaCompra = array();
if(count($listaCompraEstado) > 0){
 
    foreach($listaCompraEstado as $objCompraEstado){
        if( $objCompraEstado->getCeFechaFin() == NULL){   
            array_push($listaCompra, $objCompraEstado);
        }
    }
}
$arreglo_salida =  array();
foreach ($listaCompra as $elem ){

    $nuevoElem['idcompra']          = $elem->getCompra()->getIdCompra();
    $nuevoElem["cefechainit"]       = $elem->getCeFechaInit();
    $nuevoElem["idusuario"]         = $elem->getCompra()->getUsuario()->getidusuario();
    $nuevoElem["usnombre"]          = $elem->getCompra()->getUsuario()->getusnombre();
    $nuevoElem['cetdescripcion']    = $elem->getCompraEstadoTipo()->getcetdescripcion();
    array_push($arreglo_salida,$nuevoElem);
}
//var_dump($arreglo_salida);
echo json_encode($arreglo_salida);
?>