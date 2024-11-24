
// Funcion para procesar y agregar al carrito
/*
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
                url: '../Carrito/accion/agregarCarrito.php',  // URL del archivo que procesa la solicitud
                method: 'POST',             // Método para enviar los datos 
                data: {                     // Datos que se envían al servidor
                    idArt: idArt,
                    nombre: nombre,
                    cantidad: 1,  // Siempre enviamos 1 como cantidad
                    stock: stock,
                    precioVenta: precioVenta
                },
                success: function (response){
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


// $(document).ready(function () {
//     //Eliminar cualquier evento previo antes de vincular
//     $('.agregar-carrito').off('click').on('click', function (){
//         var idArt = $(this).data('id');
//         var nombre = $(this).data('nombre');
//         var precioVenta = $(this).data('precio');
//         var stock = $(this).data('stock');

//         if (stock > 0)
//         {
//             $.ajax({
//                 url: '../Carrito/accion/agregarCarrito.php',
//                 method: 'POST',
//                 data: {
//                     idArt: idArt,
//                     nombre: nombre,
//                     cantidad: 1,
//                     stock: stock,
//                     precioVenta: precioVenta
//                 },
//                 success: function (response){
//                     showNotification('Artículo agregado al carrito!', 'success');
//                 },
//                 error: function (){
//                     showNotification('Hubo un error al agregar el artículo al carrito.', 'error');
//                 }
//             });
//         }else{
//             showNotification('Este artículo no tiene stock suficiente.', 'error');
//         }
//     });
// });

// function showNotification(message, type){
//     //Eliminar notificaciones existentes antes de crear una nueva
//     $('#notification-container .notification').remove();

//     var notification = $(`
//         <div class="notification ${type}">
//             <span>${message}</span>
//             <button class="close-btn">&times;</button>
//         </div>
//     `);

//     $('#notification-container').append(notification);

//     //Mostrar la notificación con animacion
//     setTimeout(function (){
//         notification.addClass('show');
//     }, 10);

//     //Cerrar manualmente
//     notification.find('.close-btn').on('click', function (){
//         notification.removeClass('show');
//         setTimeout(function (){
//             notification.remove();
//         }, 500);
//     });

//     //Eliminar automáticamente despues de 5 segundos
//     setTimeout(function ()
//     {
//         notification.removeClass('show');
//         setTimeout(function (){
//             notification.remove();
//         }, 500);
//     }, 5000);
// }

//Funcion para eliminar los productos del carrito
/*
$(document).ready(function () {
    $('.eliminar-carrito').on('click', function () {
        var index = $(this).data('index');
        $.ajax({
            url: '../Carrito/accion/eliminarCarrito.php',
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
});*/


