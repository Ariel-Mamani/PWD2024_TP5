<?php
session_start();
/*
sesion star
crear el objeto session
cargar usuario y contraseña en el obj con $objSession->iniciar()
$objSession->validar()
si es true va a pagina segura con header("Location: vista/inicio/principalSegura.php");
si es false $objSession->cerrar() -->> header("Location: vista/Login/login.php");

*/
$titulo = "TP 5 - Login";
include_once '../../Estructura/header.php';
echo '<div class="divtitulo"> <h1>';
echo $titulo.'</h1></div>';
if(!empty(data_submitted())){
    $recibido = data_submitted();
    $nombreUsuario = $recibido['usuario'];
    $psw = $recibido['clave'];
    // Crea el objeto de la sesion
    $objSession = new Session();
    $objSession->iniciar($nombreUsuario,$psw);
    if($objSession->validar()){
        // Si es correcto, redirige a la página segura
        header("Location: vista/inicio/paginaSegura.php");
    }else{
        // Si es incorrecto, cierra la sesión y redirige al login
        $objSession->cerrar();
        $_SESSION['mensaje'] = "Usuario o contraseña incorrectos.";
        header("Location: vista/Login/login.php");
    }
    ?>
    
    <div id="botones" class="d-flex justify-content-center">
        <a href="../login.php" class="btn btn-tp2" role="button">Volver</a>
    </div>
<?php
}
include_once '../../Estructura/footer.php';
?>