<?php
$titulo = "Carrito"; 
include_once '../Estructura/header.php';
$user = $objSession->getUsuario()->getusnombre();
$correo = $objSession->getUsuario()->getusmail();
$objAbmCompra = new AbmCompra();
$carrito = $objAbmCompra->mostrarCompra();

//Hay que verificar si el que ingresa al carrito es un usuario registrado
if (!$objSession->validarCompra()) {
    echo " <h3><b>No hay Productos en el  CARRITO</b></h3>";
}
// echo $_SESSION['idcompra'];
// echo $_SESSION['idusuario'];
?>

<form action="" method="post">
    <b>Usuario: </b><?php echo $user; ?><br>
    <b>Correo: </b><?php echo $correo; ?><br>
    <b>Fecha: </b> <?php echo date('d-m-Y'); ?><br><br>
    <div class="container">
        <div class="table-responsive">
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
                            $totalItem = $item['cicantidad'] * $item['proprecio'];
                            $totalGeneral += $totalItem;
                         ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($item['pronombre']); ?></td>
                            <td><?php echo htmlspecialchars($item['cicantidad']); ?></td>
                            <td><?php echo '$' . htmlspecialchars($item['proprecio']); ?></td>
                            <td>
                                <button class="btn btn-danger eliminar-carrito" data-index="<?php echo $index; ?>" data-id='<?php echo $item['idproducto'];?>'><i class="bi bi-trash-fill"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="5">El carrito está vacío.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
            </table><br>
            <h4>
                Total: <?php echo '$' . number_format(isset($totalGeneral) ? $totalGeneral : 0, 2); ?>
            </h4> <!-- Muestra el total -->
            <button type="button" id="SaveCompra" class="btn btn-primary">Guardar Registro</button>
        </div>
    </div>
</form>
<?php
    include_once '../Estructura/footer_tienda.php';
?>

<!-- Script para decrementar la cantidad de productos agegados e incrementa el stock en la BD si elimino cantidad------>
<script>
$(document).on('click', '.eliminar-carrito', function() {
    var idProducto = $(this).data('id'); // Obtener el ID del producto a decrementar
    $.ajax({
        url: 'decrementarProducto.php', 
        method: 'POST',
        data: { idproducto: idProducto },
        success: function(response) {
    console.log(response); // Para verificar la respuesta del servidor
    if (response.success) {
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
});
</script>
