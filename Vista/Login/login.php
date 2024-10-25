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
<!-- Footer -->
<?php include_once '../Estructura/footer.php'; ?>




