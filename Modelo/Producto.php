<?php 
class Producto extends BaseDatos{
    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $procantstock;
    private $mensajeoperacion;

    public function __construct()
    {
        parent::__construct();
        $this->idproducto = '';
        $this->pronombre = '';
        $this->prodetalle = '';
        $this->procantstock = '';
        $this->mensajeoperacion = "";
    }

    public function setear($idproducto, $pronombre, $prodetalle, $procantstock){
        $this->setIdProducto($idproducto);
        $this->setProNombre($pronombre);
        $this->setProDetalle($prodetalle);
        $this->setProStock($procantstock);
    }

    //Get y Set IDproducto
    public function getIdProducto(){
        return $this->idproducto;
    }
    public function SetIdProducto($valor){
        $this->idproducto = $valor;
    }
    //Get y Set pronombre
    public function getProNombre(){
        return $this->pronombre;
    }
    public function setProNombre($valor){
        $this->pronombre = $valor;
    }
    //Get y Set prodetalle
    public function getProDetalle(){
        return $this->prodetalle;
    }
    public function setProDetalle($valor){
        $this->prodetalle = $valor;
    }
    //Get y Set procantstock
    public function getProStock(){
        return $this->procantstock;
    }
    public function setProStock($valor){
        $this->procantstock = $valor;
    }

    // Metodo get y set MENSAJE ERROR
    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor; 
    }

    /**
     * Busca en la base de datos los datos de un producto específico por idproducto y 
     * los carga en las propiedades del objeto. 
     * Devuelve true si fue exitoso o false en caso de error, almacenando un mensaje 
     * de error en mensajeoperacion.
     * @return bool $exito
     */
    public function cargar(){
        //Inicializo variables
        $exito = false;
        //Ejecuta consulta SELECT a la BD
        $sql = "SELECT * FROM producto WHERE idproducto =" . $this->getIdProducto();
        if($this ->Iniciar()){
            $res = $this->Ejecutar($sql);
            if($res > -1){
                $row = $this->Registro();
                $this->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock']);
                $exito = true;
            }else{
                $this->setmensajeoperacion("Producto->cargar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("Producto->cargar: ".$this->getError());
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
        $sql  =  "INSERT INTO producto (idproducto, pronombre, prodetalle, procantstock) VALUES (null, '"
        .$this->getProNombre()."', '"
        .$this->getProDetalle()."', '"
        .$this->getProStock()."');";

        if ($this->Iniciar()) {
            if($elid = $this->Ejecutar($sql)){
                $this->SetIdProducto($elid);
                $resp = true;
            }else{
                $this->setmensajeoperacion("Producto->insertar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("Producto->insertar: ".$this->getError());
        }
        return $resp;
    }

    /**
     * Actualiza un registro existente de acuerdo con el idproducto
     */
    public function modificar(){
        //Inicializo variables
        $resp = false;

        //Ejecuta consulta UPDATE a la BD
        $sql = "UPDATE producto SET 
        pronombre = '".$this->getProNombre()."', 
        prodetalle = '".$this->getProDetalle()."', 
        procantstock = '".$this->getProStock()."' WHERE idproducto = ".$this->getIdProducto();

        if ($this->Iniciar()) {
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setmensajeoperacion("Producto->modificar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("Producto->modificar: ".$this->getError());
        }
        return $resp;
    }

    /**
     * Borra un registro de la tabla con el idproducto correspondiente
     */
    public function eliminar(){
        $resp = false;
        $sql = "DELETE FROM producto WHERE idproducto = " . $this->getIdProducto();
        if($this->Iniciar()){
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setmensajeoperacion("Producto->eliminar: " . $this->getError());
            }
        }else{
            $this->setmensajeoperacion("Producto->eliminar: " . $this->getError());
        }
        return $resp;
    }
    
    /**
     * Recupera múltiples registros de la tabla. Permite añadir una condición para filtrar
     */
    public function listar($condicion = ""){
        $arreglo = array();
        $sql = "SELECT * FROM producto";
        if($condicion != ""){
            $sql .= " WHERE " . $condicion;
        }
        if($this->Iniciar()){
            $res = $this->Ejecutar($sql);
            if($res > -1){
                while($row = $this->Registro()){
                    $objProducto = new Producto();
                    $objProducto->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['procantstock']);
                    array_push($arreglo, $objProducto);
                }
            }else{
                $this->setmensajeoperacion("Producto->listar: " . $this->getError());
            }
        }else{
            $this->setmensajeoperacion("Producto->listar: " . $this->getError());
        }
    
        return $arreglo;
    }
    

}
