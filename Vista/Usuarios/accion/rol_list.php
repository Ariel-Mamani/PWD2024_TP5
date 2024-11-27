<?php 
include_once "../../../configuracion.php";
$data = data_submitted();
//$objControl = new AbmCompraEstadoTipo();
$objControl = new AbmRol();
$list = $objControl->buscar(NULL);
$arreglo_salida =  array();
foreach ($list as $elem ){
    
    $nuevoElem['idrol']  = $elem->getidrol();
    $nuevoElem["rodescripcion"]   = $elem->getroldescripcion();
   
    array_push($arreglo_salida,$nuevoElem);
}

echo json_encode($arreglo_salida);

?>