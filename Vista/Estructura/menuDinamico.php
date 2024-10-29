<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo $VISTA ?>Inicio/principal.php">Grupo 5</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav"> 
          <!-- Menu TP 5 -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">TP N° 5</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?php echo $VISTA ?>Usuarios/index.php">Lista usuarios</a></li>
              <li><a class="dropdown-item" href="<?php echo $VISTA ?>Rol/index.php">Lista rol</a></li>
            </ul>
          </li>          
        </ul>
        <form action="<?php echo $VISTA ?>Login/verificarLogin.php" method="post">
          <label for="lusuario" class="labelUsuario" ><?php echo $_SESSION['usnombre'] .'<img src="../Imagenes/gatito.png" alt="Avatar Gatito" style="width:40px;" class="rounded-pill"> '; ?>  </label>
          <!-- <label for="laberRol"><?php echo "Rol: ". $_SESSION['rol']; ?></label>    -->     
          <input type="text" name="cerrarSession" id="cerrarSession" value="1" hidden>
          <button class="btn btn-primary" type="submit" id="btnSalir" >Salir</button>
        </form>
      </div>
    </div>
  </nav>

