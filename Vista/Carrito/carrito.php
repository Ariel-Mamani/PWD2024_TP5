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
          <table></table>
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
<script>
    $(document).ready(function(){

    })
</script>
