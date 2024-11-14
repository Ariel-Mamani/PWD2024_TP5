<?php
$titulo = "Términos y condiciones"; //Titulo en la pestaña
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
            Política de Privacidad de Pelitos.
        </h1>
        <br>
        <h3>
            Última actualización: 11 de noviembre de 2023
        </h3>
        <br><br>
    </div>

    <!-- Sobre nosotros -->
    <div class="politica_de_privacidad">
        <p>En Pelitos nos comprometemos a proteger la privacidad de nuestros clientes. Esta política de privacidad explica cómo recopilamos, utilizamos, almacenamos y protegemos la información personal que nos proporcionas al usar nuestros servicios, ya sea a través de nuestro sitio web, aplicación móvil o en nuestras instalaciones.</p>

        <p><b>1. Información que recopilamos</b></p>
        <p>Recopilamos la siguiente información personal de nuestros clientes:</p>
        <ul>
            <li>Datos de contacto: Nombre, correo electrónico, número de teléfono.</li>
            <li>Información de la reserva: Fecha, hora y tipo de servicio solicitado.</li>
            <li>Datos de pago: Información de tarjetas de crédito/débito o datos de pago electrónico (si corresponde).</li>
            <li>Otra información: Detalles adicionales sobre preferencias o requerimientos para los servicios.</li>
        </ul>

        <p><b>2. Cómo usamos la información</b></p>
        <p>La información que recopilamos se utiliza para:</p>
        <ul>
            <li>Gestionar y confirmar las reservas de nuestros clientes.</li>
            <li>Proporcionar un servicio personalizado y de calidad.</li>
            <li>Mejorar nuestra oferta de productos y servicios.</li>
            <li>Comunicarnos contigo en relación con tus reservas, promociones y novedades relacionadas con Pelitos.</li>
            <li>Cumplir con nuestras obligaciones legales y contractuales.</li>
        </ul>

        <p><b>3. Protección de la información</b></p>
        <p>Tomamos medidas razonables para proteger tu información personal contra el acceso no autorizado, la alteración o la destrucción. Utilizamos tecnología de encriptación en la transmisión de datos y almacenamos la información en servidores seguros.</p>

        <p><b>4. Compartir tu información</b></p>
        <p>No vendemos, intercambiamos ni alquilamos tu información personal a terceros. Sin embargo, podemos compartirla con:

Proveedores de servicios: Cuando contratamos proveedores externos para realizar tareas relacionadas con la operación de nuestro negocio, como procesadores de pagos o servicios de atención al cliente.
Requerimientos legales: Si estamos obligados por ley, podremos divulgar tu información para cumplir con las normativas y regulaciones aplicables.</p>

        <p><b>5. Cookies</b></p>
        <p>Utilizamos cookies en nuestro sitio web para mejorar la experiencia del usuario. Las cookies son pequeños archivos que se almacenan en tu dispositivo y que nos ayudan a recordar tus preferencias y a analizar cómo interactúas con nuestro sitio. Puedes desactivar las cookies a través de la configuración de tu navegador, pero algunas funciones de nuestro sitio pueden no funcionar correctamente.</p>

        <p><b>6. Tus derechos</b></p>
        <p>Tienes derecho a acceder, corregir o eliminar la información personal que hemos recopilado sobre ti. También puedes optar por no recibir comunicaciones de marketing, aunque esto no afectará las comunicaciones relacionadas con tus reservas.</p>
        <p>Para ejercer tus derechos, puedes contactarnos en cualquier momento a través de la siguiente dirección de correo electrónico: pelitos@pelitos.com.</p>

        <p><b>7. Enlaces a otros sitios web</b></p>
        <p>Nuestro sitio web puede contener enlaces a sitios web de terceros. No nos hacemos responsables de la privacidad ni del contenido de esos sitios. Te recomendamos leer las políticas de privacidad de cualquier sitio web que visites.</p>

        <p><b>8. Cambios en la política de privacidad</b></p>
        <p>Pelitos se reserva el derecho de modificar esta política de privacidad en cualquier momento. Cualquier cambio será publicado en esta página y, en su caso, se notificará a nuestros clientes.</p>

        <p><b>9. Contacto</b></p>
        <p>Si tienes preguntas sobre esta política de privacidad, o si deseas obtener más información sobre cómo manejamos tus datos personales, no dudes en contactarnos:</p>

        <p><i class="bi bi-clock"></i> Lunes de 12 a 18 hs. Martes a Viernes de 13 a 21 hs. Sábados de 9 a 18 hs.</p>
        <p><i class="bi bi-telephone"></i> 299 4111222</p>
        <p><i class="bi bi-envelope"></i> pelitos@pelitos.com</p>
        <p><i class="bi bi-geo-alt"></i> Dr. Luis Federico Leloir 250, Neuqu&eacute;n, Neuqu&eacute;n.</p>
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
