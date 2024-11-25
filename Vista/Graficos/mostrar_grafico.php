<?php 
$titulo = "TP FINAL";
include_once "../Estructura/header.php";
?>

<!-- Aquí va el contenido principal de tu página -->
<div class="main-content">

    <!--Ancla que vienen al Inicio desde el fondo-->
    <a name="Fondo a Inicio"></a>

    <!-- Titulo -->
    <div class="idTitulo">
        <br><br>
        <h1>Gr&aacute;fico de productos vendidos</h1>
    </div>
    <br><br>

    <!-- Imagen del gráfico -->
    <div class="img_grafico">
        <div>
            <img src="grafico.png" alt="Gráfico de Productos Vendidos">
        </div>
    </div>

    <!--Ancla de fondo a Inicio-->
    <a id="ancla" href="#Fondo a Inicio">
        <img src="../../Iconos/punta_de_flecha_hacia_arriba.png" alt="ir_arriba" class="icono_ir_arriba">
        Ir arriba
    </a>
</div>
<br><br>

<!-- Footer -->
<?php
    include_once '../Estructura/footer_tienda.php';
?>
