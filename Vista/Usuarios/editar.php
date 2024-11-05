<?php
    $titulo = " Usuario ";
    include_once("../estructura/headerSeguro.php");

    $datos = data_submitted();
    if (empty($datos)){
        header("Location: ".$VISTA."Inicio/principal.php");
        die();
    }else{

        $AbmUsuario = new AbmUsuario();
        $objAbmUsuarioRol = new AbmUsuarioRol();
        $objAbmRol = new AbmRol();
        $listaRol = $objAbmRol->buscar(null);

        $obj = NULL;
        $objRol = NULL;
        if (isset($datos['idusuario']) && $datos['idusuario'] <> -1){
            $listaUsuario = $AbmUsuario->buscar($datos);
            if (count($listaUsuario) == 1){
                $obj = $listaUsuario[0];
                $listaAbmUsuarioRol = $objAbmUsuarioRol->buscar($datos);
                if (count($listaAbmUsuarioRol) == 1){
                    $objRol = $listaAbmUsuarioRol[0]->getRol();
                }
            }
        }
    }
?>

<section>
    <!-- editarBorrar box -->
    <div class="editarBorrar-box">

        <!-- Curva -->
        <div class="curva-editarBorrar" id="curva-editarBorrar"></div>

        <!-- Formulario editarBorrar -->
        <form method="post" action="accion.php">
            <input id="idusuario" name="idusuario" type="hidden" value="<?php echo ($obj != null) ? $obj->getidusuario() : "-1"?>" readonly required >
            <input id="accion" name="accion" value="<?php echo ($datos['accion'] != null) ? $datos['accion'] : "nose"?>" type="hidden">

            <!-- Titulo -->
            <h2><?php echo ($datos['accion'] != null) ? $datos['accion'] : "nose"?> Usuario</h2>

            <!-- Nombre usuario  -->
            <div class="input-group mb-4 input-box">
                <!-- Icono -->
                <span class="icon" id="basic-addon1">
                    <ion-icon name="person"></ion-icon>
                </span>

                <input id="usnombre" name="usnombre" type="text" class="form-control" value="<?php echo ($obj !=null) ? $obj->getusnombre() : ""?>" required>
                <label>Usuario</label>

                <!-- Mensajes aprobado y error -->
                <div class="valid-feedback">Ok!</div>
                <div class="invalid-feedback">El nombre de usuario solo debe contener letras sin números ni símbolos</div>
            </div>

            <!-- Email -->
            <div class="input-group mb-4 input-box">
                <!-- Icono -->
                <span class="icon" id="basic-addon2">
                    <ion-icon name="mail"></ion-icon>
                </span>

                <input id="usmail" name="usmail" type="text" class="form-control" value="<?php echo ($obj != null) ? $obj->getusmail() : ""?>" required>
                <input type="hidden" name="uspass" id="uspass">
                <label>E-mail</label>
                
                <!-- Mensajes aprobado y error -->
                <div class="valid-feedback">Ok!</div>
                <div class="invalid-feedback">Valor de contraseña incorrecto</div>
            </div>


            <div class="botones">
                    <!-- Boton registrar -->
                    <input type="submit" class="btn-editarBorrar-usuario btn-block  m-2" value="<?php echo ($datos['accion'] != null) ? $datos['accion'] : "nose"?>">

                    <!-- Botón volver a login -->
                    <button type="button" onclick="history.back()" class="btn-volver">Volver</button>
                </div>
        </form>
</section>

<!-- Iconos -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


<!-- Footer -->
<?php
include_once("../estructura/footer.php");
?>