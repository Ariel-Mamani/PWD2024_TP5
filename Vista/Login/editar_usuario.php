<?php
$titulo = "TP 5 - Registrar ";
include_once '../Estructura/header.php';

$objUsuario = $objSession->getUsuario();

?>

<section>
    <!-- div para colocar el mensaje -->
    <div class="div-mensaje"></div>

    <?php
    // El mensaje viene del script verificarLogin.php
    // Se mostrara un mensaje ya que el usuario quiso entrar al login sin haberse registrado antes
    // Verifica si hay un mensaje en la sesión y lo muestra
  /*  if (isset($_SESSION['mensaje']) && $_SESSION['mensaje'] != '') {
        echo "<h1 class='bg-dark text-light p-2'>{$_SESSION['mensaje']}</h1>";
        // Limpia el mensaje para que no vuelva a mostrarse en el próximo acceso
        unset($_SESSION['mensaje']);
    }*/
    ?>

    <body>
        <!-- Register box -->
        <div class="register-box">

            <!-- Curva -->
            <div class="curva-registro" id="curva-registro"></div>

            <!-- Formulario de Registro -->
            <form id="form" name="form" action="accion/actualizar_registro.php" method="get" class="needs-validation" novalidate>

                <!-- Titulo -->
                <h2>Cambiar Datos del Usuario</h2>

                <!-- Nombre usuario  -->
                <div class="input-group mb-4 input-box">
                    <!-- Icono -->
                    <span class="icon" id="basic-addon1">
                        <i class="bi bi-person"></i>
                    </span>

                    <input type="text" name="usnombre" id="usnombre" class="form-control" required value="<?php echo $objUsuario->getusnombre(); ?>">
                    <label>Usuario</label>
                    <!-- Mensajes aprobado y error -->
                    <div class="valid-feedback">Ok!</div>
                    <div class="invalid-feedback">El nombre de usuario solo debe contener letras sin números ni símbolos</div>
                </div>

                <!-- Contraseña -->
                <div class="input-group mb-4 input-box">
                    <!-- Icono -->
                    <span class="icon" id="basic-addon2">
                        <i class="bi bi-lock"></i>
                    </span>

                    <input id="clave" name="clave" type="password" class="form-control" required onblur="return convertirClaveMD5()">
                    <input type="hidden" name="uspass" id="uspass">
                    <label>Password</label>
                    <!-- investigar sobre password_hash() -->
                    
                    <!-- Mensajes aprobado y error -->
                    <div class="valid-feedback">Ok!</div>
                    <div class="invalid-feedback">Valor de contraseña incorrecto</div>
                </div>

                <!-- Email -->
                <div class="input-group input-box">
                    <!-- Icono -->
                    <span class="icon">
                        <i class="bi bi-envelope"></i>
                    </span>

                    <input type="email" name="usmail" id="usmail" class="form-control" required value="<?php echo $objUsuario->getusmail(); ?>">
                    <label>usuario123@example.com</label>

                    <!-- Mensajes aprobado y error -->
                    <div class="valid-feedback">Ok!</div>
                    <div class="invalid-feedback">Email invalida</div>
                </div>
                
                <div class="botones">
                    <!-- Boton registrar -->
                    <button type="submit" value="Registrar" class="btn-registrar">Guardar Cambios</button>

                    <!-- Botón volver a login -->
                    <button type="submit" value="Ir a login" onclick="window.location.href='paginaSegura.php'" class="btn-ir-login">Salir</button>
                </div>
            </form>
        </div>
    </body>
</section>

<!-- BOOTSTRAP con las validaciones de los campos -->
<script type="text/javascript" src="../js/validacionTp5.js"></script>
<script>
    function convertirClaveMD5(){
        var clave = document.getElementById('clave').value;
        document.getElementById('uspass').value = hex_md5(clave);
        //Borro el valor original de la contraseña en el campo clave 
       // document.getElementById('clave').value = ''; 
    }
    document.getElementById("usnombre").addEventListener("blur", function(){
        validarUsuario(this);
    });
</script>
<!-- Footer -->
<?php include_once '../Estructura/footer_tienda.php'; ?>