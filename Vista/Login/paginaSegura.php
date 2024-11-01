<?php
$titulo = "TP 5 - Login ";

include_once '../Estructura/headerSeguro.php';
?>
<div class="divtitulo">
    <h1 class='text-center mb-4 text-white'><?php echo $titulo;?></h1>
    <h1>Pagina Segura</h1>

    <?php  
    /* $enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        echo $enlace_actual;
        var_dump(parse_url($enlace_actual, PHP_URL_PATH));*/
    ?>
</div>
<div class="bg-light  m-3">
    <a class="btn btn-info" role="button" href="<?php echo $VISTA?>/Usuarios/editarPass.php?accion=editarPass"><i class="bi bi-pencil"></i>Editar Contraseña</a> 
</div>
<div>
    <a class="btn btn-warning m-3" role="button" href="<?php echo $VISTA?>/UsuarioRol/editarRol.php?accion=editarRol"><i class="bi bi-pencil"></i>Editar Rol</a> 
</div>
<!-- Footer -->
<?php include_once '../Estructura/footer.php'; ?>