<?php 
include_once '../Estructura/header.php';
$data = data_submitted();
$objAbmCompra = new AbmCompra();
$arreglo_salida = array();

$arreglo_salida = $objAbmCompra->mostrarCompra();
//var_dump($arreglo_salida);
echo json_encode($arreglo_salida);
?>