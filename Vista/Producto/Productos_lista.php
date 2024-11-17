<?php 
$titulo = "TP FINAL";
include_once "../Estructura/header_N.php";



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
        </tr>
    </thead>

    <tbody>
            <!-- Los datos de los productos se agregaran aquí-->
    </tbody>

</table>

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
                row.append($('<td>').html('<button class="btn-eliminar" data-id="' + producto.idproducto + '">Eliminar</button>')); // Botón de eliminar
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
                    alert('Producto eliminado con éxito con el id' + idProducto);
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

</body>