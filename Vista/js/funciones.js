
// Funcion para procesar y agregar al carrito

$(document).ready(function (){
    //Detecta el clic del botón con la clase agregar-carrito
    $('.agregar-carrito').on('click', function (){
        // Obtengo datos  del producto desde el botón clickeado
        var idArt = $(this).data('id');
        var nombre = $(this).data('nombre');
        var precioVenta = $(this).data('precio');
        var stock = $(this).data('stock');

        // Verifica si hay suficiente stock antes de intentar agregar al carrito
        if($(this).data('stock') > 0 ){
            // Enviar datos al servidor mediante una solicitud AJAX
            $.ajax({
                url: '../Carrito/agregarCarrito.php',  // URL del archivo que procesa la solicitud
                method: 'POST',             // Método para enviar los datos 
                data: {                     // Datos que se envían al servidor
                    idArt: idArt,
                    nombre: nombre,
                    cantidad: 1,  // Siempre enviamos 1 como cantidad
                    stock: stock,
                    precioVenta: precioVenta
                },
                success: function (response){
                    location.reload();
                    alert('Artículo agregado al carrito!');
                },
                error: function (){
                    alert('Hubo un error al agregar el artículo al carrito.');
                }
            });
        }else{
            alert('Este artículo no puede ser agregado al carrito. Verifica la disponibilidad y cantidad.');
        }
    });
});




//Funcion para elimar del carrito las peliculas agregadas

$(document).ready(function () {
    $('.eliminar-carrito').on('click', function () {
        var index = $(this).data('index');
        $.ajax({
            url: '../Carrito/eliminarCarrito.php',
            method: 'POST',
            data: {
                index: index
            },
            success: function (response) {
                // alert('Articulo eliminada del carrito!');
                location.reload();
            }
        });
    });
});
