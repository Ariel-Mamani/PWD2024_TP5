<?php
    include_once("../Estructura/headerSeguro.php");
    $resp = false;
    $objAbmUsuario = new AbmUsuario();
    $objRol = new AbmRol();
    $objAbmUsuarioRol = new AbmUsuarioRol();
    $listaUsuarioRol = $objAbmUsuarioRol->buscar(null); 

    if(!isset($datos))
    {
        $datos = data_submitted();
    } 

    if (isset($datos['accion']))
    {
        if($datos['accion']=='listar' or $datos['accion']=='Limpiar')
        {
            $lista = $objAbmUsuarioRol->buscar(null);
        }else{
            $resp = $objAbmUsuarioRol->abm($datos);
            if($resp)
            {
                $mensaje = "La accion ".$datos['accion']." se realizo correctamente.";
            }else {
                $mensaje = "La accion ".$datos['accion']." no pudo concretarse.";
            }
            echo $mensaje;

            if($datos['accion'] == 'nuevo')
            {
                echo ("<script>location.href = './editarRol.php?accion=nuevo&id=-1';</script>");
            }else{
                echo ("<script>location.href = '../Login/paginaSegura.php?msg=$mensaje';</script>");
            }
        }
    }
?>
