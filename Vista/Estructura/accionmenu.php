<?php

    $usuario = NULL;
    if ($objSession->getUsuario()->getusnombre() <> null){
        $usuario = $objSession->getUsuario()->getusnombre();
    }
    $cadenaMenu = "";
    $objAbmMenuRol = new AbmMenuRol();
    if ($objSession->getRol() <> NULL){
        $param['idrol'] = $objSession->getRol()->getidrol();
        $listaMenuRol = $objAbmMenuRol->buscar($param);
        if ($listaMenuRol >0){
            foreach($listaMenuRol as $menuRol){
                $menu = $menuRol->getMenu()->getMenombre();
                if ($menu <> ''){
                    $url = $menuRol->getMenu()->getMedescripcion();
                  //  if ($menuRol->getMenu()->getObjMenu() == NULL){
                        $cadenaMenu .= '<li><a class="dropdown-item" href="'.$VISTA.$url.'">'.$menu.'</a></li>'; 
                   // }else{                    }
                }
            }
        }
    }
        
?>
