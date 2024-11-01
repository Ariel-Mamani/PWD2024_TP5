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
<!-- Probando boludeces XD -->
<h1 class="bg-primary"><?php echo $obj->getusnombre() . " - ID: " . $obj->getidusuario() . " - Rol: " . $tuRol; ?></h1>

<form method="post" action="accion.php">
    <input id="idusuario" name="idusuario" type="hidden" value="<?php echo ($obj != null) ? $obj->getidusuario() : "-1" ?>" readonly required>
    <input id="idrol" name="idrol" type="hidden" value="<?php echo ($obj != null) ? $objSession->getRol()->getidrol() : "-1" ?>" readonly required>

    <input id="accion" name="accion" value="<?php echo ($datos['accion'] != null) ? $datos['accion'] : "nose" ?>" type="hidden">
    
    <div class="row mb-12">
        <div class="col-sm-12 ">
            <div class="form-group has-feedback">
                <!-- Selección de Rol -->
                <div class="mb-3 form-floating">
                    <select name="idrol" id="idrol" class="form-control text-primary" required>
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
                    <label for="rol" class="form-label">Tu rol actual</label>
                    <!-- Mensajes de validación -->
                    <div class="valid-feedback">Ok!</div>
                    <div class="invalid-feedback">Campo obligatorio</div>
                </div>
            </div>
        </div>
    </div>
    
    <input type="submit" class="btn btn-primary btn-block m-2" value="<?php echo ($datos['accion'] != null) ? $datos['accion'] : "nose" ?>">
</form>
<a href="../Login/paginaSegura.php" class="btn bg-warning m-2">Volver</a>

<!-- Validaciones de Bootstrap -->
<script type="text/javascript" src="../Js/validacionTP5.js"></script>
