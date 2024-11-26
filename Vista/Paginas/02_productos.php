<?php
$titulo = "Productos"; //Titulo en la pestaña
include_once '../Estructura/header.php';
?>

<!-- Aquí va el contenido principal de tu página -->
<div class="main-content">
    <!--Ancla que vienen al Inicio desde el fondo-->
    <a name="Fondo a Inicio"></a>
    <!-- Portada -->
    <div class="portada_imagen">
        <div class="imagen_de_portada">
            <img src="../../Archivos/Peluqueria/salon4.jpg" alt="Imagen del salon de la peluqueria" class="imagen_portada">
            <!-- Titulo en la pagina -->
            <div class="container_titulo">
                <h1 class="display-4 text-center titulo_principal text-light">Pelitos</h1>
                <h2 class="text-light">Nuestros Productos</h2>
            </div>
        </div>    
    </div>
    <!-- Container de Productos -->
    <!-- Si quiern mostrar los productos con AJAX, haganlo pero que funcione el boton Agregar 
    Yo lo hice con AJAX pero lo unico que no me funcionaba era el boton agregar :(  pipipi
    Asi que deje esta version que es la que funca bien-->
    <div id="grid-container">

    </div>

    <!--Ancla de fondo a Inicio-->
    <a id="ancla" href="#Fondo a Inicio">
        <img src="../../Iconos/punta_de_flecha_hacia_arriba.png" alt="ir_arriba" class="icono_ir_arriba">
        Ir arriba
    </a>
</div>

<!-- Div para los alert -->
<div id="notification-container" style="position: fixed; top: 20px; right: 20px; z-index: 1000;"></div>

<!-- Footer -->
<?php
    include_once '../Estructura/footer_tienda.php';
?>



<script>
    $(document).ready(function(){
        // obtener datos de la base de datos
        $.ajax({
            type:'GET',
            url:'../Producto/accion/listar_Productos.php',
            dataType:'json',
            success: function(data){
                //genera div para cada producto
                $.each(data, function(index,producto){
                    // Crear el div para el producto
                    var divProducto = $('<div class="producto">');
                    divProducto.html( 
                        '<p>' +  producto.pronombre + '</p>' +
                        '<p>Precio: $' + producto.proprecio + '</p>' +
                        '<p>Stock: ' + producto.procantstock + '</p>' + 
                        '<input type="number" id="cantidad" name="cantidad" min="1" max="'+ producto.procantstock+'" value="1">' +
                        '<img class="grid-img" src="../../Archivos/Productos/'+producto.proimagen+'" alt="' + producto.pronombre + '" stlye="width:50%; heigth:auto">' +
                        '<button type="button" class="btn-compra"'+ 'data-id="'+ producto.idproducto+ '"' +
                        'data-nombre="'+ producto.pronombre+ '"'+ 
                        'data-precio="' + producto.proprecio + '"' +
                        'data-stock="' + producto.procantstock +'">'+
                        'Añadir al carro </button>' 
                        
                    );

                    //Agregar contenido al div
                    $('#grid-container').append(divProducto);
                });
                var producto;
                
        
                // Manejar el click en el botón "Añadir al carro"
                $('.btn-compra').on('click', function() {
                    var idArt = $(this).data('id');
                    var nombre = $(this).data('nombre');
                    var precio = $(this).data('precio');
                    var stock = $(this).data('stock'); // Obtener el stock del botón
                    var cantidad = $(this).siblings('input[name="cantidad"]').val(); // Obtener la cantidad desde el input

                    // Validar que la cantidad ingresada sea válida
                    if (!cantidad || cantidad < 1 || cantidad > stock) {
                        alert('Por favor ingresa una cantidad válida.');
                        return;
                    }

                    // Enviar datos al archivo carrito.php
                    $.ajax({
                        type: 'POST',
                        url: '../Carrito/accion/agregarCarrito.php',
                        data: {
                            idproducto: idArt,
                            pronombre: nombre,
                            cicantidad: cantidad,
                            proprecio: precio,
                            stock: stock // Usar el stock del botón
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
            },
            error: function(xhr, status, error) {
                console.error("Error al obtener datos: ", error);
                console.log('Respuesta:', xhr.responseText);
            }
        });

        
    });
</script>