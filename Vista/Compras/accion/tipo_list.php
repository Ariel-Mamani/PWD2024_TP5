<?php 
include_once "../../../configuracion.php";
$data = data_submitted();
//$objControl = new AbmCompraEstadoTipo();
$objControl = new AbmCompraEstadoTipo();
$list = $objControl->buscar(NULL);
$arreglo_salida =  array();
foreach ($list as $elem ){
    
    $nuevoElem['idcompraestadotipo']  = $elem->getIdCompraEstadoTipo();
    $nuevoElem["cetdescripcion"]   = $elem->getCetDescripcion();
   
    array_push($arreglo_salida,$nuevoElem);
}

echo json_encode($arreglo_salida);

?>