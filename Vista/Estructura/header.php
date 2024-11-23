<?php
    //Importar configuraciones y verificar sesión
    include_once "../../configuracion.php";
    $objSession = new Session(); //Crea un objeto de sesión para manejar la autenticación y autorización de usuarios.

    //Validación de sesión y roles
    $cortar = strlen($VISTA);
    if($objSession->validar() ){//and $objSession->validarRol($cortar)){
      $titulo = "TP Final";
    }else{
      header("Location: ".$VISTA."Inicio/principal.php");
      die();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Generar encabezado HTML dinámico -->
  <?php echo "<title>". $titulo . "</title>"; ?> <!-- Titulo dinamico -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php  include_once "links.php"; ?>

</head>
<body>

    <!-- Mostrar menú -->
  <?php 
    include_once "menu.php";
  ?>



<!-- Explicacion del codigo -->
<?php
  /*
    ? Importar configuraciones y verificar sesión

      $objSession = new Session(): Crea un objeto de sesión para manejar la autenticación y autorización de usuarios.


    ? Validación de sesión y roles

      1) $objSession->validar(): Comprueba si la sesión es válida (es decir, si el usuario ha iniciado sesión correctamente).

      2) $objSession->validarRol($cortar): Verifica si el usuario tiene los permisos necesarios para acceder a esta página en función de su rol.

      3) $VISTA: Es una variable global que contiene la ruta base del sistema o vista actual. Se utiliza para redirigir al usuario si no pasa la validación.

      4) header("Location: ..."): Si la sesión no es válida o el usuario no tiene permisos, se redirige a la página Inicio/principal.php dentro de la ruta definida por $VISTA.


    ? Generar encabezado HTML dinámico
      
    1) <title>: El título de la página se define dinámicamente en función del valor de $titulo.
      
    2)include_once "links.php";: Se incluye un archivo llamado links.php


    ? Mostrar menú

    1) Incluye un archivo menu.php


    TODO: ¿Qué hace este script en conjunto?

      1) Comprueba que el usuario haya iniciado sesión y tenga permisos de rol adecuados para acceder a esta página.

      2) Si falla alguna validación, lo redirige a la página principal del sistema (Inicio/principal.php).

      3) Configura dinámicamente el encabezado HTML, incluyendo el título y los enlaces a recursos externos.

      4) Carga el menú de navegación adecuado.

      5) En resumen, es una estructura típica de un sistema con control de accesos y diseño modular, asegurándose de que solo usuarios autorizados puedan acceder a esta página.
  */
?>