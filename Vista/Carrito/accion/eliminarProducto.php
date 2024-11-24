<?php
include_once "../../../configuracion.php";
$datos = data_submitted();
$abmCompra = new AbmCompra();

    $abmCompra->cancelarProducto($datos);
    
     echo json_encode($param);
