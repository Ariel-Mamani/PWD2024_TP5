<?php
    $titulo = " Usuario ";
    include_once("../estructura/header.php");
    $datos = data_submitted();
    $AbmUsuario = new AbmUsuario();
    $obj =NULL;
    if (isset($datos['idusuario']) && $datos['idusuario'] <> -1){
        $listaUsuario = $AbmUsuario->buscar($datos);
        if (count($listaUsuario)==1){
            $obj= $listaUsuario[0];
        }
    }

?>	
<form method="post" action="accion.php">
    <input id="idusuario" name ="idusuario" type="hidden" value="<?php echo ($obj !=null) ? $obj->getIdUsuario() : "-1"?>" readonly required >
    <input id="accion" name ="accion" value="<?php echo ($datos['accion'] !=null) ? $datos['accion'] : "nose"?>" type="hidden">
    <div class="row mb-12">
        <div class="col-sm-12 ">
            <div class="form-group has-feedback">
                <label for="nombre" class="control-label">Nombre:</label>
                    <label for="usnombre">Nombre:</label>
                    <input id="usnombre" name="usnombre" type="text" class="form-control" value="<?php echo ($obj !=null) ? $obj->getNombre() : ""?>" required >

                    <label for="usmail">Email:</label>
                    <input id="usmail" name="usmail" type="text" class="form-control" value="<?php echo ($obj !=null) ? $obj->getEmail() : ""?>" required >
            </div>
        </div>
    </div>
	
	<input type="submit" class="btn btn-primary btn-block" value="<?php echo ($datos['accion'] !=null) ? $datos['accion'] : "nose"?>">
</form>
<a href="index.php">Volver</a>

<?php
include_once("../estructura/footer.php");
?>