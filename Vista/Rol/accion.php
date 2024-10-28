<?php
    include_once("../estructura/headerSeguro.php");
    $resp = false;
    $objTrans = new AbmRol();

    if(!isset($datos)) {
        $datos = data_submitted();
    } 
    if (isset($datos['accion'])){
        if($datos['accion']=='listar' or $datos['accion']=='Limpiar'){
            $lista = convert_array($objTrans->buscar(null));
        } elseif($datos['accion']=='Filtrar'){
            $lista = convert_array($objTrans->filtrarPorNombre($datos['roldescripcion']));
        } else {
            $resp = $objTrans->abm($datos);
            if($resp){
                $mensaje = "La accion ".$datos['accion']." se realizo correctamente.";
            }else {
                $mensaje = "La accion ".$datos['accion']." no pudo concretarse.";
            }
            echo $mensaje;
            if($datos['accion'] == 'nuevo'){
                echo ("<script>location.href = './editar.php?accion=nuevo&id=-1';</script>");
            }else{
            echo ("<script>location.href = './index.php?msg=$mensaje';</script>");
            }
        }
        }
        
?>
