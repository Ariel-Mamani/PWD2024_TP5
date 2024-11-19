<?php
header('Content-Type: application/json');
include_once '../../configuracion.php';
$datos = data_submitted();

$abmProducto = new AbmProducto();

if (isset($datos['idproducto']) && !empty($datos['idproducto'])) {
    $elProducto = $abmProducto->buscar($datos);

    if (!empty($elProducto)) {
        $producto = $elProducto[0];
        $stockActual = $producto->getProStock() + 1; // Ajustar el stock
        $producto->setProStock($stockActual);

        $paramModificacion = [
            'idproducto' => $producto->getIdProducto(),
            'pronombre' => $producto->getProNombre(),
            'prodetalle' => $producto->getProDetalle(),
            'proprecio' => $producto->getProPrecio(),
            'procantstock' => $producto->getProStock(),
            'proimagen' => $producto->getProImagen()
        ];

        if ($abmProducto->modificacion($paramModificacion)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al modificar el producto.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Producto no encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos insuficientes para procesar.']);
}
