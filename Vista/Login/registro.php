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
        <input type="hidden" name="clave_md5" id="clave_md5">
        <!-- investigar sobre password_hash() -->

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <input type="submit" value="Registrar" onclick="convertirClaveMD5()">
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