<?php 
include_once "../../../configuracion.php";
$datos = data_submitted();
$abmProducto = new AbmProducto();
header('Content-Type: application/json'); 


if($abmProducto -> modificarP($datos)){
    echo json_encode(['success' => 'Los datos fueron actualizados con exito.']);
}else{
    echo json_encode(['error' => 'Error al actualizar el producto.']);
}
?>