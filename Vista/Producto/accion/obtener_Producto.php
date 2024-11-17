<?php
include_once "../../../configuracion.php";

$datos = data_submitted();
$abmProducto = new AbmProducto();
header('Content-Type: application/json'); 

if(isset($datos['idproducto'])){
    $producto = $abmProducto -> buscarProducto($datos['idproducto']);
    if($producto != null){
        echo json_encode([
            'success' => true,
            'data' => [
                'idproducto' => $producto->getIdProducto(),
                'pronombre' => $producto->getProNombre(),
                'prodetalle' => $producto->getProDetalle(),
                'proprecio' => $producto->getProPrecio(),
                'procantstock' => $producto->getProStock(),
                'proimagen' => $producto->getProImagen(),
            ]
        ]);
    }else {
        // Producto no encontrado
        echo json_encode([
            'success' => false,
            'message' => 'Producto no encontrado.'
        ]);
    }
}else {
    // ID de producto no proporcionado
    echo json_encode([
        'success' => false,
        'message' => 'ID de producto no proporcionado.'
    ]);
}
?>