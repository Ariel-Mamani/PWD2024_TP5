<?php
header('Content-Type: application/json');
include_once '../../configuracion.php';
$datos = data_submitted();
$abmCompra = new AbmCompra();

if (isset($datos['idproducto']) && !empty($datos['idproducto'])) {
    $abmCompra->quitarProducto($datos);
    
    // echo json_encode(['success' => true]);
}