<?php
$titulo = "TP 5 - Login ";

include_once '../Estructura/headerSeguro.php';
?>
<div class="divtitulo">
    <h1 class='text-center mb-4 text-white'><?php echo $titulo;?></h1>
    <h1>¿¿Pagina Segura??</h1>
</div>
<div class="bg-light ">
    <a class="btn btn-info" role="button" href="<?php echo $VISTA?>/Usuarios/editarPass.php?accion=editarPass"><i class="bi bi-pencil"></i>Editar Contraseña</a> 
</div>
<!-- Footer -->
<?php include_once '../Estructura/footer.php'; ?>