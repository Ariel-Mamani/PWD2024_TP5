<?php
    $titulo = " Gestion de Usuarios";
    include_once("../Estructura/headerSeguro.php");
    $datos = data_submitted();
    
    if (!isset($datos['accion'])){ $datos['accion']="listar"; }
    include_once ("accion.php");
?>
<h2 class=" bg-primary p-3">Lista de Usuarios </h2>
<div class="row float-left">
    <div class="col-md-12 float-left">
        <?php 
        if(isset($datos) && isset($datos['msg']) && $datos['msg']!=null) {
        echo "<h3 class ='bg-light text-danger text-center'>{$datos['msg']}</h3>";
        }
        ?>
    </div>
</div>

<div class="table-responsive">
    <!-- input de filtro -->
    <div class="mb-2">
        <form action="index.php" method="post" class="container mt-5 p-4 border rounded shadow bg-light" novalidate>
            <label for="filtrar" class="form-label fw-bold ">Filtro</label>
            <input name="usnombre" id="usnombre" type="text" pattern="[A-z0-9]" >
            <input type="submit" name="accion" id="accion" class="btn btn-info btn-sm" role="button" value="Filtrar">
            <input type="submit" name="accion" id="accion" class="btn btn-info btn-sm" role="button" value="Limpiar">
        </form>

        <!-- Boton Nuevo -->
        <div class="row float-right m-5">
            <div class="col-md-12 float-right">
                <a class="btn btn-success align-items-center" role="button" href="editar.php?accion=nuevo&id=-1">
                    <span>Nuevo</span><i class="bi bi-plus fs-4"></i>
                </a>
            </div>
        </div>
    </div>
    </div> 
    <table class="table table-sm  bg-primary " id="myTable">
        <thead>
        <tr class="header">
            <th scope="col" style="width:10%;">#</th>
            <th scope="col" style="width:35%;">Nombre</th>
            <th scope="col" style="width:35%;">Mail</th>
            <th scope="col" style="width:20%;">Acciones</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if( count($lista)>0){
            foreach ($lista as $obj) {
                echo '<tr><td class="bg-light ">'.$obj->getidusuario().'</td>';
                echo '<td class="bg-light ">'.$obj->getusnombre().'</td>';
                echo '<td class="bg-light ">'.$obj->getusmail().'</td>';
                echo '<td class="bg-light "><a class="btn btn-info" role="button" href="editar.php?accion=editar&idusuario='.$obj->getidusuario().'"><i class="bi bi-pencil"></i></a>  ';
                echo '<a class="btn btn-primary" role="button" href="editar.php?accion=borrar&idusuario='.$obj->getidusuario().'"><i class="bi bi-trash3"></i></a> </td></tr> ';
                //echo '<a class="btn btn-info" role="button" href="editarPass.php?accion=editarPass&idusuario='.$obj->getidusuario().'"><i class="bi bi-pencil"></i></a></td></tr>  ';
            } 
        }
        ?>
        </tbody>
    </table>
</div>

<?php include_once("../estructura/footer.php"); ?>
