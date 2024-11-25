<?php
$titulo = "Carrito"; 
include_once '../Estructura/header.php';
$user = $objSession->getUsuario()->getusnombre();
$correo = $objSession->getUsuario()->getusmail();
$idcompra = $objSession->getCompra()->getIdCompra();
$objAbmCompra = new AbmCompra();
$carrito = $objAbmCompra->mostrarCompra(); //Muestra los productos del carrito

//Hay que verificar si el que ingresa al carrito es un usuario registrado
//Verifica si el usuario tiene productos en el carrito
if (!$objSession->validarCompra()) {
    echo " <h3><b>No hay Productos en el CARRITO</b></h3>";
}
    
?>

<form action="" method="post">
    <!-- Informacion del usuario -->
    <div style="font-size: 24px; text-align: center;">
        <b id="idcompra">Compra Nro: </b><?php echo $idcompra; ?><br>
        <b>Usuario: </b><?php echo $user; ?><br>
        <b>Correo: </b><?php echo $correo; ?><br>
        <b>Fecha: </b> <?php echo date('d-m-Y'); ?><br><br>
    </div>
    <div class="container">
        <div class="table-responsive">
            <!-- Tabla con productos que hay en el carrito -->
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Artículo</th>
                        <th>Cant</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($objSession->validarCompra()): ?>
                        <?php
                            $totalGeneral = 0;
                            foreach ($carrito as $index => $item) :
                        ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($item['pronombre']); ?></td>
                            <td><input type="number" name="cicantidad" id="cicantidad"  class="cantidad-producto" data-index="<?php echo $index; ?>" data-id='<?php echo $item['idproducto'];?>'   min="1" value="<?php echo htmlspecialchars($item['cicantidad']); ?>"></td>
                            
                            <td><?php echo '$' . htmlspecialchars($item['proprecio']); ?></td>
                            <td>
                                <button class="btn btn-danger eliminar-producto" data-index="<?php echo $index; ?>" data-id='<?php echo $item['idproducto'];?>'><i class="bi bi-trash-fill"></i></button>
                            </td>
                        </tr>

                        <?php
                            $totalItem = $item['cicantidad'] * $item['proprecio'];
                            $totalGeneral += $totalItem; 
                            endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="5">El carrito está vacío.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
            </table><br>
                            <div id="mostrar"></div>
            <!-- Muestra el valor total de todos los productos en el carrito -->
            <h4>
                Total: <?php echo '$' . number_format(isset($totalGeneral) ? $totalGeneral : 0, 2); ?>
            </h4>

            <!-- Guarda los datos del carrito -->
            <button type="button" id="SaveCompra" class="btn btn-primary">Finalizar Compra</button>
            <br><br>
        </div>
    </div>
</form>
<?php
    include_once '../Estructura/footer_tienda.php';
?>

<!-- Script para decrementar la cantidad de productos agegados e incrementa el stock en la BD si elimino cantidad------>
<script>
$(document).on('click', '.eliminar-producto', function() {
    var idProducto = $(this).data('id'); // Obtener el ID del producto a decrementar
    $.ajax({
        url: 'accion/eliminarProducto.php', 
        method: 'POST',
        data: { idproducto: idProducto },
        success: function(response) {
    console.log(response); // Para verificar la respuesta del servidor
    if (response.success) {
        alert('Producto eliminado con éxito.');
    } else {
    
        alert('Error al eliminar el producto: ' + response.message  + idProducto);
    }
},
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error al eliminar el producto:', textStatus, errorThrown);
            alert('Error al eliminar el producto. Inténtalo de nuevo.');
        }
    });
});


//Modificar cantidad de productos
$(document).on('blur', '.cantidad-producto', function() {
//$("#cicantidad").blur(function() {
    var idProducto = $(this).data('id');
    var ciCantidad = $(this).val(); 
    $.ajax({
        url: 'accion/agregarCarrito.php', 
        method: 'POST',
        data: { 
            cicantidad: ciCantidad,
            idproducto: idProducto 
        },
        success: function(response) {
            $('#notification-container').html('<div class="alert alert-success">Producto añadido al carrito.</div>');
            alert('El producto fue añadido con éxito');
        },
        error: function(xhr, status, error) {
            console.error("Error al añadir al carrito:", error);
            console.log(xhr.responseText);
        }
    });
});

//Finaliza la compra
$("#SaveCompra").on('click', function() {
    var idcompra = $("#idcompra").val(); 
    $.ajax({
        url: 'accion/finalizarCarrito.php', 
        method: 'POST',
        data: { idcompra: idcompra },
        success: function(response) {
            $('#notification-container').html('<div class="alert alert-success">Producto añadido al carrito.</div>');
            alert('CompraFinalizada con éxito');
        },
        error: function(xhr, status, error) {
            console.error("Error al finalizar compra:", error);
            console.log(xhr.responseText);
        }
    });
});
</script>

<!--
<td><input type="number" name="cicantidad" id="cicantidad" min="1" value="<?php //echo htmlspecialchars($item['cicantidad']); ?>"></td>
<td><?php //echo htmlspecialchars($item['cicantidad']); ?></td>
-->