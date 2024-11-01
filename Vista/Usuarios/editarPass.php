<?php
    $titulo = " Usuario Cambiar Contrase&ntilde;a ";
    include_once("../estructura/headerSeguro.php");
    $datos = data_submitted();
    $AbmUsuario = new AbmUsuario();
    
    $obj =$objSession->getUsuario();

?>

<section>
    <!--Titulo -->
    <h1>Editar contrase&ntilde;a</h1>
    <br>
    
    <!-- Editar pass Box -->
    <div class="editar-pass-box">
        <!-- Curva -->
        <div class="curva-editar-pass" id="curva-editar-pass"></div>

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
                                <i class="bi bi-lock-fill" style="font-size: 22px;"></i>
                            </span>
                            <input id="clave" name="clave" type="password" class="form-control" required onblur="return convertirClaveMD5()">
                            <input type="hidden" name="uspass" id="uspass">
                            <label>Contrase&ntilde;a</label>

                            <!-- Mensajes aprobado y error -->
                            <div class="valid-feedback">Ok!</div>
                            <div class="invalid-feedback">Valor de contraseña incorrecto</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <input type="submit" class="btn-editar-pass btn-block  m-2" value="<?php echo ($datos['accion'] !=null) ? $datos['accion'] : "nose"?>">
        </form>
    </div>
    <a href="index.php" class="btn-volver m-2">Volver</a>
</section>
<!-- BOOTSTRAP con las validaciones de los campos -->
<script type="text/javascript" src="../Js/validacionTP5.js"></script>
<script>
    function convertirClaveMD5(){
        var clave = document.getElementById('clave').value;
        document.getElementById('uspass').value = hex_md5(clave); 
        //Borro el valor original de la contraseña en el campo clave 
        //document.getElementById('clave').value = ''; //onsubmit="return convertirClaveMD5()"
    }
    document.getElementById("usuario").addEventListener("blur", function(){
        validarUsuario(this);
    });
</script>
<?php
include_once("../estructura/footer.php");
?>