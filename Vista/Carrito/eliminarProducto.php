<?php
include_once '../Estructura/header.php';
$datos = data_submitted();
$abmCompra = new AbmCompra();

    $abmCompra->cancelarProducto($datos);
    
     echo json_encode($param);
