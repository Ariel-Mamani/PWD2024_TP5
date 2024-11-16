<?php
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $index = $_POST['index'];

    if(isset($_SESSION['carrito']) && isset($_SESSION['carrito'][$index])){
        // Decremento la cantidad del producto
        $_SESSION['carrito'][$index]['cantidad'] -= 1;

        // Si la cantidad llega a 0, eliminar el producto
        if($_SESSION['carrito'][$index]['cantidad'] <= 0){
            unset($_SESSION['carrito'][$index]);
            $_SESSION['carrito'] = array_values($_SESSION['carrito']); 
        }
    }
    // Retorna una respuesta en formato JSON para informar que la operación fue exitosa
    echo json_encode(['success' => true]);
}
