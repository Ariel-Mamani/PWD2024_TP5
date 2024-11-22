<?php

    $usuario = NULL;
    if ($objSession->getUsuario()->getusnombre() <> null){
        $usuario = $objSession->getUsuario()->getusnombre();
    }
    $cadenaMenu = '<ul class="navbar-nav">';
    $objAbmMenuRol = new AbmMenuRol();
    if ($objSession->getRol() <> NULL){
        $param['idrol'] = $objSession->getRol()->getidrol();
        $listaMenuRol = $objAbmMenuRol->buscar($param);
        if (count($listaMenuRol) >0){
            foreach($listaMenuRol as $menuRol){
                $objMenuP = $menuRol->getMenu();
                if($objMenuP->getObjMenu() == NULL){
                    $cadenaMenu .= '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">'.$objMenuP->getMenombre().'</a>';
                    $cadenaMenu .= '<ul class="dropdown-menu">';
                    $par['idpadre'] = $objMenuP->getIdmenu();
                    $objAbmMenu = new AbmMenu();
                    $listaObjMenu = $objAbmMenu->buscar($par);
                    foreach($listaObjMenu as $objMenu){
                        $url = $objMenu->getMedescripcion();
                        $nombre = $objMenu->getMeNombre();
                        $cadenaMenu .= '<li><a class="dropdown-item" href="'.$VISTA.$url.'">'.$nombre.'</a></li>'; 
                    }
                    $cadenaMenu .= '</ul></li>';
                }              
            }

        }
    }
    $cadenaMenu .= '</ul><li><a href="../Carrito/carrito.php"><span id="cuenta-carrito"></span><i class="bi bi-cart " style="font-size: 25px;"></i></a></li>';
        
?>
<!--
        <ul class="navbar-nav"> 
          <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Acciones</a>
            <ul class="dropdown-menu">

              
            </ul>
          </li>          
        
        </ul>
        <li><a href="../Carrito/carrito.php"><span id="cuenta-carrito"></span><i class="bi bi-cart " style="font-size: 25px;"></i></a></li>
-->