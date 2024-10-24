<?php
class Rol {
    private $idRol;
    private $descripcion;
    private $mensajeoperacion;

    public function __construct() {
        $this->idRol = "";
        $this->descripcion = "";
        $this->mensajeoperacion = "";
    }

    public function setear($idRol, $descripcion) {
        $this->setIdRol($idRol);
        $this->setDescripcion($descripcion);
    }

    // Métodos Get y Set para idRol
    public function getIdRol() {
        return $this->idRol;
    }

    public function setIdRol($valor) {
        $this->idRol = $valor;
    }

    // Métodos Get y Set para descripcion
    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($valor) {
        $this->descripcion = $valor;
    }

    // Métodos Get y Set para mensajeoperacion
    public function getMensajeoperacion() {
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($valor) {
        $this->mensajeoperacion = $valor;
    }

    //Método para buscar un rol por id
    public function buscar($idRol){
        $base = new BaseDatos();
        $sql = "SELECT * FROM rol WHERE idrol = " . $idRol;
        $exito = false;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                if($row = $base->Registro()){
                    $this->setIdRol($row['idrol']);
                    $this->setDescripcion($row['rodescripcion']);
                    $exito = true;
                }
            }else{
                $this->setMensajeoperacion("Rol->buscar: " . $base->getError());
            }
        }else{
            $this->setMensajeoperacion("Rol->buscar: " . $base->getError());
        }
        return $exito;
    }

    //Método para insertar un nuevo rol
    public function insertar(){
        $base = new BaseDatos();
        $resp = false;
        $sql = "INSERT INTO rol(rodescripcion) VALUES('" . $this->getDescripcion() . "')";
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeoperacion("Rol->insertar: " . $base->getError());
            }
        }else{
            $this->setMensajeoperacion("Rol->insertar: " . $base->getError());
        }
        return $resp;
    }

    // Método para modificar un rol existente
    public function modificar(){
        $base = new BaseDatos();
        $resp = false;
        $sql = "UPDATE rol SET rodescripcion = '" . $this->getDescripcion() . "' WHERE idrol = " . $this->getIdRol();
        if($base->Iniciar()) {
            if($base->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeoperacion("Rol->modificar: " . $base->getError());
            }
        }else{
            $this->setMensajeoperacion("Rol->modificar: " . $base->getError());
        }
        return $resp;
    }

    // Método para eliminar un rol
    public function eliminar(){
        $base = new BaseDatos();
        $resp = false;
        $sql = "DELETE FROM rol WHERE idrol = " . $this->getIdRol();
        if($base->Iniciar()) {
            if($base->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeoperacion("Rol->eliminar: " . $base->getError());
            }
        }else{
            $this->setMensajeoperacion("Rol->eliminar: " . $base->getError());
        }
        return $resp;
    }

    // Método para listar roles
    public static function listar($parametro = ""){
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM rol ";
        if($parametro != "") {
            $sql .= " WHERE " . $parametro;
        }
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                while ($row = $base->Registro()) {
                    $obj = new Rol();
                    $obj->setear($row['idrol'], $row['rodescripcion']);
                    array_push($arreglo, $obj);
                }
            }else{
                self::setMensajeoperacion("Rol->listar: " . $base->getError());
            }
        }
        return $arreglo;
    }
}
?>
