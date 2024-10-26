<?php
$titulo = "TP 5 - Registrar ";
include_once '../Estructura/header.php';
?>
<div class="divtitulo">
    <h1 class='text-center mb-4 text-white'><?php echo $titulo;?></h1>
</div>
<body>
<!-- Formulario de Registro -->
<form id="form" name="form" action="procesar_registro.php" method="get" class="full-height p-5">
    <div class="form-group text-center">
        <label for="usuario">Nombre usuario:</label>
        <input type="text" name="usuario" id="usuario" required><br><br>

        <label for="clave">Contraseña:</label>
        <input id="clave" name="clave" type="password" required>
        <a onclick='document.getElementById("md5").value=hex_md5(document.getElementById("clave").value)' href="#"></a><br><br>
        <!-- investigar sobre password_hash() -->

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <input type="submit" value="Registrar">
    </div>
</form>
</body>

<!-- Footer -->
<?php include_once '../Estructura/footer.php'; ?>