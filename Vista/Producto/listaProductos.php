<?php 
$titulo = "TP FINAL";
include_once "../Estructura/header_N.php";

$abmProducto = new AbmProducto();
$listaProductos = $abmProducto->buscar(null);


?>




<body>

<div class="idTitulo">
    <h1>Nuestos Productos</h1>
</div>

<div class="text-center mb-4">
    <h2>Lista de Productos</h2>
</div>

<div class="container mt-3">
    <a href="productoNuevo.php" class="btn btn-primary" role="button">Agregar</a>
</div>



<div class="containerProducto">
    <?php 
    if(count($listaProductos)>0){

        foreach ($listaProductos as $objProducto){
            echo '<div> <img src="../../Archivos/Productos/'.$objProducto->getProNombre().'.png" alt="'.$objProducto->getProNombre().'"> <label> ' . $objProducto->getProNombre() . '</label><p>'. $objProducto -> getProDetalle(). '</p><label>$' . 
            $objProducto -> getProPrecio() . 
            '</label><br> <a href="productoAccion.php?accion=borrar&idProducto='.$objProducto ->getIdProducto().'" role="button">Borrar</a><a href="editarProducto.php?accion=editar&idProducto='.$objProducto->getIdProducto().'"role="button">Editar</a> </div>';
        }
    }
    
    
    ?>
</div>






</body>