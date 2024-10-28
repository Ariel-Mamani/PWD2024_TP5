<?php header('Content-Type: text/html; charset=utf-8');
header ("Cache-Control: no-cache, must-revalidate ");

/////////////////////////////
// CONFIGURACION APP//
/////////////////////////////

$PROYECTO ='PWD2024_TP5';

//variable que almacena el directorio del proyecto
$ROOT =$_SERVER['DOCUMENT_ROOT']."/".$PROYECTO."/";

include_once ($ROOT.'Util/funciones.php');


// Variable que define la pagina de autenticacion del proyecto
$INICIO = "http://".$_SERVER['HTTP_HOST']."/$PROYECTO/Vista/Login/login.php";

$VISTA = "http://".$_SERVER['HTTP_HOST']."/$PROYECTO/Vista/";

// variable que define la pagina principal del proyecto (menu principal)
$PRINCIPAL = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/vista/inicio/principal.php";


$GLOBALS['ROOT']=$ROOT;

?>
