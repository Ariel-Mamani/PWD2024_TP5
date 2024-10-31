<?php
    $Titulo = " Gestion de Rol";
    include_once("../Estructura/headerSeguro.php");
    $datos = data_submitted();
    
   if (!isset($datos['accion'])){ $datos['accion']="listar"; }
   include_once ("accion.php");
?>
<h3>Roles </h3>
<div class="row float-left">
    <div class="col-md-12 float-left">
      <?php 
      if(isset($datos) && isset($datos['msg']) && $datos['msg']!=null) {
        echo $datos['msg'];
      }
     ?>
    </div>
</div>


<div class="table-responsive">
      <!-- input de filtro -->
    <div class="mb-2">
        <form action="index.php" method="post" class="container mt-5 p-4 border rounded shadow" novalidate>
            <label for="filtrar" class="form-label fw-bold">Filtro</label>
            <input name="roldescripcion" id="roldescripcion" type="text" pattern="[A-z0-9]" >
            <input type="submit" name="accion" id="accion" class="btn btn-info btn-sm" role="button" value="Filtrar">
            <input type="submit" name="accion" id="accion" class="btn btn-info btn-sm" role="button" value="Limpiar">
        </form>

        <!-- Boton Nuevo -->
        <div class="row float-right">
        <div class="col-md-12 float-right">
            <a class="btn btn-success" role="button" href="editar.php?accion=nuevo&id=-1">Nuevo</a></div>
        </div>
    </div>
    </div> 
    <table class="table table-striped table-sm" id="myTable">
        <thead>
        <tr class="header">
            <th scope="col" style="width:10%;">#</th>
            <th scope="col" style="width:70%;">Rol</th>
            <th scope="col" style="width:20%;">Acciones</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if( count($lista)>0){
            foreach ($lista as $arreglo) {
                echo '<tr><td>'.$arreglo['idrol'].'</td>';
                echo '<td>'.$arreglo['roldescripcion'].'</td>';
                echo '<td><a class="btn btn-info" role="button" href="editar.php?accion=editar&idrol='.$arreglo['idrol'].'"><i class="bi bi-pencil"></i></a>  ';
                echo '<a class="btn btn-primary" role="button" href="editar.php?accion=borrar&idrol='.$arreglo['idrol'].'"><i class="bi bi-trash3"></i></a></td></tr>';
            }
        }
        ?>
        </tbody>
    </table>
</div>



<?php include_once("../estructura/footer.php"); ?>
