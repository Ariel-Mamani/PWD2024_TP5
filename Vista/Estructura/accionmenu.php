<?php

    $usuario = NULL;
    if ($objSession->getUsuario()->getusnombre() <> null){
        $usuario = $objSession->getUsuario()->getusnombre();
    }
    $cadenaMenu = "";
    $objAbmMenuRol = new AbmMenuRol();
    if ($objSession->getRol() <> null){
        $param['idrol'] = $objSession->getRol()->getidrol();
        $listaMenuRol = $objAbmMenuRol->buscar($param);
        if ($listaMenuRol >0){
            foreach($listaMenuRol as $menuRol){
                $menu = $menuRol->getMenu()->getmenunombre();
                if ($menu <> 'null'){
                    $url = $menuRol->getMenu()->getmenuurl();
                    $cadenaMenu .= '<li><a class="dropdown-item" href="'.$VISTA.$url.'">'.$menu.'</a></li>'; 
                }
            }
        }
    }
        
?>
