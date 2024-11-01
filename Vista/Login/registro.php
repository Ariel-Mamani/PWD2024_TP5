<?php
$titulo = "TP 5 - Registrar ";
include_once '../Estructura/header.php';
?>

<section>
    <!-- div para colocar el mensaje -->
    <div class="div-mensaje"></div>

    <?php
    // El mensaje viene del script verificarLogin.php
    // Se mostrara un mensaje ya que el usuario quiso entrar al login sin haberse registrado antes
    // Verifica si hay un mensaje en la sesión y lo muestra
    if (isset($_SESSION['mensaje']) && $_SESSION['mensaje'] != '') {
        echo "<h1 class='bg-dark text-light p-2'>{$_SESSION['mensaje']}</h1>";
        // Limpia el mensaje para que no vuelva a mostrarse en el próximo acceso
        unset($_SESSION['mensaje']);
    }
    ?>

    <body>
        <!-- Register box -->
        <div class="register-box">

            <!-- Curva -->
            <div class="curva-registro" id="curva-registro"></div>

            <!-- Formulario de Registro -->
            <form id="form" name="form" action="procesar_registro.php" method="get" class="needs-validation" novalidate>

                <!-- Titulo -->
                <h2>Registro</h2>

                <!-- Nombre usuario  -->
                <div class="input-group mb-4 input-box">
                    <!-- Icono -->
                    <span class="icon" id="basic-addon1">
                        <ion-icon name="person"></ion-icon>
                    </span>

                    <input type="text" name="usnombre" id="usnombre" class="form-control" required>
                    <label>Usuario</label>
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
                    <!-- investigar sobre password_hash() -->
                    
                    <!-- Mensajes aprobado y error -->
                    <div class="valid-feedback">Ok!</div>
                    <div class="invalid-feedback">Valor de contraseña incorrecto</div>
                </div>

                <!-- Email -->
                <div class="input-group input-box">
                    <!-- Icono -->
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>

                    <input type="email" name="usmail" id="usmail" class="form-control" required>
                    <label>usuario123@example.com</label>

                    <!-- Mensajes aprobado y error -->
                    <div class="valid-feedback">Ok!</div>
                    <div class="invalid-feedback">Email invalida</div>
                </div>
                
                <div class="botones">
                    <!-- Boton registrar -->
                    <button type="submit" value="Registrar" class="btn-registrar">Registrarse</button>

                    <!-- Botón volver a login -->
                    <button type="submit" value="Ir a login" onclick="window.location.href='login.php'" class="btn-ir-login">Ir a login</button>
                </div>
            </form>
        </div>
    </body>
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
       // document.getElementById('clave').value = ''; 
    }
    document.getElementById("usnombre").addEventListener("blur", function(){
        validarUsuario(this);
    });
</script>
<!-- Footer -->
<?php include_once '../Estructura/footer.php'; ?>