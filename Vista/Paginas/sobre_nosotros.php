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
        <p class="letras">En <b>Pelitos</b>, nos especializamos en ofrecer una experiencia de cuidado y estilo personalizado para toda la familia. Cada corte y tratamiento está hecho con dedicación y profesionalismo, pensado para resaltar lo mejor de cada persona.</p>
        <p class="letras">Ofrecemos una variedad de servicios, desde cortes modernos y coloración hasta tratamientos de cuidado capilar, ideales para quienes valoran una atención al detalle y un toque especial. Nuestro equipo apasionado está comprometido en crear looks únicos que se adapten a tu estilo y personalidad.</p>
        <p class="letras">Ya sea que busques un cambio de look, un tratamiento especial o simplemente un retoque, <b>Pelitos</b> está aquí para ti. Nos enorgullece crear estilos que no solo se ven bien, sino que también te hacen sentir genial.</p>
        <p class="letras">Gracias por confiar en nosotros y ser parte de nuestra comunidad. ¡Visítanos y descubre lo que podemos hacer por ti y tu cabello!</p>
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
