<?php
    $Titulo = " Rol ";
    include_once("../estructura/headerSeguro.php");
    $datos = data_submitted();
    if (empty($datos)){
        header("Location: ".$VISTA."Inicio/principal.php");
        die();
    }else{
        $AbmRol = new AbmRol();
        $obj =NULL;
        if (isset($datos['idrol']) && $datos['idrol'] <> -1){
            $listaRol = $AbmRol->buscar($datos);
            if (count($listaRol)==1){
                $obj= $listaRol[0];
            }
        }
    }
?>	
<form method="post" action="accion.php">
    <input id="idrol" name ="idrol" type="hidden" value="<?php echo ($obj !=null) ? $obj->getidrol() : "-1"?>" readonly required >
    <input id="accion" name ="accion" value="<?php echo ($datos['accion'] !=null) ? $datos['accion'] : "nose"?>" type="hidden">
    <div class="row mb-12">
        <div class="col-sm-12 ">
            <div class="form-group has-feedback">
                <label for="nombre" class="control-label">Nombre:</label>
                <div class="input-group">
                    <input id="roldescripcion" name="roldescripcion" type="text" class="form-control" value="<?php echo ($obj !=null) ? $obj->getroldescripcion() : ""?>" required >

                </div>
            </div>
        </div>
    </div>
	
	<input type="submit" class="btn btn-primary btn-block" value="<?php echo ($datos['accion'] !=null) ? $datos['accion'] : "nose"?>">
</form>
<a href="index.php">Volver</a>

<?php
include_once("../estructura/footer.php");
?>