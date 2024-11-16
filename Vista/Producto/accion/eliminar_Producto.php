<?php 
include_once '../../../configuracion.php';
$datos = data_submitted();
$abmProducto = new AbmProducto();
header('Content-Type: application/json'); 
header('Content-Disposition: attachment; filename="productos.json"');

if(isset($datos['idproducto'])){
    if($abmProducto -> baja($datos['idproducto'])){
        echo json_encode(['success' => true]);
    }else{
        echo json_encode(['success' => false, 'message'=> 'No se pudo eliminar el producto.']);
    }
}else{
    echo json_encode(['success'=> false, 'message' => 'Metodo no  permitido']);
}






?>