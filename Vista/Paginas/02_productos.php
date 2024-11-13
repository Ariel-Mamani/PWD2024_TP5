<?php
$titulo = "Profesionales"; //Titulo en la pestaña
include_once '../Estructura/header.php';
$objProdcuto = new Producto;
$arregloProductos = $objProdcuto->listar();

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
    <?php
    foreach($arregloProductos as $producto){
        echo "<div class='targeta-producto'>";
        echo "<img src='../../Archivos/Productos/{$producto->getProNombre()}.png' alt='{$producto->getProNombre()}'>";
        echo "<h3>{$producto->getProNombre()}</h3>";
        echo "<p>{$producto->getProDetalle()}</p>";
        echo "<p>{$producto->getProPrecio()}</p>";
        echo "<p>{$producto->getProImagen()}</p>";
        echo "<p><b>Stock:</b> {$producto->getProStock()}</p>";
        echo "<button>Agregar al carrito</button>";
        echo "</div>";
    }
    ?>


    <!--Ancla de fondo a Inicio-->
    <a id="ancla" href="#Fondo a Inicio">
        <img src="../../Iconos/punta_de_flecha_hacia_arriba.png" alt="ir_arriba" class="icono_ir_arriba">
        Ir arriba
    </a>
</div>

<!-- Footer -->
<?php
    include_once '../Estructura/footer_tienda.php';
?>
