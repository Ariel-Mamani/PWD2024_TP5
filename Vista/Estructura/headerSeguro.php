<?php
    include_once "../../configuracion.php";
    $objSession = new Session();
    if(!$objSession->validar()){
        header("Location: ".$VISTA."Inicio/principal.php");
    }else{
        $titulo = "TP 5 - Login ";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php echo "<title>". $titulo . "</title>"; ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php  include_once "links.php"; ?>

</head>
<body>
  <?php 
    include_once "menuDinamico.php";
    }
  ?>