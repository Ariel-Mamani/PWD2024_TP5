<?php
    $Titulo = " Gestion de Personas";
    include_once("../Estructura/header.php");
    $datos = data_submitted();
    
   if (!isset($datos['accion'])){ $datos['accion']="listar"; }
   include_once ("accion.php");
?>
<h3>Lista de Personas </h3>
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
            <input name="per_nombre" id="per_nombre" type="text" pattern="[A-z0-9]" >
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
            <th scope="col" style="width:35%;">Nombre</th>
            <th scope="col" style="width:35%;">Telefono</th>
            <th scope="col" style="width:20%;">Acciones</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if( count($lista)>0){
            foreach ($lista as $arreglo) {
                echo '<tr><td>'.$arreglo['per_id'].'</td>';
                echo '<td>'.$arreglo['per_nombre'].'</td>';
                echo '<td>'.$arreglo['per_telefono'].'</td>';
                echo '<td><a class="btn btn-info" role="button" href="editar.php?accion=editar&per_id='.$arreglo['per_id'].'"><i class="fa fa-edit"></i></a>  ';
                echo '<a class="btn btn-primary" role="button" href="editar.php?accion=borrar&per_id='.$arreglo['per_id'].'"><i class="fa fa-trash"></i></a>  ';
                echo '<td><a class="btn btn-info" role="button" href="../Usuario/editar.php?accion=nuevo&tipo_id=-1&per_id='.$arreglo['per_id'].'"><i class="fa fa-edit"></i></a></td></tr>';
            }  // &tipo_id=-1 
        }
        ?>
        </tbody>
    </table>
</div>



<?php include_once("../estructura/footer.php"); ?>
