<?php 
$titulo = "TP FINAL";
include_once "../Estructura/header_N.php";

$datos = data_submitted();


if(!empty($datos)){
    $resp = false;

    $objProducto = new AbmProducto();


    if(isset($datos['accion'])){
        if($datos['accion'] == 'editar'){
            if($objProducto->modificacion($datos)){
                $resp = true;
            }
        }
        if($datos['accion']=="borrar"){
            if($objProducto -> baja($datos)){
                $resp = true;
            }
        }
        if($resp){
            $mensaje = "La accion " . $datos['accion']. " se realizo correctamente.";
        }else{
            $mensaje = "La accion ".$datos['accion']. "con el id=".$datos['idProducto']." no pudo concretarse.";
        }
    }


?>


<div class="divTititulo">
    <h1><?php echo $titulo ?></h1>
</div>


<div class="alert text-center p-3 divform">

<?php 
echo $mensaje;

}else{
    echo "<p>Acceso restringido</p>";
}

?>
<br><a href="listaProductos.php" class="btn btn btn-info m-3" role="button">Volver</a>
</div>