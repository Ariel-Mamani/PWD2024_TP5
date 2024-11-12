<?php
$titulo = "Información Útil"; //Titulo en la pestaña
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
            </div>
        </div>    
    </div>

    <!-- Separador -->
    <div class="separador"></div>
    <br><br>

    <!-- Texto horario de atencion y contacto -->
    <div class="div_texto_contacto"  id="texto_contacto">
        <h1>
            Horarios de atenci&oacute;n y contacto.
        </h1>
        <br>
        <p><i class="bi bi-clock"></i> Lunes de 12 a 18 hs. Martes a Viernes de 13 a 21 hs. Sábados de 9 a 18 hs.</p>
        <p><i class="bi bi-telephone"></i> 299 4111222</p>
        <p><i class="bi bi-geo-alt"></i> Dr. Luis Federico Leloir 250, Neuqu&eacute;n, Neuqu&eacute;n.</p>
        <br><br>
    </div>

    <!-- Separador -->
    <div class="separador"></div>
    <br><br>

    <!-- Texto ubicacion -->
    <div class="div_mapa"  id="div_mapa">
        <h1>
            Nuestra Ubicaci&oacute;n.
        </h1>
        <p>Nuestro establecimiento est&aacute; ubicado en la ciudad de Neuqu&eacute;n</p>
        <br>
        <div class="mapa-contenido">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3103.2073282697256!2d-68.05744292472009!3d-38.942091671714564!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x960a33dc6bc04c15%3A0x5fce5f007a4dc3b9!2sDr.%20Luis%20Federico%20Leloir%20250%2C%20Neuqu%C3%A9n!5e0!3m2!1ses!2sar!4v1731440727487!5m2!1ses!2sar" width="900" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <br><br>



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
