<?php 
include_once "../../../configuracion.php";
$data = data_submitted();
if(empty($data)){
    $param['idrol'] = 4; //CLiente
}else{
    $param = $data;
}

$objAbmUsuarioRol = new AbmUsuarioRol();
$listaUsuarioRol = $objAbmUsuarioRol->buscar($param);
$arreglo_salida =  array();
foreach ($listaUsuarioRol as $elem ){

    $nuevoElem['idusuario']      = $elem->getUsuario()->getidusuario();
    $nuevoElem["usnombre"]       = $elem->getUsuario()->getusnombre();
    $nuevoElem["usmail"]         = $elem->getUsuario()->getusmail();
    $nuevoElem["usdeshabilitado"]= $elem->getUsuario()->getusdeshabilitado();
    array_push($arreglo_salida,$nuevoElem);
}
//}
echo json_encode($arreglo_salida);
?>