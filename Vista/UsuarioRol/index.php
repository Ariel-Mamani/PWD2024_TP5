<?php
    $titulo = " Gestion de UsuariosRol";
    include_once("../Estructura/headerSeguro.php");
    $datos = data_submitted();
    
    if (!isset($datos['accion'])){ $datos['accion']="listar"; }
    include_once ("accion.php");
?>
<h2 class=" bg-primary p-3">Lista de UsuariosRol </h2>
<div class="row float-left">
    <div class="col-md-12 float-left">
        <?php 
        if(isset($datos) && isset($datos['msg']) && $datos['msg']!=null) {
        echo "<h3 class ='bg-light text-danger text-center'>{$datos['msg']}</h3>";
        }
        ?>
    </div>
</div>

<div class="table-responsive ">
    <!-- input de filtro -->
    <div class="mb-2">

        <!-- Boton Nuevo -->
        <div class="row float-left m-5">
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
            <th scope="col" style="width:35%;">Rol</th>
            <th scope="col" style="width:20%;">Acciones</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if( count($listaUsuarioRol)>0){
            foreach ($listaUsuarioRol as $obj) {
                echo '<tr><td class="bg-light ">'.$obj->getUsuario()->getidusuario().'</td>';
                echo '<td class="bg-light ">'.$obj->getUsuario()->getusnombre().'</td>';
                echo '<td class="bg-light ">'.$obj->getRol()->getroldescripcion().'</td>';
                echo '<td class="bg-light "><a class="btn btn-info" role="button" href="editar.php?accion=editar&idusuario='.$obj->getUsuario()->getidusuario().'"><i class="bi bi-pencil"></i></a>  ';
                echo '<a class="btn btn-primary" role="button" href="editar.php?accion=borrar&idusuario='.$obj->getUsuario()->getidusuario().'"><i class="bi bi-trash3"></i></a> </td></tr> ';
            } 
        }
        ?>
        </tbody>
    </table>
</div>

<?php include_once("../estructura/footer.php"); ?>
