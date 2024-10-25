<?php
    $Titulo = " Persona ";
    include_once("../estructura/header.php");
    $datos = data_submitted();
    $AbmPersona = new AbmPersona();
    $obj =NULL;
    if (isset($datos['per_id']) && $datos['per_id'] <> -1){
        $listaPersona = $AbmPersona->buscar($datos);
        if (count($listaPersona)==1){
            $obj= $listaPersona[0];
        }
    }

?>	
<form method="post" action="accion.php">
    <input id="per_id" name ="per_id" type="hidden" value="<?php echo ($obj !=null) ? $obj->getId() : "-1"?>" readonly required >
    <input id="accion" name ="accion" value="<?php echo ($datos['accion'] !=null) ? $datos['accion'] : "nose"?>" type="hidden">
    <div class="row mb-12">
        <div class="col-sm-12 ">
            <div class="form-group has-feedback">
                <label for="nombre" class="control-label">Nombre:</label>
                    <label for="per_nombre">Nombre:</label>
                    <input id="per_nombre" name="per_nombre" type="text" class="form-control" value="<?php echo ($obj !=null) ? $obj->getNombre() : ""?>" required >
                    <label for="per_telefono">Tel&eacute;fono</label>
                    <input id="per_telefono" name="per_telefono" type="text" class="form-control" value="<?php echo ($obj !=null) ? $obj->getTelefono() : ""?>" required >
            </div>
        </div>
    </div>
	
	<input type="submit" class="btn btn-primary btn-block" value="<?php echo ($datos['accion'] !=null) ? $datos['accion'] : "nose"?>">
</form>
<a href="index.php">Volver</a>

<?php
include_once("../estructura/footer.php");
?>