<?php 
class CompraEstadoTipo extends BaseDatos{
    private $idcompraestadotipo;
    private $cetdescripcion;
    private $cetdetalle;
    private $mensajeoperacion;

    public function __construct()
    {
        parent::__construct();
        $this->idcompraestadotipo = '';
        $this->cetdescripcion = '';
        $this->cetdetalle = '';
        $this->mensajeoperacion = "";
    }

    public function setear($idcompraestadotipo, $cetdescripcion, $cetdetalle){
        $this->setIdCompraEstadoTipo($idcompraestadotipo);
        $this->setcetdescripcion($cetdescripcion);
        $this->setcetdetalle($cetdetalle);
    }

    //Get y Set idcompraestadotipo
    public function getIdCompraEstadoTipo(){
        return $this->idcompraestadotipo;
    }
    public function setIdCompraEstadoTipo($valor){
        $this->idcompraestadotipo = $valor;
    }
    //Get y Set cetdescripcion
    public function getcetdescripcion(){
        return $this->cetdescripcion;
    }
    public function setcetdescripcion($valor){
        $this->cetdescripcion = $valor;
    }
    //Get y Set cetdetalle
    public function getcetdetalle(){
        return $this->cetdetalle;
    }
    public function setcetdetalle($valor){
        $this->cetdetalle = $valor;
    }

    // Metodo get y set MENSAJE ERROR
    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor; 
    }


    /**
     * Busca en la base de datos los datos de un compraestadotipo específico por idcompraestadotipo y 
     * los carga en las propiedades del objeto. 
     * Devuelve true si fue exitoso o false en caso de error, almacenando un mensaje 
     * de error en mensajeoperacion.
     * @return bool $exito
     */
    public function cargar(){
        //Inicializo variables
        $exito = false;
        //Ejecuta consulta SELECT a la BD
        $sql = "SELECT * FROM compraestadotipo WHERE idcompraestadotipo =" . $this->getIdCompraEstadoTipo();
        if($this ->Iniciar()){
            $res = $this->Ejecutar($sql);
            if($res > -1){
                $row = $this->Registro();
                $this->setear($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);
                $exito = true;
            }else{
                $this->setmensajeoperacion("CompraEstadoTipo->cargar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("CompraEstadoTipo->cargar: ".$this->getError());
        }
        return $exito;
    }

    /**    
     * Inserta un nuevo registro en la tabla. No se incluye idcompra ya que este es 
     * auto-incremental
     */
    public function insertar(){
        //Inicializo variables
        $resp = false;

        //Ejecuta consulta INSERT INTO a la BD
        $sql  =  "INSERT INTO compraestadotipo (idcompraestadotipo, cetdescripcion, cetdetalle) VALUES (null, '"
        .$this->getcetdescripcion()."', '"
        .$this->getcetdetalle()."');";

        if ($this->Iniciar()) {
            if($elid = $this->Ejecutar($sql)){
                $this->setIdCompraEstadoTipo($elid);
                $resp = true;
            }else{
                $this->setmensajeoperacion("CompraEstadoTipo->insertar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("CompraEstadoTipo->insertar: ".$this->getError());
        }
        return $resp;
    }

    /**
     * Actualiza un registro existente de acuerdo con el idcompraestadotipo
     */
    public function modificar(){
        //Inicializo variables
        $resp = false;

        //Ejecuta consulta UPDATE a la BD
        $sql = "UPDATE compraestadotipo SET 
        cetdescripcion = '".$this->getcetdescripcion()."', 
        cetdetalle = '".$this->getcetdetalle()."'
        WHERE idcompraestadotipo = ".$this->getIdCompraEstadoTipo();

        if ($this->Iniciar()) {
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setmensajeoperacion("CompraEstadoTipo->modificar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("CompraEstadoTipo->modificar: ".$this->getError());
        }
        return $resp;
    }

    /**
     * Borra un registro de la tabla con el idcompraestadotipo correspondiente
     */
    public function eliminar(){
        $resp = false;
        $sql = "UPDATE compraestadotipo SET prodeshabilitado = '".date("Y-m-d h:i:sa")."' WHERE idcompraestadotipo = " . $this->getIdCompraEstadoTipo(); //'".date("Y-m-d h:i:sa")."'
        if($this->Iniciar()){
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setmensajeoperacion("CompraEstadoTipo->eliminar: " . $this->getError());
            }
        }else{
            $this->setmensajeoperacion("CompraEstadoTipo->eliminar: " . $this->getError());
        }
        return $resp;
    }
    
    /**
     * Recupera múltiples registros de la tabla. Permite añadir una condición para filtrar
     */
    public function listar($condicion = ""){
        $arreglo = array();
        $sql = "SELECT * FROM compraestadotipo";
        if($condicion != ""){
            $sql .= " WHERE " . $condicion;
        }
        if($this->Iniciar()){
            $res = $this->Ejecutar($sql);
            if($res > -1){
                while($row = $this->Registro()){
                    $objCompraEstadoTipo = new CompraEstadoTipo();
                    $objCompraEstadoTipo->setear($row['idcompraestadotipo'], $row['cetdescripcion'], $row['cetdetalle']);
                    array_push($arreglo, $objCompraEstadoTipo);                 
                }
            }else{
                $this->setmensajeoperacion("CompraEstadoTipo->listar: " . $this->getError());
            }
        }else{
            $this->setmensajeoperacion("CompraEstadoTipo->listar: " . $this->getError());
        }
    
        return $arreglo;
    }
    
    
   /**
     * 
     */
    public function listarCET($condicion = ""){
        $arreglo = array();
        $sql = "SELECT * FROM compraestadotipo ";
        if($condicion != ""){
            $sql .= " WHERE " . $condicion;
        }
        if($this->Iniciar()){
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
        }else{
            $this->setmensajeoperacion("CompraEstadoTipo->listar: " . $this->getError());
        }    
        return $arreglo;
    }

}
