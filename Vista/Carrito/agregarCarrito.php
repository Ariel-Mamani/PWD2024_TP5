<?php

include_once '../../configuracion.php';
$datos = data_submitted();
$objSession = new Session();
$abmCompra = new AbmCompra();

$objSession->iniciarCompra();

if(!empty($datos)){
    // Obtiene los datos enviados desde la solicitud AJAX
    $idArt = $datos['idArt'];
    $nombre = $datos['nombre'];
    $cantidad = $datos['cantidad'];
    $stock = $datos['stock'];
    $precioVenta = $datos['precioVenta'];

    $producto = ['idproducto' => $idArt];
    $abmCompra->agregarProducto($producto);


}
?>

