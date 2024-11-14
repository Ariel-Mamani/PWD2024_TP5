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

    <!-- Texto contacto (redes) -->
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


    <!-- Separador -->
    <div class="separador"></div>
    <br><br><br><br><br><br>

    <!-- Texto contacto (formulario) -->
    <div class="div_texto_contacto"  id="texto_contacto">
        <h1>
            O m&aacute;ndenos un mensaje y le responderemos.
        </h1>
    </div>

    <!-- Contenedor principal centrado -->
    <div class="div_formulario container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <!-- Formulario -->
        <form method="post" action="../Accion/#.php" id="contacto" name="contacto" class="row g-3 mt-3 needs-validation form_contacto" novalidate style="max-width: 500px;">
            
            <!-- Apellido y Nombre -->
            <div class="mb-3 form-floating text-primary mb-4">
                <input class="form-control" id="apellido_y_nombre" name="apellido_y_nombre" type="text" pattern="^\s*[A-Za-z]+(\s[A-Za-z]+)*\s*$" placeholder="Apellido y nombre" required>
                <label for="apellido_y_nombre" class="form-label">Apellido y nombre</label>
                <div class="valid-feedback">Ok!</div>
                <div class="invalid-feedback">Sólo se permiten letras, números y espacios</div>
            </div>

            <!-- Ciudad -->
            <div class="mb-3 form-floating text-primary mb-4">
                <input class="form-control" id="ciudad" name="ciudad" type="text" pattern="^\s*[A-Za-z]+(\s[A-Za-z]+)*\s*$" placeholder="Ciudad" required>
                <label for="ciudad" class="form-label">Ciudad</label>
                <div class="valid-feedback">Ok!</div>
                <div class="invalid-feedback">Sólo se permiten letras y espacios</div>
            </div>

            <!-- Mail -->
            <div class="mb-3 form-floating text-primary mb-4">
                <input class="form-control" id="mail" name="mail" type="email" placeholder="Dirección de e-mail" required>
                <label for="mail" class="form-label">e-mail</label>
                <div class="valid-feedback">Ok!</div>
                <div class="invalid-feedback">Ingresa un e-mail válido</div>
            </div>

            <!-- Comentarios -->
            <div class="mb-3 form-floating text-primary mb-4">
                <textarea class="form-control" id="comentarios" name="comentarios" placeholder="Comentarios aquí" style="height: 250px;"></textarea>
                <label for="comentarios" class="form-label">Comentarios</label>
            </div>

            <!-- Botón Enviar -->
            <div class="col-md-4 d-flex justify-content-center">
                <input id="accion" name="accion" value="nuevo" type="hidden">
                <button class="btn btn-primary" type="submit">Enviar</button>
            </div>
        </form>
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
