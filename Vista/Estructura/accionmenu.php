<?php

    $usuario = $objSession->getUsuario()->getusnombre();
    $objAbmMenuRol = new AbmMenuRol();
    $param['idrol'] = $objSession->getRol()->getidrol();
    $listaMenuRol = $objAbmMenuRol->buscar($param);
    if ($listaMenuRol >0){
        $cadenaMenu = "";
        foreach($listaMenuRol as $menuRol){
            $menu = $menuRol->getMenu()->getmenunombre();
            $url = $menuRol->getMenu()->getmenuurl();
            $cadenaMenu .= '<li><a class="dropdown-item" href="'.$VISTA.$url.'">'.$menu.'</a></li>'; 
        }
    }

        
?>
