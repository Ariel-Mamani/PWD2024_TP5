<?php
class CompraEstadoTipo extends BaseDatos{
    private $idcompraestadotipo;
    private $cetdescripcion;
    private $cetdetalle;
    private $mensajeoperacion;

    public function __construct(){
        $this->idcompraestadotipo = '';
        $this->cetdescripcion = '';
        $this->cetdetalle = '';
        $this->mensajeoperacion = '';
    }

    public function setear($idcompraestadotipo, $cetdescripcion, $cetdetalle){
        $this->setIdCompraEstadoTipo($idcompraestadotipo);
        $this->setCetDescripcion($cetdescripcion);
        $this->setCetDetalle($cetdetalle);
    }

    // Getters y Setters Compra Estado Tipo
    public function getIdCompraEstadoTipo(){
        return $this->idcompraestadotipo;
    }

    public function setIdCompraEstadoTipo($valor){
        $this->idcompraestadotipo = $valor;
    }

    //------------ Getters y Setters CetDescripcion
    public function getCetDescripcion(){
        return $this->cetdescripcion;
    }

    public function setCetDescripcion($valor){
        $this->cetdescripcion = $valor;
    }

    //------------ Getters y Setters CetDetalle
    public function getCetDetalle(){
        return $this->cetdetalle;
    }

    public function setCetDetalle($valor){
        $this->cetdetalle = $valor;
    }

    //------------ Getters y Setters Mensaje Operacion
    public function getMensajeOperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeOperacion($valor){
        $this->mensajeoperacion = $valor;
    }

    // Métodos para la interacción con la base de datos
    public function cargar(){
        $exito = false;
        $sql = "SELECT * FROM compraestadotipo WHERE idcompraestadotipo = " . $this->getIdCompraEstadoTipo();
        if($this->Iniciar()){
            $res = $this->Ejecutar($sql);
            if($res > -1) {
                $row = $this->Registro();
                $this->setear($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);
                $exito = true;
            }else{
                $this->setMensajeOperacion("CompraEstadoTipo->cargar: " . $this->getError());
            }
        }else {
            $this->setMensajeOperacion("CompraEstadoTipo->cargar: " . $this->getError());
        }
        return $exito;
    }

    /**
     * 
     */
    public function insertar(){
        $resp = false;
        $sql = "INSERT INTO compraestadotipo (idcompraestadotipo, cetdescripcion, cetdetalle) VALUES 
                (" . $this->getIdCompraEstadoTipo() . ", '" . $this->getCetDescripcion() . "', '" . $this->getCetDetalle() . "')";
        if($this->Iniciar()){
            if ($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeOperacion("CompraEstadoTipo->insertar: " . $this->getError());
            }
        }else{
            $this->setMensajeOperacion("CompraEstadoTipo->insertar: " . $this->getError());
        }
        return $resp;
    }

    /**
     * 
     */
    public function modificar(){
        $resp = false;
        $sql = "UPDATE compraestadotipo SET cetdescripcion = '" . $this->getCetDescripcion() . "', 
                cetdetalle = '" . $this->getCetDetalle() . "' WHERE idcompraestadotipo = " . $this->getIdCompraEstadoTipo();
        if($this->Iniciar()){
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeOperacion("CompraEstadoTipo->modificar: " . $this->getError());
            }
        }else{
            $this->setMensajeOperacion("CompraEstadoTipo->modificar: " . $this->getError());
        }
        return $resp;
    }

    /**
     * 
     */
    public function eliminar(){
        $resp = false;
        $sql = "DELETE FROM compraestadotipo WHERE idcompraestadotipo = " . $this->getIdCompraEstadoTipo();
        if($this->Iniciar()){
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeOperacion("CompraEstadoTipo->eliminar: " . $this->getError());
            }
        }else{
            $this->setMensajeOperacion("CompraEstadoTipo->eliminar: " . $this->getError());
        }
        return $resp;
    }

    /**
     * 
     */
    public function listar($condicion = ""){
        $arreglo = array();
        $sql = "SELECT * FROM compraestadotipo";
        if($condicion != ""){
            $sql .= " WHERE " . $condicion;
        }
        $res = $this->Ejecutar($sql);
        if($res > -1){
            while($row = $this->Registro()){
                $obj = new CompraEstadoTipo();
                $obj->setear($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);
                array_push($arreglo, $obj);
            }
        }else{
            $this->setMensajeOperacion("CompraEstadoTipo->listar: " . $this->getError());
        }
        return $arreglo;
    }
}