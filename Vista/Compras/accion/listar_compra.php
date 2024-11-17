<?php 
include_once "../../../configuracion.php";
$data = data_submitted();
$objControl = new AbmCompra();
$list = $objControl->buscar(NULL);
$arreglo_salida =  array();
foreach ($list as $elem ){
    
    $nuevoElem['idcompra']  = $elem->getIdCompra();
    $nuevoElem["cofecha"]   = $elem->getCoFecha();
    $nuevoElem["idusuario"] = $elem->getUsuario()->getIdUsuario();
    $nuevoElem["usnombre"] = $elem->getUsuario()->getUsNombre();
   
    array_push($arreglo_salida,$nuevoElem);
}
//verEstructura($arreglo_salida);
echo json_encode($arreglo_salida);

?>