<?php
session_start();


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // Obtiene los datos enviados desde la solicitud AJAX
    $idArt = $_POST['idArt'];
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $stock = $_POST['stock'];
    $precioVenta = $_POST['precioVenta'];

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
    
    // Retorna una respuesta en formato JSON para informar que la operación fue exitosa
    echo json_encode(['success' => true]);
}
?>
