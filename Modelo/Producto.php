<?php 
class Producto extends BaseDatos{
    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $proprecio;
    private $procantstock;
    private $proimagen;
    private $mensajeoperacion;

    public function __construct()
    {
        parent::__construct();
        $this->idproducto = '';
        $this->pronombre = '';
        $this->prodetalle = '';
        $this->proprecio = 0;
        $this->procantstock = '';
        $this->proimagen = '';
        $this->mensajeoperacion = "";
    }

    public function setear($idproducto, $pronombre, $prodetalle, $proprecio, $procantstock, $proimagen){
        $this->setIdProducto($idproducto);
        $this->setProNombre($pronombre);
        $this->setProDetalle($prodetalle);
        $this->setProPrecio($proprecio);
        $this->setProStock($procantstock);
        $this->setProImagen($proimagen);
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
    //Get y Set proprecio
    public function getProPrecio(){
        return $this->proprecio;
    }
    public function setProPrecio($valor){
        $this->proprecio = $valor;
    }
    //Get y Set procantstock
    public function getProStock(){
        return $this->procantstock;
    }
    public function setProStock($valor){
        $this->procantstock = $valor;
    }

    //Get y Set proimagen
    public function getProImagen(){
        return $this->proimagen;
    }
    public function setProImagen($valor){
        $this->proimagen = $valor;
    }

    // Metodo get y set MENSAJE ERROR
    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor; 
    }


    public function buscar($idproducto){
        $base= new BaseDatos();
        $consulta = "SELECT * FROM producto where idproducto= " . $idproducto;
        $exito = false;
        if($base ->Iniciar()){
            if($base -> Ejecutar($consulta)){
                if($row= $base -> Registro()){
                    $this -> setProPrecio($row['proprecio']);
                    $this -> setProDetalle($row['prodetalle']);
                    $this -> setProNombre($row['pronombre']);
                    $this -> setProImagen($row['proimagen']);
                    $this -> SetIdProducto($idproducto);
                    $this -> setProStock($row['procantstock']);
                    $exito = true;
                }
            }else{
                $this-> setmensajeoperacion($base -> getError());
            }
        }else{
            $this -> setmensajeoperacion($base -> getError());
        }
        return $exito;
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
                $this->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['proprecio'], $row['procantstock'], $row['proimagen']);
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
        $sql  =  "INSERT INTO producto (idproducto, pronombre, prodetalle, proprecio, procantstock, proimagen) VALUES (null, '"
        .$this->getProNombre()."', '"
        .$this->getProDetalle()."', "
        .$this->getProPrecio().", '"
        .$this->getProStock()."', '"
        .$this->getProImagen()."');";

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
        proprecio = ".$this->getProPrecio().", 
        procantstock = '".$this->getProStock()."', 
        proimagen = '".$this->getProImagen()."' 
        WHERE idproducto = ".$this->getIdProducto();

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
        $sql = "UPDATE producto SET prodeshabilitado = '".date("Y-m-d h:i:sa")."' WHERE idproducto = " . $this->getIdProducto(); //'".date("Y-m-d h:i:sa")."'
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
                    if ($row['prodeshabilitado'] == NULL){
                        $objProducto = new Producto();
                        $objProducto->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'], $row['proprecio'], $row['procantstock'], $row['proimagen']);
                        array_push($arreglo, $objProducto);
                    }
                }
            }else{
                $this->setmensajeoperacion("Producto->listar: " . $this->getError());
            }
        }else{
            $this->setmensajeoperacion("Producto->listar: " . $this->getError());
        }
    
        return $arreglo;
    }
    
    
    /**
     * Recupera múltiples registros de la tabla. Permite añadir una condición para filtrar
     */
    public function listarCompra($condicion = ""){
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
