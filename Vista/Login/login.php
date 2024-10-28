<?php
$titulo = "TP 5 - Login ";

include_once '../Estructura/header.php';
$objSession = new Session();
?>
<div class="divtitulo">
    <h1 class='text-center mb-4 text-white'><?php echo $titulo;?></h1>
</div>
<body>
<?php 
// El mensaje viene del script procesar_login.php y verificarLogin.php
// Mi idea es mostrar el mensaje de que el usuario se registro
// Verifica si hay un mensaje en la sesión y lo muestra
if (isset($_SESSION['mensaje']) && $_SESSION['mensaje'] != '') {
    echo "<h1 class = 'bg-dark text-light p-2'> {$_SESSION['mensaje']}</h1>";
    // Limpia el mensaje para que no vuelva a mostrarse en el próximo acceso
    unset($_SESSION['mensaje']);
}
?>

<div class="divform rounded p-4 shadow">
<!-- Formulario Login -->
    <form id="form" name="form" action="verificarLogin.php" method="post" class="full-height p-5 needs-validation" novalidate>
        <!-- Nombre usuario  -->
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person" style="font-size: 22px; color: black;"></i></span>
            <input type="text" name="usnombre" id="usnombre" class="form-control" placeholder="Usuario" required><br><br>
            <!-- Mensajes aprobado y error -->
            <div class="valid-feedback">Ok!</div>
            <div class="invalid-feedback">El nombre de usuario solo debe contener letras sin números ni símbolos</div>
        </div>
        <!-- Contraseña -->
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon2"><i class="bi bi-lock-fill" style="font-size: 22px;"></i></span>
            <input id="clave" name="clave" type="password" class="form-control" placeholder="Contraseña" required onblur="return convertirClaveMD5()">
            <input type="hidden" name="uspass" id="uspass">
            <!-- Mensajes aprobado y error -->
            <div class="valid-feedback">Ok!</div>
            <div class="invalid-feedback">Valor de contraseña incorrecto</div>
        </div>
        
        <input type="submit" value="Enviar" class="btn btn-primary mt-5" >
    </form>
</div>
</body>
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




