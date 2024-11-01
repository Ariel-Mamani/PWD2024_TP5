<?php
$titulo = "TP 5 - Pagina Segura ";

include_once '../Estructura/headerSeguro.php';
?>

<section>
    <div class="divtitulo">
        <!--<h1 class='text-center mb-4 text-white'><?php //echo $titulo;?></h1>-->
        
        <?php  
        /* $enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
            echo $enlace_actual;
            var_dump(parse_url($enlace_actual, PHP_URL_PATH));*/
        ?>
    </div>

    <!-- Titulo -->
    <h1>P&aacute;gina Segura</h1>

    <div class="m-3">
        <a class="btn btn-editar-pass-seg" role="button" href="<?php echo $VISTA?>/Usuarios/editarPass.php?accion=editarPass"><i class="bi bi-pencil"></i> Editar Contraseña</a> 
    </div>

    <div>
        <a class="btn btn-editar-rol m-3" role="button" href="<?php echo $VISTA?>/UsuarioRol/editarRol.php?accion=editar"><i class="bi bi-pencil"></i> Editar Rol</a> 
    </div>
</section>

<!-- Footer -->
<?php include_once '../Estructura/footer.php'; ?>