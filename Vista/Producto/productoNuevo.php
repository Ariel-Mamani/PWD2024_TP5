<?php 

$titulo = "TP FINAL";
include_once "../Estructura/header.php";


?>


<div class="divtitulo">
    <br><br>
    <h1>Agregar Nuevo Producto</h1>
</div>

<div class="container_auto mt-5 p-4 rounded shadow">

    <div class="row div_formulario">

        <!--Formularios-->
        <form method="post" action="accion/productoAgregar.php" id="formProductoNuevo" name="formProductoNuevo"  class="row g-3 mt-3 needs-validation" enctype="multipart/form-data" novalidate>
            <div class="mb-3 form-floating text-primary mb-4">
                <input class="form-control" type="text" id="pronombre" name="pronombre" require>
                <label for="pronombre" class="form-label">Nombre del Producto</label>
            </div>

            <div class="mb-3 form-floating text-primary mb-4">
                <input class="form-control" type="text" id="prodetalle" name="prodetalle" require>
                <label for="prodetalle" class="form-label">Detalles del Producto</label>
            </div>

            <div class="mb-3 form-floating text-primary mb-4">
                <input type="text" class="form-control" id="proprecio" name="proprecio" require>
                <label for="proprecio" class="form-label">Precio</label>
            </div>
            <div class="mb-3 form-floating text-primary mb-4">
                <input type="text" class="form-control" id="procantstock" name="procantstock"  require>
                <label for="procantstock" class="form-label">Stock </label>
            </div>
            

            <div class="mb-3 form-floating text-primary mb-4">
                <input type="text" class="form-control" id="proimagen" name="proimagen" require>
                <label for="proimagen">Ingrese la URL donde esta la imagen</label>
            </div>

            <!-- Botones Guardar nuevo producto y Volver -->
            <div class="container col-md-5">
                <button class="btn btn-primary" type="submit">Guardar nuevo producto</button>
                <a href="../Producto/Productos_lista.php" class="btn btn-primary" role="button">Volver</a>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#formProductoNuevo').on('submit', function(event){
            event.preventDefault();

            var formData = new FormData(this); // Cambiado $this a this

            $.ajax({
                url: 'accion/productoAgregar.php',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response.success){ // Corregido 'succes' a 'success'
                        alert('Producto añadido con éxito.');
                        $('#formProductoNuevo')[0].reset();
                    } else {
                        alert('Error al añadir el producto: ' + response.message); // Corregido 'menssage' a 'message'
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error al añadir el producto:', textStatus, errorThrown);
                    alert('Error al añadir el producto. Inténtelo de nuevo');
                }
            });
        });
    });
</script>