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
                        '<img class="grid-img" src="../../Archivos/Productos/'+producto.proimagen+ '" alt="' + producto.pronombre + '" stlye="width:50%; heigth:auto">' +
                        '<button tpye="submit" class="btn-compra">Añadir al carro</button>'
                    );

                    //Agregar contenido al div
                    $('#grid-container').append(divProducto);
                });
            },
            error: function(xhr,status,error){
                console.error("Error al obtener datos: ", error);
                console.log('Respuesta:', xhr.responseText);
            }
        });
    });
</script>