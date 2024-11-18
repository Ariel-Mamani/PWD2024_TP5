<?php
$titulo = "Carrito"; 
include_once '../Estructura/header.php';
$session = new Session();
$user = $session->getUsuario()->getusnombre();
$correo = $session->getUsuario()->getusmail();

//Hay que verificar si el que ingresa al carrito es un usuario registrado
if (!$session->validar()) {
    // Si el usuario no está registrado
    header('Location: registro.php'); 
    exit(); // Detener la ejecución del script
}
//Si existe, significa que el usuario ya tiene un carrito almacenado en su sesion 
// Si el usuario no tiene un carrito activo, se crea uno vacio
// OJO AL PIOJO
$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar al carrito</title>

<script src="../js/funciones.js"></script>
</head>

<form action="" method="post">
    <h3><b>AGREGAR AL CARRITO</b></h3>

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
                        <?php if (is_array($carrito) && count($carrito) > 0): ?>
                        <?php
                            $totalGeneral = 0;
                            foreach ($carrito as $index => $item) :
                            $totalItem = $item['cantidad'] * $item['precioVenta'];
                            $totalGeneral += $totalItem;
                            $obProducto = new Producto();
                            $elProducto = $obProducto->listar("idproducto = " . $item['idArt']);
                            $nuevoStock = $item['stock']-$item['cantidad'];
                            if (!empty($elProducto)) {
                                $producto = $elProducto[0];
                                $producto->setProStock($nuevoStock);
                                
                                if($producto->modificar()) {
                                    echo "Producto modificado con éxito.";
                                }else{
                                    echo "Error al modificar el producto: " . $producto->getmensajeoperacion();
                                }
                            }
                        ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($item['cantidad']); ?></td>
                            <td><?php echo '$' . htmlspecialchars($item['precioVenta']); ?></td>
                            <td>
                                <button class="btn btn-danger eliminar-carrito" data-index="<?php echo $index; ?>" data-id='<?php echo $item['idArt'];?>'><i class="bi bi-trash-fill"></i></button>
                                <button><i class="bi bi-caret-up-fill"></i></button>
                                <button><i class="bi bi-caret-down-fill"></i></button>
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

<!----- Script para borrar un producto de la tabla y deshabiltarla de la base de datos------>
<script>
$(document).on('click', '.eliminar-carrito', function() {
    var idProducto = $(this).data('id'); // Obtener el ID del producto a eliminar
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
