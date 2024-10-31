<?php
$titulo = "TP 5 - Login ";

include_once '../Estructura/header.php';
$objSession = new Session();
?>

<section>
    <!-- div para colocar el mensaje -->
    <div class="div-mensaje"></div>

    <?php 
    // El mensaje viene del script procesar_login.php y verificarLogin.php
    // Mi idea es mostrar el mensaje de que el usuario se registro
    // Verifica si hay un mensaje en la sesión y lo muestra
    if (isset($_SESSION['mensaje']) && $_SESSION['mensaje'] != '') {
        echo "<h1 class='bg-dark text-light p-2'>{$_SESSION['mensaje']}</h1>";
        // Limpia el mensaje para que no vuelva a mostrarse en el próximo acceso
        unset($_SESSION['mensaje']);
    }
    ?>

    <div class="login-box">
    <!-- Formulario Login -->
        <form id="form" name="form" action="verificarLogin.php" method="post" class="full-height p-5 needs-validation" novalidate>

            <!-- Titulo -->
            <h2>Login</h2>

            <!-- Nombre usuario  -->
            <div class="input-group mb-4 input-box">
                <!-- Icono -->
                <span class="icon" id="basic-addon1">
                    <ion-icon name="person"></ion-icon>
                </span>

                <input type="text" name="usnombre" id="usnombre" class="form-control" required>
                <label>Ususario</label>

                <!-- Mensajes aprobado y error -->
                <div class="valid-feedback">Ok!</div>
                <div class="invalid-feedback">El nombre de usuario solo debe contener letras sin números ni símbolos</div>
            </div>

            <!-- Contraseña -->
            <div class="input-group mb-4 input-box">
                <!-- Icono -->
                <span class="icon" id="basic-addon2">
                    <ion-icon name="lock-closed"></ion-icon>
                </span>

                <input id="clave" name="clave" type="password" class="form-control" required onblur="return convertirClaveMD5()">
                <input type="hidden" name="uspass" id="uspass">
                <label>Password</label>
                
                <!-- Mensajes aprobado y error -->
                <div class="valid-feedback">Ok!</div>
                <div class="invalid-feedback">Valor de contraseña incorrecto</div>
            </div>
            
            <!-- Recuerdame y olvide contrasenia -->
            <div class="remember-forgot">
                <label><input type="checkbox">Recuerdame</label>
                <a href="#">Olvido su contrase&ntilde;a?</a>
            </div>

            <!-- Boton -->
            <button type="submit">Login</button>

            <!-- Link para registrarse -->
            <div class="register-link">
                <p>No tiene cuenta? <a href="registro.php">Registrarse</a></p>
            </div>
        </form>
    </div>
</section>

<!-- Iconos -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<!-- BOOTSTRAP con las validaciones de los campos -->
<script type="text/javascript" src="../Js/validacionTP5.js"></script>
<script>
    function convertirClaveMD5(){
        var clave = document.getElementById('clave').value;
        document.getElementById('uspass').value = hex_md5(clave); 
        //Borro el valor original de la contraseña en el campo clave 
        //document.getElementById('clave').value = ''; //onsubmit="return convertirClaveMD5()"
    }
    document.getElementById("usuario").addEventListener("blur", function(){
        validarUsuario(this);
    });
</script>

<!-- Footer -->
<?php include_once '../Estructura/footer.php'; ?>




