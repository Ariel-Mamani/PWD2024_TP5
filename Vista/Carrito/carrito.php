<?php
$titulo = "Carrito"; 
include_once '../Estructura/header.php';
//$objSession = new Session();
$user = $objSession->getUsuario()->getusnombre();
$correo = $objSession->getUsuario()->getusmail();


//Hay que verificar si el que ingresa al carrito es un usuario registrado
if (!$objSession->validarCompra()) {
    echo " <h3><b>No hay Productos en el  CARRITO</b></h3>";
}
echo $_SESSION['idcompra'];
echo $_SESSION['idusuario'];
?>


<form action="" method="post">

    <b>Usuario: </b><?php echo $user; ?><br>
    <b>Correo: </b><?php echo $correo; ?><br>
    <b>Fecha: </b> <?php echo date('d-m-Y'); ?><br><br>

    <div class="container">
        <div class="table-responsive">
          <table id="tabla1">
        

          </table>
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

$('#tabla1').datagrid({
        width: 710,
        heigth: 300,
        fitColumns: true,
        singleSelect: true,
        striped: true,
    url:'carrito_list.php',
    columns:[[
        {field:'idproducto', title:'Id Producto', width:100, align:'center'},
        {field:'pronombre', title:'Nombre', width:300, align:'center'},
        {field:'cicantidad', title:'Cantidad', width:100, align:'center'},
        {field:'proprecio', title:'Precio', width:100, align:'center'},
    ]]
});
</script>

