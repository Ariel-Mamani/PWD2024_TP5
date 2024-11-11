<?php

class CompraEstado extends BaseDatos{
    private $idcompraestado;
    private $compra; // Objeto de la clase Compra
    private $compraestadotipo; // Objeto de la clase CompraEstadoTipo
    private $cefechainit;
    private $cefechafin;
    private $mensajeoperacion;

    public function __construct() {
        $this->idcompraestado = '';
        $this->compra = new Compra();
        $this->compraestadotipo = new CompraEstadoTipo();
        $this->cefechainit = '';
        $this->cefechafin = '';
        $this->mensajeoperacion = '';
    }

    public function setear($idcompraestado, $compra, $compraestadotipo, $cefechainit, $cefechafin) {
        $this->setIdCompraEstado($idcompraestado);
        $this->setCompra($compra);
        $this->setCompraEstadoTipo($compraestadotipo);
        $this->setCeFechaInit($cefechainit);
        $this->setCeFechaFin($cefechafin);
    }

    // Getters y Setters Id Compra Estado
    public function getIdCompraEstado() {
        return $this->idcompraestado;
    }

    public function setIdCompraEstado($valor) {
        $this->idcompraestado = $valor;
    }

    //------------ Getters y Setters Compra
    public function getCompra() {
        return $this->compra;
    }

    public function setCompra($objCompra) {
        $this->compra = $objCompra;
    }

    //------------ Getters y Setters Estado Tipo
    public function getCompraEstadoTipo() {
        return $this->compraestadotipo;
    }

    public function setCompraEstadoTipo($objCompraEstadoTipo) {
        $this->compraestadotipo = $objCompraEstadoTipo;
    }

    //------------ Getters y Setters CeFechaInit
    public function getCeFechaInit() {
        return $this->cefechainit;
    }

    public function setCeFechaInit($valor) {
        $this->cefechainit = $valor;
    }

    //------------ Getters y Setters CeFechaFin
    public function getCeFechaFin() {
        return $this->cefechafin;
    }

    public function setCeFechaFin($valor) {
        $this->cefechafin = $valor;
    }

    //------------ Getters y Setters Mensaje Operacion
    public function getMensajeOperacion() {
        return $this->mensajeoperacion;
    }

    public function setMensajeOperacion($valor) {
        $this->mensajeoperacion = $valor;
    }

    // Métodos para la interacción con la base de datos
    public function cargar(){
        $exito = false;
        $sql = "SELECT * FROM compraestado WHERE idcompraestado = " . $this->getIdCompraEstado()." AND 
        idcompra = ".$this->getCompra()->getIdCompra()." AND 
        idcompraestadotipo = ".$this->getCompraEstadoTipo()->getIdCompraEstadoTipo() ;
        if($this->Iniciar()){
            $res = $this->Ejecutar($sql);
            if($res > -1){
                $row = $this->Registro();

                // Cargar objetos relacionados
                $compra = new Compra();
                $compra->setIdCompra($row['idcompra']);
                $compra->cargar();

                $compraestadotipo = new CompraEstadoTipo();
                $compraestadotipo->setIdCompraEstadoTipo($row['idcompraestadotipo']);
                $compraestadotipo->cargar();

                $this->setear(
                    $row['idcompraestado'], 
                    $compra, 
                    $compraestadotipo, 
                    $row['cefechainit'], 
                    $row['cefechafin']
                );
                $exito = true;
            }else{
                $this->setMensajeOperacion("CompraEstado->cargar: " . $this->getError());
            }
        }else{
            $this->setMensajeOperacion("CompraEstado->cargar: " . $this->getError());
        }
        return $exito;
    }

    public function insertar(){
        $resp = false;
        $sql = "INSERT INTO compraestado (idcompraestado, idcompra, idcompraestadotipo, cefechainit, cefechafin) VALUES 
                (" . $this->getIdCompraEstado() . ", " . $this->getCompra()->getIdCompra() . ", " . 
                $this->getCompraEstadoTipo()->getIdCompraEstadoTipo() . ", '" . $this->getCeFechaInit() . "', '" . 
                $this->getCeFechaFin() . "')";
        if($this->Iniciar()){
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeOperacion("CompraEstado->insertar: " . $this->getError());
            }
        }else{
            $this->setMensajeOperacion("CompraEstado->insertar: " . $this->getError());
        }
        return $resp;
    }


    public function modificar(){
        $resp = false;
        $sql = "UPDATE compraestado SET 
                idcompra = " . $this->getCompra()->getIdCompra() . ", 
                idcompraestadotipo = " . $this->getCompraEstadoTipo()->getIdCompraEstadoTipo() . ", 
                cefechainit = '" . $this->getCeFechaInit() . "', 
                cefechafin = '" . $this->getCeFechaFin() . "' 
                WHERE idcompraestado = " . $this->getIdCompraEstado()." AND 
                    idcompra = ".$this->getCompra()->getIdCompra()." AND 
                    idcompraestadotipo = ".$this->getCompraEstadoTipo()->getIdCompraEstadoTipo();
        if($this->Iniciar()){
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeOperacion("CompraEstado->modificar: " . $this->getError());
            }
        }else{
            $this->setMensajeOperacion("CompraEstado->modificar: " . $this->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $sql = "DELETE FROM compraestado WHERE idcompraestado = " . $this->getIdCompraEstado()." AND 
                    idcompra = ".$this->getCompra()->getIdCompra()." AND 
                    idcompraestadotipo = ".$this->getCompraEstadoTipo()->getIdCompraEstadoTipo();
        if($this->Iniciar()){
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeOperacion("CompraEstado->eliminar: " . $this->getError());
            }
        }else{
            $this->setMensajeOperacion("CompraEstado->eliminar: " . $this->getError());
        }
        return $resp;
    }


    public function listar($condicion = ""){
        $arreglo = [];
        $sql = "SELECT * FROM compraestado";
        if($condicion != ""){
            $sql .= " WHERE " . $condicion;
        }
        $res = $this->Ejecutar($sql);
        if($res > -1){
            while($row = $this->Registro()){
                $compra = new Compra();
                $compra->setIdCompra($row['idcompra']);
                $compra->cargar();

                $compraestadotipo = new CompraEstadoTipo();
                $compraestadotipo->setIdCompraEstadoTipo($row['idcompraestadotipo']);
                $compraestadotipo->cargar();

                $obj = new CompraEstado();
                $obj->setear(
                    $row['idcompraestado'], 
                    $compra, 
                    $compraestadotipo, 
                    $row['cefechainit'], 
                    $row['cefechafin']
                );
                $arreglo[] = $obj;
            }
        }else{
            $this->setMensajeOperacion("CompraEstado->listar: " . $this->getError());
        }
        return $arreglo;
    }
}