<?php 
include_once "../../../configuracion.php";

$datos = data_submitted();

$objabmProducto= new AbmProducto();
$datosP= array();
header('Content-Type: application/json'); 
header('Content-Disposition: attachment; filename="productos.json"');

if(isset($datos['pronombre'], $datos['prodetalle'],$datos['proprecio'],$datos['procantstock'],$datos['proimagen'])){
    $datosP['pronombre']= $datos['pronombre'];
    $datosP['prodetalle'] = $datos['prodetalle'];
    $datosP['proprecio'] = $datos['proprecio'];
    $datosP['procantstock']=$datos['procantstock'];
    $datosP['proimagen'] = $datos['proimagen'];

    if($objabmProducto -> ingresarDatos($datosP)){
        echo json_encode(['success'=> true]);
    }else{
        echo json_encode(['succes'=>false]);
    }

}else{
    echo json_encode(['success'=>false, 'message'=>'metodo no permitido']);
}



?>