<?php
    $titulo = " Usuario Cambiar Rol ";
    include_once("../estructura/headerSeguro.php");
    $datos = data_submitted();
    $AbmUsuario = new AbmUsuarioRol();
    $obj = $objSession->getUsuario();
    $obj->getidusuario( );

    // Obtengo el rol de mi session
    $tuRol = $objSession->getRol()->getroldescripcion();

    //Listo a todos los roles para mostrarlos
    $AbmRol = new AbmRol();
    $roles = $AbmRol->buscar(null);
    
?>

<section>
    <!-- Probando boludeces XD -->
    <h2><?php echo $obj->getusnombre() . " - ID: " . $obj->getidusuario() . " - Rol: " . $tuRol; ?></h2>
    <br>

    <!-- Editar rol -->
    <div class="editar-rol-box">
        <!-- Curva -->
        <div class="curva-editar-rol" id="curva-editar-rol"></div>

        <!-- Formulario -->
        <form method="post" action="accion.php" class="full-height p-5 needs-validation">
            <input id="idusuario" name ="idusuario" type="hidden" value="<?php echo ($obj !=null) ? $obj->getidusuario() : "-1"?>" readonly required>
            <input id="accion" name ="accion" value="<?php echo ($datos['accion'] !=null) ? $datos['accion'] : "nose"?>" type="hidden">
            <div class="row mb-12">
                <div class="col-sm-12 ">
                    <div class="form-group has-feedback">

                        <!-- Contraseña -->
                        <div class="input-group mb-4 input-box">
                            <!-- Icono -->
                            <span class="icon" id="basic-addon2">
                                <i class="bi bi-chevron-down"></i>
                            </span>

                            <input id="clave" name="clave" type="password" class="form-control" required onblur="return convertirClaveMD5()">
                            <input type="hidden" name="uspass" id="uspass">
                            <label>Tu rol actual</label>

                            <select name="idrolnuevo" id="idrolnuevo" class="form-control select-rol" required>
                                <option value="" disabled selected>Seleccione un rol</option>
                                <?php
                                // Comprobar si hay roles disponibles en el arreglo $roles
                                if(count($roles) > 0){
                                    foreach($roles as $rol){
                                        // Verificar si el rol actual coincide con el rol del usuario en sesión $tuRol
                                        $selected = ($rol->getroldescripcion() == $tuRol) ? "selected" : "";
                                        echo '<option value="' . $rol->getidrol() . '" ' . $selected . '>' . $rol->getroldescripcion() . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Botones -->
                        <div>
                            <!-- Boton editar rol -->
                            <input type="submit" class="btn-editar-pass btn-block  m-2" value="<?php echo ($datos['accion'] !=null) ? $datos['accion'] : "nose"?>">
                            <!-- Botón volver a pagina segura -->
                            <button type="button" onclick="history.back()" class="btn-volver">Volver</button>
                        </div>    
                    </div>
                </div>
            </div>
            
            
        </form>
    </div>
</section>

<!-- Validaciones de Bootstrap -->
<script type="text/javascript" src="../Js/validacionTP5.js"></script>

<!-- Footer -->
<?php include_once '../Estructura/footer.php'; ?>
