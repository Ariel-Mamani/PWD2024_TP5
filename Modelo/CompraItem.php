<?php
class CompraItem extends BaseDatos{
    private $idcompraitem;
    private $producto; // Objeto Producto
    private $compra;   // Objeto Compra
    private $cicantidad;
    private $mensajeoperacion;

    public function __construct() {
        $this->idcompraitem = '';
        $this->producto = new Producto;  
        $this->compra = new Compra;    
        $this->cicantidad = 0;
        $this->mensajeoperacion = '';
    }

    public function setear($idcompraitem, $producto, $compra, $cicantidad) {
        $this->setIdCompraItem($idcompraitem);
        $this->setProducto($producto);
        $this->setCompra($compra);
        $this->setCiCantidad($cicantidad);
    }


    //------------ Getters y Setters Id Compra Item
    public function getIdCompraItem() {
        return $this->idcompraitem;
    }
    public function setIdCompraItem($valor) {
        $this->idcompraitem = $valor;
    }
    //------------ Getters y Setters Producto
    public function getProducto() {
        return $this->producto;
    }
    public function setProducto($valor) {
        $this->producto = $valor;
    }

    //------------ Getters y Setters Compra
    public function getCompra() {
        return $this->compra;
    }
    public function setCompra($valor) {
        $this->compra = $valor;
    }

    //------------ Getters y Setters Cantidad
    public function getCiCantidad() {
        return $this->cicantidad;
    }
    public function setCiCantidad($valor) {
        $this->cicantidad = $valor;
    }

    //------------ Getters y Setters Mensaje Operacion
    public function getMensajeOperacion() {
        return $this->mensajeoperacion;
    }
    public function setMensajeOperacion($valor) {
        $this->mensajeoperacion = $valor;
    }

    // Método para cargar un CompraItem desde la base de datos
    public function cargar() {
        $exito = false;
        $sql = "SELECT * FROM compraitem WHERE idcompraitem = " . $this->getIdCompraItem()." AND 
        idproducto = ".$this->getProducto()->getIdProducto()." AND 
        idcompra = ".$this->getCompra()->getIdCompra() ; //Para que la consulta funcione, los objetos Producto y Compra asociados deben tener sus respectivos id cargados antes de llamar a cargar(). Si no es el caso, la consulta podría fallar.
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if ($res > -1) {
                $row = $this->Registro();
                
                // Cargar objetos relacionados
                $producto = new Producto();
                $producto->setIdProducto($row['idproducto']);
                $producto->cargar();

                $compra = new Compra();
                $compra->setIdCompra($row['idcompra']);
                $compra->cargar();

                $this->setear($row['idcompraitem'], $producto, $compra, $row['cicantidad']);
                $exito = true;
            } else {
                $this->setMensajeOperacion("CompraItem->cargar: " . $this->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraItem->cargar: " . $this->getError());
        }
        return $exito;
    }

    // Método para insertar un nuevo CompraItem
    public function insertar(){
        $resp = false;
        $sql = "INSERT INTO compraitem (idproducto, idcompra, cicantidad) VALUES (
                " . $this->getProducto()->getIdProducto() . ", 
                " . $this->getCompra()->getIdCompra() . ", 
                " . $this->getCiCantidad() . ");";

        if($this->Iniciar()){
            if($elid = $this->Ejecutar($sql)){
                $this->setIdCompraItem($elid);
                $resp = true;
            }else{
                $this->setMensajeOperacion("CompraItem->insertar: " . $this->getError());
            }
        }else{
            $this->setMensajeOperacion("CompraItem->insertar: " . $this->getError());
        }
        return $resp;
    }

    // Método para modificar un CompraItem existente
    public function modificar(){
        $resp = false;
        $sql = "UPDATE compraitem SET 
                idproducto = " . $this->getProducto()->getIdProducto() . ", 
                idcompra = " . $this->getCompra()->getIdCompra() . ", 
                cicantidad = " . $this->getCiCantidad() . "
                WHERE idcompraitem = " . $this->getIdCompraItem();

        if($this->Iniciar()){
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeOperacion("CompraItem->modificar: " . $this->getError());
            }
        }else{
            $this->setMensajeOperacion("CompraItem->modificar: " . $this->getError());
        }
        return $resp;
    }

    // Método para eliminar un CompraItem
    public function eliminar() {
        $resp = false;
        $sql = "DELETE FROM compraitem WHERE idcompraitem = " . $this->getIdCompraItem()." AND 
        idproducto = ".$this->getProducto()->getIdProducto()." AND 
        idcompra = ".$this->getCompra()->getIdCompra() ;;

        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion("CompraItem->eliminar: " . $this->getError());
            }
        } else {
            $this->setMensajeOperacion("CompraItem->eliminar: " . $this->getError());
        }
        return $resp;
    }


    // Método para listar CompraItems
    public function listar($condicion = ""){
        $arreglo = array();
        $sql = "SELECT * FROM compraitem";

        if($condicion != ""){
            $sql .= " WHERE " . $condicion;
        }
        if($this->Iniciar()){
            $res = $this->Ejecutar($sql);
            if($res > -1){
                while($row = $this->Registro()){
                    $objCompraItem = new CompraItem();

                    // Cargar objetos relacionados
                    $producto = new Producto();
                    $producto->setIdProducto($row['idproducto']);
                    $producto->cargar();

                    $compra = new Compra();
                    $compra->setIdCompra($row['idcompra']);
                    $compra->cargar();

                    $objCompraItem->setear($row['idcompraitem'], $producto, $compra, $row['cicantidad']);
                    array_push($arreglo, $objCompraItem);
                }
            }else{
                $this->setMensajeOperacion("CompraItem->listar: " . $this->getError());
            }
        }else{
            $this->setMensajeOperacion("CompraItem->listar: " . $this->getError());
        }
        return $arreglo;
    }
}
