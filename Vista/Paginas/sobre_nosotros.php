<?php
$titulo = "Sobre Nosotros"; //Titulo en la pestaña
include_once '../Estructura/header_N.php';
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
                <h2 class="text-light">Sobre Nosotros</h2>
            </div>
        </div>    
    </div>


    <!-- Separador -->
    <div class="separador"></div>
    <br><br>

    <!-- Texto contacto -->
    <div class="div_texto_contacto"  id="texto_contacto">
        <h1>
            Sobre nosotros.
        </h1>
        <br><br>
    </div>

    <!-- Sobre nosotros -->
    <div class="sobre_nosotros">
        <p class="tiulo_sobre_nosotros letras">Bienvenidos a <b>Pelitos</b></p>
        <p class="letras">En <b>Pelitos</b>, lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquam voluptatem maxime nemo fugit distinctio incidunt dolores rerum optio quasi placeat praesentium suscipit excepturi commodi, numquam veniam, ab sapiente eaque aut.</p>
        <p class="letras">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut consequatur natus repellat eligendi nostrum. Enim molestias maiores perspiciatis unde labore harum facere! Temporibus quod nulla ex quae voluptatem, quasi nam.</p>
        <p class="letras">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam sunt impedit aperiam, minus dignissimos accusantium repellendus dolor laborum qui molestias ex dolores ab eius labore! Aliquam recusandae voluptas consequuntur tempora!</p>
        <p class="letras">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, repellat deleniti? Ipsam aperiam provident inventore neque nam, sunt, nulla perspiciatis assumenda quidem harum ipsum alias quibusdam eveniet corrupti culpa impedit.</p>
    </div>
    <br>

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
