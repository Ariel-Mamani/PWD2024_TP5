<?php
include_once "../../../configuracion.php";
$datos = data_submitted();
$abmCompra = new AbmCompra();

if (isset($datos['idproducto']) && !empty($datos['idproducto'])) {
    $abmCompra->restarProducto($datos);
    
    // echo json_encode(['success' => true]);
}