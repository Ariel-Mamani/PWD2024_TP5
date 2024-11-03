<?php
$titulo = "TP 5 - Pagina Segura ";

include_once '../Estructura/headerSeguro.php';
?>

<section>
    <div class="divtitulo">
        <!--<h1 class='text-center mb-4 text-white'><?php //echo $titulo;?></h1>-->

    </div>

    <!-- Titulo -->
    <h1>P&aacute;gina Segura</h1>

    <?php
/*
$resp = false;
$param['idrol'] = $objSession->getRol()->getidrol();
$enlace_actual = substr(strtolower('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']),35);
$param['menuurl'] = $enlace_actual;
$objAbmMenu = new AbmMenu();
$listaMenu = $objAbmMenu->buscar($param);

if(count($listaMenu) == 1){
    $param['idmenu'] = $listaMenu[0]->getidmenu();

    $objAbmMenuRol = new AbmMenuRol();
    $listaMenuRol = $objAbmMenuRol->buscar($param);
    if(count($listaMenuRol) > 0){
        echo "Todo BIEN";
        $resp = true;
    }
}*/

?>

    <div class="m-3">
        <a class="btn btn-editar-pass-seg" role="button" href="<?php echo $VISTA?>/Usuarios/editarPass.php?accion=editarPass"><i class="bi bi-pencil"></i> Editar Contraseña</a> 
    </div>

    <div>
        <a class="btn btn-editar-rol m-3" role="button" href="<?php echo $VISTA?>/UsuarioRol/editarRol.php?accion=editar"><i class="bi bi-pencil"></i> Editar Rol</a> 
    </div>
</section>

<!-- Footer -->
<?php include_once '../Estructura/footer.php'; ?>