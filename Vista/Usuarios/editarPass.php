<?php
    $titulo = " Usuario Cambiar Contrase&ntilde;a ";
    include_once("../estructura/headerSeguro.php");
    $datos = data_submitted();
    $AbmUsuario = new AbmUsuario();
    
    $obj =$objSession->getUsuario();

?>	
<form method="post" action="accion.php" class="bg-success">
    <input id="idusuario" name ="idusuario" type="hidden" value="<?php echo ($obj !=null) ? $obj->getidusuario() : "-1"?>" readonly required>
    <input id="accion" name ="accion" value="<?php echo ($datos['accion'] !=null) ? $datos['accion'] : "nose"?>" type="hidden">
    <div class="row mb-12">
        <div class="col-sm-12 ">
            <div class="form-group has-feedback">
                            <!-- Contraseña -->
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon2"><i class="bi bi-lock-fill" style="font-size: 22px;"></i></span>
            <input id="clave" name="clave" type="password" class="form-control" placeholder="Contraseña" required onblur="return convertirClaveMD5()">
            <input type="hidden" name="uspass" id="uspass">
            <!-- Mensajes aprobado y error -->
            <div class="valid-feedback">Ok!</div>
            <div class="invalid-feedback">Valor de contraseña incorrecto</div>
        </div>
            </div>
        </div>
    </div>
	
	<input type="submit" class="btn btn-primary btn-block  m-2" value="<?php echo ($datos['accion'] !=null) ? $datos['accion'] : "nose"?>">
</form>
<a href="index.php" class="btn bg-warning m-2">Volver</a>

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