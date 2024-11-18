<?php
session_start();
include_once '../../configuracion.php';
$datos = data_submitted();

if(!empty($datos)){
    // Obtiene los datos enviados desde la solicitud AJAX
    $idArt = $datos['idArt'];
    $nombre = $datos['nombre'];
    $cantidad = $datos['cantidad'];
    $stock = $datos['stock'];
    $precioVenta = $datos['precioVenta'];

    // Si el carrito no existe en la sesion, lo inicializa como un arreglo vacio
    if(!isset($_SESSION['carrito'])){
        $_SESSION['carrito'] = [];
    }

    // Variable para verificar si el producto ya está en el carrito
    $itemExists = false;
    // Recorre los productos en el carrito
    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['idArt'] == $idArt) { 
            $item['cantidad'] += $cantidad;    // Aumenta la cantidad del producto
            $itemExists = true;
            break;
        }
    }

    // Si el producto no estaba en el carrito, lo agrega como un nuevo item
    if(!$itemExists){
        $_SESSION['carrito'][] = [
            'idArt' => $idArt,
            'nombre' => $nombre,
            'cantidad' => $cantidad,
            'stock' => $stock,
            'precioVenta' => $precioVenta
        ];
    }
    echo json_encode(['success' => true]);
}
?>

