<?php
class Rol extends BaseDatos{
    private $idRol;
    private $descripcion;
    private $mensajeoperacion;

    public function __construct() {
        parent::__construct();
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

    
    /**
     * Summary of cargar
     * @return bool
     */
    public function cargar(){
        $resp = false;
        $sql="SELECT * FROM rol WHERE idrol = ".$this->getIdRol();
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $resp = true;
                    $row = $this->Registro();
                    $this->setear($row['idrol'], $row['roldescripcion']);
                }
            }
        } else {
            $this->setMensajeoperacion("rol->cargar: ".$this->getError());
        }
        return $resp;
    }
    
 /**
     * Summary of insertar
     * @return bool
     */
    public function insertar(){
        $resp = false;
        $sql="INSERT INTO rol (roldescripcion)  VALUES ('".$this->getDescripcion()."');";
        if ($this->Iniciar()) {
            if ($elid = $this->Ejecutar($sql)) {
                $this->setIdRol($elid);
                $resp = true;
            } else {
                $this->setMensajeoperacion("rol->insertar: ".$this->getError());
            }
        } else {
            $this->setMensajeoperacion("rol->insertar: ".$this->getError());
        }
        return $resp;
    }
    /**
     * Summary of modificar
     * @return bool
     */
    public function modificar(){
        $resp = false;
        $sql="UPDATE rol SET roldescripcion = '".$this->getDescripcion()."' ".
            " WHERE idrol = ".$this->getIdRol();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("rol->modificar: ".$this->getError());
            }
        } else {
            $this->setMensajeoperacion("rol->modificar: ".$this->getError());
        }
        return $resp;
    }
    /**
     * Summary of eliminar
     * @return bool
     */
    public function eliminar(){
        $resp = false;
        $sql="DELETE FROM rol WHERE idrol = ".$this->getIdRol();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql) > 0) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("rol->eliminar: ".$this->getError());
            }
        } else {
            $this->setMensajeoperacion("rol->eliminar: ".$this->getError());
        }
        return $resp;
    }

      /**
     * Summary of listar
     * @param mixed $parametro
     * @return array
     */
    public function listar($parametro=""){
        $arreglo = array();
        $sql="SELECT * FROM rol ";
        if ($parametro!="") {
            $sql.= ' WHERE '.$parametro;
        }
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    while ($row = $this->Registro()){
                            $objrol= new rol();
                            $objrol->setear($row['idrol'], $row['roldescripcion']);
                            array_push($arreglo, $objrol);
                    }
                } 
            }else{
                $this->setMensajeoperacion("rol->listar: ".$this->getError());
            }
        }
        return $arreglo;
    }
    
}

?>
