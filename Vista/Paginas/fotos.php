<?php
$titulo = "Página Principal"; //Titulo en la pestaña
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
                <h2 class="text-light">Nuestras Instalaciones</h2>
            </div>
        </div>    
    </div>


    <!-- Separador -->
    <div class="separador"></div>
    <br><br>

    <!-- Texto contacto -->
    <div class="div_texto_contacto"  id="texto_contacto">
        <h1>
            Nuestras instalaciones.
        </h1>
        <br><br>
    </div>

    <!-- Tabla de fotos -->
    <div class="tabla_fotos">
        <table class="tabla">
            <tr>
                <td><img src="../../Archivos/Peluqueria/salon1.jfif" alt="Foto 1"></td>
                <td><img src="../../Archivos/Peluqueria/salon2.jfif" alt="Foto 2"></td>
                <td><img src="../../Archivos/Peluqueria/salon3.jfif" alt="Foto 3"></td>
            </tr>
            <tr>
                <td><img src="../../Archivos/Peluqueria/salon4.jpg" alt="Foto 4"></td>
                <td><img src="../../Archivos/Peluqueria/salon5.jfif" alt="Foto 5"></td>
                <td><img src="../../Archivos/Peluqueria/salon6.jfif" alt="Foto 6"></td>
            </tr>
            <tr>
                <td><img src="../../Archivos/Peluqueria/salon7.jfif" alt="Foto 7"></td>
                <td><img src="../../Archivos/Peluqueria/peinado1.jfif" alt="Foto 8"></td>
                <td><img src="../../Archivos/Peluqueria/peinado2.jfif" alt="Foto 9"></td>
            </tr>
        </table>
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
