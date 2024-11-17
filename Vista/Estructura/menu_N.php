    <nav class="navbar navbar-expand-sm bg-dark navbar-dark ">

        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo $VISTA ?>Inicio/principal.php">Grupo 5</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav"> 
                    <!-- Menu TP 5 -->

                    <!-- Boton 2 - Pagina Principal -->
                    <li class="nav-item">
                        <a class="nav-link" href="../Paginas/01_reservar.php">P&aacute;gina Principal</a>
                    </li>

                    <!-- Boton 3 - Comprar -->
                    <li class="nav-item">
                        <a class="nav-link" href="../Paginas/02_productos.php">Comprar</a>
                    </li>

                    <!-- Boton 4 - Informacion Util -->
                    <li class="nav-item">
                        <a class="nav-link" href="../Paginas/informacion_util.php">Informaci&oacute;n &Uacute;til</a>
                    </li>

                    <!-- Boton 5 - Sobre Nosotros -->
                    <li class="nav-item">
                        <a class="nav-link" href="../Paginas/sobre_nosotros.php">Sobre Nosotros</a>
                    </li>

                    <!-- Boton 6 - Fotos -->
                    <li class="nav-item">
                        <a class="nav-link" href="../Paginas/fotos.php">Fotos</a>
                    </li>

                    <!-- Boton 7 - Contacto -->
                    <li class="nav-item">
                        <a class="nav-link" href="../Paginas/contacto.php">Contacto</a>
                    </li>

                    <!-- Boton 8 - Login -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Login/Registro</a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo $VISTA ?>Login/login.php">Login</a></li>
                        <li><a class="dropdown-item" href="<?php echo $VISTA ?>Login/registro.php">Registrar</a></li>
                        </ul>
                    </li>
                    <li><a href="../Paginas/carrito.php"><span id="cuenta-carrito"></span><i class="bi bi-cart " style="font-size: 25px;"></i></a></li>
                </ul>

                <div class="d-flex align-items-center ms-auto">
                    <label for="lusuario" class="labelUsuario" style="position:relative; ">An&oacute;nimo  <img src="../Imagenes/anonimo.png" alt="Avatar Anonimo" style="width:40px; " class="rounded-pill"> </label>
                </div>
            </div>
        </div>
    </nav>

