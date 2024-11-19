<?php 
$titulo = "TP FINAL";
include_once "../Estructura/header.php";



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



<table id="tablaProductos">
    <thead>
        <tr>
            <th field="idproducto">Id Producto</th>
            <th field="pronombre">Nombre del Producto</th>
            <th field="prodetalle">Detalles de Producto</th>
            <th field="proprecio">Precio</th>
            <th field="procantstock">Cantidad de Stock</th>
            <th field="proimagen">Url de la Imagen</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
            <!-- Los datos de los productos se agregaran aquí-->
    </tbody>

</table>




<div id="modalEditar" style="display:none">
    <h3>Editar Producto</h3>

    <form id="formEditarProducto">
        <input type="hidden" id="idproductoM" name="idproducto">
        <label for="pronombre">Nombre del Producto:</label>
        <input type="text" id="pronombreM" name="pronombre" require>
        <br>
        <label for="prodetalle">Detalles del Producto:</label>
        <input type="text" id="prodetalleM" name="prodetalle" require>
        <br>
        <label for="proprecio">Precio:</label>
        <input type="text" id="proprecioM" name="proprecio" require>
        <br>
        <label for="procantstock">Cantidadde Stock</label>
        <input type="text" id="procantstockM" name="procantstock" require>
        <br>
        <label for="proimagen">Url de la imagen</label>
        <input type="text" id="proimagenM" name="proimagen" require>
        <br>
        <button type="submit">Guardar Cambios</button>
        <button type="button" id="btnCancelar">Cancelar</button>
    </form>
</div>


<!---- Script para listar los productos en la base de datos---->
<script>$(document).ready(function() {
    // Realizar una solicitud AJAX para obtener los datos en formato JSON
    $.ajax({
        url: 'accion/listar_Productos.php', // Cambia esto a la ruta correcta de tu archivo PHP
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // Llenar la tabla con los datos recibidos
            var tbody = $('#tablaProductos tbody');
            tbody.empty(); // Limpiar el cuerpo de la tabla antes de agregar nuevos datos

            $.each(data, function(index, producto) {
                var row = $('<tr>');
                row.append($('<td>').text(producto.idproducto));
                row.append($('<td>').text(producto.pronombre));
                row.append($('<td>').text(producto.prodetalle));
                row.append($('<td>').text(producto.proprecio));
                row.append($('<td>').text(producto.procantstock));
                row.append($('<td>').text(producto.proimagen));
                row.append($('<td>').html('<button class="btn-eliminar" data-id="' + producto.idproducto + '">Eliminar</button> <button class="btn-modificar" data-id="' + producto.idproducto + '">Editar</button>')); // Botón de eliminar
                
                tbody.append(row);
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error al obtener los productos:', textStatus, errorThrown);
            alert('Error al obtener los productos. Inténtalo de nuevo más tarde.');
        }
    });
});
</script>

<!----- Script para borrar un producto de la tabla y deshabiltarla de la base de datos------>
<script>
$(document).on('click', '.btn-eliminar', function() {
    var idProducto = $(this).data('id'); // Obtener el ID del producto a eliminar

    // Confirmar la eliminación
    if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
        $.ajax({
            url: 'accion/eliminar_Producto.php', // Cambia esto a la ruta correcta de tu archivo PHP
            method: 'POST',
            data: { idproducto: idProducto },
            success: function(response) {
                if (response.success) {
                    // Eliminar la fila de la tabla
                    $('button[data-id="' + idProducto + '"]').closest('tr').remove();
                    alert('Producto eliminado con éxito.');
                } else {
                    alert('Error al eliminar el producto: ' + response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error al eliminar el producto:', textStatus, errorThrown);
                alert('Error al eliminar el producto. Inténtalo de nuevo.');
            }
        });
    }
});
</script>

<script>// Evento para el botón de editar
$(document).on('click', '.btn-modificar', function() {
    var id = $(this).data('id'); // Recupera el id del botón de data-id

    // Hacer una solicitud AJAX para obtener los detalles del producto
    $.ajax({
        url: 'accion/obtener_Producto.php',
        method: 'GET',
        data: { idproducto: id },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                var producto = response.data;

                // Llena el formulario con los datos del producto
                $('#idproductoM').val(producto.idproducto);
                $('#pronombreM').val(producto.pronombre);
                $('#prodetalleM').val(producto.prodetalle);
                $('#proprecioM').val(producto.proprecio);
                $('#procantstockM').val(producto.procantstock);
                $('#proimagenM').val(producto.proimagen);

                // Mostrar el modal
                $('#modalEditar').show();
            } else {
                alert(response.message); // Muestra el mensaje de error
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error al obtener el producto:', textStatus, errorThrown);
            console.log('Respuesta:', jqXHR.responseText);
            alert('Error al obtener el producto. Inténtalo de nuevo más tarde.');
        }
    });
});

// Evento para enviar el formulario de edición
$('#formEditarProducto').on('submit', function(e) {
    e.preventDefault(); // Evitar el envío normal del formulario

    $.ajax({
        url: 'accion/actualizar_Producto.php',
        method: 'POST',
        data: $(this).serialize(), // Serializa los datos del formulario
        success: function(response) {
            if (response.success) {
                alert('Producto actualizado con éxito.');
                $('#modalEditar').hide(); // Oculta el modal
                location.reload(); // Recarga la tabla para mostrar los cambios
            } else {
                alert('Error al actualizar el producto: ' + response.message);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error al actualizar el producto:', textStatus, errorThrown);
            console.log('Respuesta:', jqXHR.responseText)
            alert('Error al actualizar el producto. Inténtalo de nuevo más tarde.');
        }
    });
});

// Evento para cancelar la edición
$('#btnCancelar').on('click', function() {
    $('#modalEditar').hide(); // Oculta el modal
});
</script>



</body>