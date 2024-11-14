<?php
  $titulo = "Contacto"; //Titulo en la pestania
  include_once "../Estructura/header_N.php";
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
                <h2 class="text-light">Contacto</h2>
            </div>
        </div>    
    </div>


    <!-- Separador -->
    <div class="separador"></div>
    <br><br>

    <!-- Texto contacto -->
    <div class="div_texto_contacto"  id="texto_contacto">
        <h1>
            Puede contactarse a trav&eacute;z de nuestras redes.
        </h1>
        <br><br>
    </div>

    <div class="div_btn_contacto">
        <!-- Botones de contacto -->
        <div class="red_social">
            <!-- Facebook -->
            <p class="nombre_icono_red_social">Facebook</p>
            <img src="../../Iconos/logo-facebook.svg" alt="logo_facebook" class="icono_facebook" href="#">
        </div>

        <div class="red_social">
            <!-- Instagram -->
            <p class="nombre_icono_red_social">Instagram</p>
            <img src="../../Iconos/logo-instagram.svg" alt="logo_instagram" class="icono_instagram" href="#">
        </div>

        <div class="red_social">
            <!-- LinkedIn -->
            <p class="nombre_icono_red_social">LinkedIn</p>
            <img src="../../Iconos/logo-linkedin.svg" alt="logo_linkedin" class="icono_linkedin" href="#">
        </div>
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
