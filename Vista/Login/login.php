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
        <a onclick='document.getElementById("md5").value=hex_md5(document.getElementById("clave").value)' href="#"></a><br><br>

        <input type="submit" value="Enviar">
        </div>
    </form>
</body>
<!-- Footer -->
<?php include_once '../Estructura/footer.php'; ?>




