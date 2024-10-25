<?php
$titulo = "TP 5 - Login ";
include_once '../Estructura/header.php';
?>
<div class="divtitulo">
    <h1 class='text-center mb-4 text-white'><?php echo $titulo;?></h1>
</div>
<body>
<!-- Formulario Login -->
    <form id="form" name="form" action="verificarLogin.php" method="get" class="full-height  p-5">
        <div class="form-group text-center">
            Nombre usuario:<input type="text" name="" id="" required><br><br>
            Contraseña:<input type="text" name="" id="" required><br><br>
            <input type="submit" value="Enviar">
        </div>
    </form>
</body>

clave <input id="clave" name="clave" type="text">
<a onclick='document.getElementById("md5").value=hex_md5(document.getElementById("clave").value)' href="#">
<!-- Footer -->
<?php include_once '../Estructura/footer.php'; ?>




