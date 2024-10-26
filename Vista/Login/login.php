<?php
$titulo = "TP 5 - Login ";
session_start();
include_once '../Estructura/header.php';
?>
<div class="divtitulo">
    <h1 class='text-center mb-4 text-white'><?php echo $titulo;?></h1>
</div>
<body>
<?php 
// El mensaje viene del script procesar_login.php
// Mi idea es mostrar el mensaje de que el usuario se registro
// Verifica si hay un mensaje en la sesión y lo muestra
if (isset($_SESSION['mensaje']) && $_SESSION['mensaje'] != '') {
    echo "<h1>{$_SESSION['mensaje']}</h1>";
}
?>
<!-- Formulario Login -->
    <form id="form" name="form" action="verificarLogin.php" method="get" class="full-height  p-5">
        <div class="form-group text-center">
        <label for="usuario">Nombre usuario:</label>
        <input type="text" name="usuario" id="usuario" required><br><br>

        <label for="clave">Contraseña:</label>
        <input id="clave" name="clave" type="password" required>
        <!-- Es unncampo oculto, clave_md5 es la clave que viaja encriptada -->
        <input type="hidden" name="clave_md5" id="clave_md5"> 
        
        <input type="submit" value="Enviar" onclick="convertirClaveMD5()">
        </div>
    </form>
</body>
<script>
    function convertirClaveMD5(){
        var clave = document.getElementById('clave').value;
        document.getElementById('clave_md5').value = hex_md5(clave); 
        //Borro el valor original de la contraseña en el campo clave 
        document.getElementById('clave').value = ''; 
    }
</script>
<!-- Footer -->
<?php include_once '../Estructura/footer.php'; ?>




