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
    <input id="idusuario" name ="idusuario" type="hidden" value="<?php echo ($obj !=null) ? $obj->getidusuario() : "-1"?>" readonly required >
    <input id="accion" name ="accion" value="<?php echo ($datos['accion'] !=null) ? $datos['accion'] : "nose"?>" type="hidden">
    <div class="row mb-12">
        <div class="col-sm-12 ">
            <div class="form-group has-feedback">
                    <label for="nombre" class="control-label text-white py-2 w-100 bg-primary p-2">Nombre:</label>
                    <!-- <label for="usnombre">Nombre:</label> -->
                    <input id="usnombre" name="usnombre" type="text" class="form-control mb-4" value="<?php echo ($obj !=null) ? $obj->getusnombre() : ""?>" required >

                    <label for="usmail"  class="control-label text-white py-2 w-100 bg-primary p-2">Email:</label>
                    <input id="usmail" name="usmail" type="text" class="form-control" value="<?php echo ($obj !=null) ? $obj->getusmail() : ""?>" required >
            </div>
        </div>
    </div>
	
	<input type="submit" class="btn btn-primary btn-block  m-2" value="<?php echo ($datos['accion'] !=null) ? $datos['accion'] : "nose"?>">
</form>
<a href="index.php" class="btn bg-warning m-2">Volver</a>

<?php
include_once("../estructura/footer.php");
?>