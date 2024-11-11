<?php
class Compra extends BaseDatos{
    private $idcompra;
    private $cofecha;
    private $objUsuario;
    private $mensajeoperacion;

    public function __construct()
    {   
        $this->idcompra = '';
        $this->cofecha = '';
        $this->objUsuario = new Usuario;
        $this->mensajeoperacion = '';
    }

    public function setear($idcompra, $cofecha, $objUsuario) {
        $this->setIdCompra($idcompra);
        $this->setCoFecha($cofecha);
        $this->setUsuario($objUsuario);
    }

    //------------ Getters y Setters Id Compra
    public function getIdCompra() {
        return $this->idcompra;
    }
    public function setIdCompra($valor) {
        $this->idcompra = $valor;
    }

    //------------ Getters y Setters CoFecha
    public function getCoFecha() {
        return $this->cofecha;
    }
    public function setCoFecha($valor) {
        $this->cofecha = $valor;
    }

    //------------ Getters y Setters Usuario
    public function getUsuario() {
        return $this->objUsuario;
    }
    public function setUsuario($valor) {
        $this->objUsuario = $valor;
    }

    //------------ Getters y Setters Mensaje Operacion
    public function getMensajeOperacion() {
        return $this->mensajeoperacion;
    }
    public function setMensajeOperacion($valor) {
        $this->mensajeoperacion = $valor;
    }

    /**
     * Busca en la base de datos los datos de una Compra específico por idproducto y 
     * los carga en las propiedades del objeto. 
     * Devuelve true si fue exitoso o false en caso de error, almacenando un mensaje 
     * de error en mensajeoperacion.
     * @return bool $exito
     */
    public function cargar(){
        $exito = false;
        $sql = "SELECT * FROM compra WHERE idcompra = " . $this->getIdCompra()." AND 
                idusuario = ".$this->getUsuario()->getidusuario(); ;
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if($res > -1){
                $row = $this->Registro();
                $objUsuario = new Usuario();
                $objUsuario->setidusuario($row['idusuario']);
                $this->setear($row['idcompra'], $row['cofecha'], $objUsuario);
                $exito = true;
            }else{
                $this->setMensajeOperacion("Compra->cargar: " . $this->getError());
            }
        }else{
            $this->setMensajeOperacion("Compra->cargar: " . $this->getError());
        }
        return $exito;
    }

    /**
     *  Inserta un nuevo registro en la tabla. No se incluye idcompra ya que este 
     * es auto-incremental
     */
    public function insertar(){
        $resp = false;
        $sql = "INSERT INTO compra (cofecha, idusuario) VALUES (null,
                '" . $this->getCoFecha() . "', 
                " . $this->getUsuario()->getidusuario() . ");";

        if($this->Iniciar()){
            if($elid = $this->Ejecutar($sql)){
                $this->setIdCompra($elid);
                $resp = true;
            }else{
                $this->setMensajeOperacion("Compra->insertar: " . $this->getError());
            }
        }else{
            $this->setMensajeOperacion("Compra->insertar: " . $this->getError());
        }
        return $resp;
    }

    /**
     *  Actualiza un registro existente de acuerdo con el idcompra
     */
    public function modificar(){
        $resp = false;
        $sql = "UPDATE compra SET 
                cofecha = '" . $this->getCoFecha() . "', 
                idusuario = " . $this->getUsuario()->getidusuario() . "
                WHERE idcompra = " . $this->getIdCompra()." and idusuario = ".$this->getUsuario()->getidusuario();

        if($this->Iniciar()){
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeOperacion("Compra->modificar: " . $this->getError());
            }
        }else{
            $this->setMensajeOperacion("Compra->modificar: " . $this->getError());
        }
        return $resp;
    }

    /**
     * Borra un registro de la tabla con el idcompra correspondiente
     */
    public function eliminar(){
        $resp = false;
        $sql = "DELETE FROM compra WHERE idcompra = " . $this->getIdCompra(). " AND idusuario = " 
        . $this->getUsuario()->getidusuario();

        if($this->Iniciar()){
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeOperacion("Compra->eliminar: " . $this->getError());
            }
        }else{
            $this->setMensajeOperacion("Compra->eliminar: " . $this->getError());
        }
        return $resp;
    }

    /**
     * Recupera múltiples registros de la tabla. Permite añadir una condición para filtrar
     */
    public function listar($condicion = ""){
        $arreglo = array();
        $sql = "SELECT * FROM compra";
        
        if($condicion != ""){
            $sql .= " WHERE " . $condicion;
        }
        if($this->Iniciar()){
            $res = $this->Ejecutar($sql);
            if($res > -1){
                while($row = $this->Registro()){
                    $objUsuario = new Usuario();
                    $objUsuario->setidusuario($row['idusuario']);
                    $objUsuario->cargar();
                    $objCompra = new Compra();
                    $objCompra->setear($row['idcompra'], $row['cofecha'], $objUsuario);
                    array_push($arreglo, $objCompra);
                }
            }else{
                $this->setMensajeOperacion("Compra->listar: " . $this->getError());
            }
        }else{
            $this->setMensajeOperacion("Compra->listar: " . $this->getError());
        }
        return $arreglo;
    }
}
