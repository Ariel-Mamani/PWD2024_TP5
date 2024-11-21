<?php
include_once '../Estructura/header.php';
$datos = data_submitted();
$abmCompra = new AbmCompra();

$datos['idproducto'] = 3;//$datos;
    $abmCompra->cancelarProducto($datos);
    
     echo json_encode($datos);
