<?php
class MenuRol extends BaseDatos{
    private $objMenu; // Objeto de la clase Menu
    private $objRol;     // Objeto de la clase Rol
    private $mensajeoperacion;

    public function __construct(){
        parent::__construct();
        $this->objMenu = new Menu();
        $this->objRol = new Rol();
        $this->mensajeoperacion = "";
    }

    public function setear($objMenu, $objRol){
        $this->setMenu($objMenu);
        $this->setRol($objRol);
    }

    // Métodos Get y Set para el objeto Menu
    public function getMenu(){
        return $this->objMenu;
    }

    public function setMenu($objMenu){
        $this->objMenu = $objMenu;
    }

    // Métodos Get y Set para el objeto Rol
    public function getRol(){
        return $this->objRol;
    }

    public function setRol($objRol){
        $this->objRol = $objRol;
    }

    // Métodos Get y Set para mensajeoperacion
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }

    //Método para buscar una relación Menu-rol
    public function cargar(){
        $exito = false;
        $sql = "SELECT * FROM menuRol WHERE 
        idmenu = ".$this->getMenu()->getidMenu()." AND 
        idrol = ".$this->getRol()->getidrol();
        if($this->Iniciar()){
            $res = $this->Ejecutar($sql);
            if($res > -1){
                $row = $this->Registro();
                $objMenu = new Menu();
                $objMenu->setidMenu($row['idmenu']);
                $objMenu->cargar();
                $objRol = new Rol();
                $objRol->setidrol($row['idrol']);
                $objRol->cargar(); 
                $this->setear($objMenu, $objRol);
                $exito = true;             
            }else{
                $this->setMensajeoperacion("MenuRol->buscar: " . $this->getError());
            }
        }else{
            $this->setMensajeoperacion("MenuRol->buscar: " . $this->getError());
        }
        return $exito;
    }

    // Método para insertar una nueva relación Menu-rol
    public function insertar(){
        $resp = false;
        $sql = "INSERT INTO menurol(idmenu, idrol) VALUES(" 
        .$this->getMenu()->getidMenu().", " 
        .$this->getRol()->getidrol().")";
        if($this->Iniciar()) {
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeoperacion("MenuRol->insertar: " . $this->getError());
            }
        }else{
            $this->setMensajeoperacion("MenuRol->insertar: " . $this->getError());
        }
        return $resp;
    }


  /**
     * Summary of modificar
     * @return bool
     */
    public function modificar(){
        $resp = false;
        $sql = "UPDATE menurol SET 
        idmenu = '".$this->getMenu()->getidMenu()."', 
        idrol = '".$this->getRol()->getidrol()."', 
        WHERE idmenu = ".$this->getMenu()->getidMenu()." and idrol = ".$this->getRol()->getidrol();
        if ($this->Iniciar()) {
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setmensajeoperacion("Menu->modificar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("Menu->modificar: ".$this->getError());
        }
        return $resp;
    }


    //Método para eliminar una relación Menu-rol
    public function eliminar(){
        $resp = false;
        $sql = "DELETE FROM menurol WHERE idmenu = " 
        . $this->getMenu()->getidMenu() . " AND idrol = " 
        . $this->getRol()->getidrol();
        if($this->Iniciar()){
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeoperacion("MenuRol->eliminar: " . $this->getError());
            }
        }else{
            $this->setMensajeoperacion("MenuRol->eliminar: " . $this->getError());
        }
        return $resp;
    }

    // Método para listar todas las relaciones Menu-rol
    public function listar($parametro = ""){
        $arreglo = array();
        $sql = "SELECT * FROM menurol ";
        if($parametro != ""){
            $sql .= " WHERE " . $parametro;
        }
        if($this->Iniciar()){
            if ($this->Ejecutar($sql)){
                while ($row = $this->Registro()){
                    $objMenu = new Menu();
                    $objMenu->setidMenu($row['idmenu']);
                    $objMenu->cargar();
                    $objRol = new Rol();
                    $objRol->setidrol($row['idrol']);
                    $objRol->cargar();
                    $obj = new MenuRol();
                    $obj->setear($objMenu, $objRol);
                    array_push($arreglo, $obj);
                }
            }else{
                self::setMensajeoperacion("MenuRol->listar: " . $this->getError());
            }
        }
        return $arreglo;
    }
}
?>
