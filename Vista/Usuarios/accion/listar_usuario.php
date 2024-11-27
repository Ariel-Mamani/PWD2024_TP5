<?php 
include_once "../../../configuracion.php";
$data = data_submitted();
$arreglo_salida =  array();
if(!empty($data)){


$objAbmUsuario = new AbmUsuario();
$listaUsuario = $objAbmUsuario->buscar($data);

foreach ($listaUsuario as $elem ){

    $nuevoElem['idusuario']      = $elem->getidusuario();
    $nuevoElem["usnombre"]       = $elem->getusnombre();
    $nuevoElem["usmail"]         = $elem->getusmail();
    $nuevoElem["usdeshabilitado"]= $elem->getusdeshabilitado();
    array_push($arreglo_salida,$nuevoElem);
}
}
echo json_encode($arreglo_salida);
?>