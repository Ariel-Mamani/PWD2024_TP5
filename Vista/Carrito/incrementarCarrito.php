<?php
// SI NO ESTA ESTE SCRIPT SALTA UN ALERT DE ERROr DE SOLICITUD PERO FUNCA, LO QUE MOLESTA ES EL CARTEL
// NO ELIMINAR EL SCRIPT HASTA RESOLVER LO DEL ALERT MOLESTO


// header('Content-Type: application/json');
// include_once '../Estructura/header.php';

// include_once '../../configuracion.php';
// $datos = data_submitted();

// $abmProducto = new AbmProducto();

//     $elProducto = $abmProducto->buscar($datos);

//         $producto = $elProducto[0];
//         $stockActual = $producto->getProStock() - 1; 
//         $producto->setProStock($stockActual);

//         $paramModificacion = [
//             'idproducto' => $producto->getIdProducto(),
//             'pronombre' => $producto->getProNombre(),
//             'prodetalle' => $producto->getProDetalle(),
//             'proprecio' => $producto->getProPrecio(),
//             'procantstock' => $producto->getProStock(),
//             'proimagen' => $producto->getProImagen()
//         ];

//         if ($abmProducto->modificacion($paramModificacion)) {
//             echo json_encode(['success' => true]);
//         } else {
//             echo json_encode(['success' => false, 'message' => 'Error al modificar el producto.']);
//         }

