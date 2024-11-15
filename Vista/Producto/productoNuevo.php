<?php 

$titulo = "TP FINAL";
include_once "../Estructura/header_N.php";


?>


<div class="divtitulo">
    <h1>Agregar Nuevo Producto</h1>
</div>

<div class="container_auto mt-5 p-4 rounded shadow">

    <h3 class="text-center text-ligth mb-4">Ingrese un nuevo producto</h3>

    <div class="row">

<!--Formularios-->

        <form method="post" action="productoAccion.php" id="formProductoNuevo" name="formProductoNuevo" class="row g-3 mt-3 needs-validation" enctype="multipart/form-data" novalidate>

        <div class="mb-3 form-floating text-primary mb-4">
            <input class="form-control" type="text" id="pronombre" name="pronombre" require>
            <label for="pronombre" class="form-label">Nombre Producto</label>
        </div>


        <div class="mb-3 form-floating text-primary mb-4">
            <input class="form-control" type="text" id="prodetalle" name="prodetalle" require>
            <label for="prodetalle" class="form-label">Detalles del Producto</label>
        </div>


        <div class="mb-3 form-floating text-primary mb-4">
            <input class="form-control" type="text" id="proprecio" name="proprecio" require>
            <label for="proprecio" class="form-label">Precio del Producto</label>
        </div>


        <div class="mb-3 form-floating text-primary mb-4">
            <input class="form-control" type="file" id="proimagen" name="proimagen" require>
            <label for="proimagen" class="form-label">Ingrese la imagen del producto</label>
        </div>

        <div class="col-md-4">
            <button class="btn btn-primary" type="submit">Añadir</button>
        </div>
        </form>

    </div>
</div>