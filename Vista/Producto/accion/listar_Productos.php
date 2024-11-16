<?php 

include_once "../../../configuracion.php";
$abmProducto = new AbmProducto();
$lista = $abmProducto -> buscar(null);
$arreglo_salida = array();

// Establecer encabezados para la descarga de un archivo JSON
header('Content-Type: application/json');
header('Content-Disposition: attachment; filename="productos.json"');

foreach($lista as $elem){

    $nuevoElm['idproducto'] = $elem->getIdProducto();
    $nuevoElm['pronombre'] = $elem -> getProNombre();
    $nuevoElm['prodetalle'] = $elem -> getProDetalle();
    $nuevoElm['proprecio'] = $elem -> getProPrecio();
    $nuevoElm['procantstock']= $elem -> getProStock();
    $nuevoElm['proimagen'] = $elem -> getProImagen();


    array_push($arreglo_salida,$nuevoElm);
}

echo json_encode($arreglo_salida);



?>