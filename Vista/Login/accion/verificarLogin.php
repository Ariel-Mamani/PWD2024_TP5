<?php
$titulo = "TP 5 - Login";
include_once '../../Estructura/header.php';
echo '<div class="divtitulo"> <h1>';
echo $titulo.'</h1></div>';
if(!empty(data_submitted())){
    $recibido = data_submitted();
    $nombreUsuario = $recibido['usuario'];
    $psw = $recibido['psw'];
    $usuariosBd =  new AbmUsuario;
    $usuarios = $usuariosBd->buscar(null);
    foreach($usuarios as $usuario){

    }
    ?>
    
        <div id="botones" class="d-flex justify-content-center">
            <a href="../login.php" class="btn btn-tp2" role="button">Volver</a>
        </div>

<?php
}
include_once '../../Estructura/footer.php';
?>