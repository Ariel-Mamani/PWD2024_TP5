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
                    $cadenaMenu .= '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" href="#">'.$objMenuP->getMenombre().'</a>';
                    $cadenaMenu .= '<ul class="dropdown-menu">';
                    $par['idpadre'] = $objMenuP->getIdmenu();
                    $objAbmMenu = new AbmMenu();
                    $listaObjMenu = $objAbmMenu->buscar($par);
                    foreach($listaObjMenu as $objMenu){
                        if ($objMenu->getMeNombre() != ''){

                            $url = $objMenu->getMedescripcion();
                            $nombre = $objMenu->getMeNombre();
                            $cadenaMenu .= '<li><a class="dropdown-item" href="'.$VISTA.$url.'">'.$nombre.'</a></li>'; 
                        }
                    }
                    $cadenaMenu .= '</ul></li>';
                }              
            }    

        }
    }
    $cadenaMenu .= '</ul><li><a href="';
    if ($objSession->validarCompra()){$cadenaMenu .= '../Carrito/carrito.php';
    }else{$cadenaMenu .='#';    }
    $cadenaMenu .= '"><span id="cuenta-carrito"></span><i class="bi bi-cart " style="font-size: 25px;"></i></a></li>';
?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo $VISTA ?>Inicio/principal.php">Grupo 5</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <?php echo $cadenaMenu;  ?>  
        <form action="<?php echo $VISTA ?>Login/verificarLogin.php" method="post" class="d-flex align-items-center ms-auto">
          <label for="lusuario" class="labelUsuario " style="position: relative; left:auto;"><?php echo $usuario.' ('.( $objSession->getRol() <> null ? $objSession->getRol()->getroldescripcion() : "" ).')'.'<img src="../Imagenes/gatito.png" alt="Avatar Gatito" style="width:40px;" class="rounded-pill m-3"> '; ?>  </label>
          <input type="text" name="cerrarSession" id="cerrarSession" value="1" hidden>
          <button class="btn btn-danger" type="submit" id="btnSalir" >Salir</button>
        </form>
      </div>
    </div>
  </nav>

