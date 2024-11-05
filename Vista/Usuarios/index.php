<?php
    $titulo = " Gestion de Usuarios";
    include_once("../Estructura/headerSeguro.php");
    $datos = data_submitted();
    
    if (!isset($datos['accion'])){ $datos['accion']="listar"; }
    include_once ("accion.php");
?>

<section>
    <h2 class="p-3">Lista de Usuarios </h2>
    <div class="row float-left">
        <div class="col-md-12 float-left">
            <?php 
            if(isset($datos) && isset($datos['msg']) && $datos['msg']!=null) {
            echo "<h3 class ='text-danger text-center'>{$datos['msg']}</h3><br>";
            }
            ?>
        </div>
    </div>

    <div class="table-responsive">
        <!-- input de filtro -->
        <div class="mb-2">

            <!-- filtro box -->
            <div class="filtro-box">

                <!-- Curva -->
                <div class="curva-filtro" id="curva-filtro"></div>

                <!-- Formulario -->
                <form action="index.php" method="post" class="full-height p-5" novalidate>

                    <!-- Filtro  -->
                    <div class="input-group mb-4 input-box">
                        <!-- Icono -->
                        <span class="icon" id="basic-addon1">
                            <i class="bi bi-pencil"></i>
                        </span>

                        <input type="text" name="usnombre" id="usnombre" pattern="[A-z0-9]">
                        <label>Filtro</label>
                    </div>

                    <!-- Botones -->
                    <div>
                        <input type="submit" name="accion" id="accion" class="btn-filtrar btn-sm" role="button" value="Filtrar">
                        <input type="submit" name="accion" id="accion" class="btn-limpiar btn-sm" role="button" value="Limpiar">
                    </div>    
                </form>
            </div>

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

        <table class="table table-sm  bg-primary myTable" id="myTable">
            <thead>
                <tr class="header" style="color:white">
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
                        echo '<tr><td>'.$obj->getidusuario().'</td>';
                        echo '<td>'.$obj->getusnombre().'</td>';
                        echo '<td>'.$obj->getusmail().'</td>';
                        echo '<td><a class="btn btn-info" role="button" href="editar.php?accion=editar&idusuario='.$obj->getidusuario().'"><i class="bi bi-pencil"></i></a>  ';
                        echo '<a class="btn btn-primary" role="button" href="editar.php?accion=borrar&idusuario='.$obj->getidusuario().'"><i class="bi bi-trash3"></i></a> </td></tr> ';
                    } 
                }
                ?>
            </tbody>
        </table>
    </div>
    <br><br><br>
</section>

<!-- Footer -->
<?php include_once("../estructura/footer.php"); ?>
