<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
    <div class="container-fluid">
      <a class="navbar-brand" href="../Inicio/principal.php">Grupo 5</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav"> 
          <!-- Menu TP 5 -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">TP N° 5</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../Login/login.php">Login</a></li>
              <li><a class="dropdown-item" href="../Login/registro.php">Registrar</a></li>
              <li><a class="dropdown-item" href="../Usuarios/index.php">Lista usuarios</a></li>
            </ul>
          </li>          
        </ul>
        <form action="../Login/verificarLogin.php">
          <label for="lusuario" class="labelUsuario" ><?php echo (isset($_SESSION['usuario'])) ? $_SESSION['usuario'] .'  '.'<img src="../Imagenes/gatito.png" alt="Avatar Gatito" style="width:40px;" class="rounded-pill"> '
          : "Anónimo ". '<img src="../Imagenes/anonimo.png" alt="Avatar Anonimo" style="width:40px;" class="rounded-pill"> '; ?>  </label>
          <input type="text" name="salirSession" id="salirSession" value="1" hidden>
          <button class="btn btn-primary" type="submit" id="btnSalir" >Salir</button>
        </form>
      </div>
    </div>
  </nav>

