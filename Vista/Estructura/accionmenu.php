<?php

    $objAbmMenuRol = new AbmMenuRol();
    $usuario = $objSession->getUsuario()->getusnombre();
    $rol = $objSession->getRol()->getidrol();


    $param['idrol'] = $rol;
    $listaMenuRol = $objAbmMenuRol->buscar($param);

    $cadenaMenu = "";
    foreach($listaMenuRol as $menuRol){
        $menu = $menuRol->getMenu()->getmenunombre();
        $url = $menuRol->getMenu()->getmenuurl();
        $cadenaMenu .= '<li><a class="dropdown-item" href="'.$VISTA.$url.'">'.$menu.'</a></li>'; 
    }



        
?>
