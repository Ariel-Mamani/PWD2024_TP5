<?php
class Menu extends BaseDatos{
    private $idmenu;
    private $menunombre;
    private $menuurl;
    private $mensajeoperacion;

    public function __construct()
    {
        parent::__construct();
        $this->idmenu = "";
        $this->menunombre = "";
        $this->menuurl = "";
        $this->mensajeoperacion = "";
    }

    public function setear($idmenu, $menunombre, $menuurl)    {
        $this->setidmenu($idmenu);
        $this->setmenunombre($menunombre);
        $this->setmenuurl($menuurl);
    }
    // Metodo get y set ID
    public function getidmenu(){
        return $this->idmenu;
    }
    public function setidmenu($valor){
        $this->idmenu = $valor;
    }
    
    // Metodo get y set menunombre
    public function getmenunombre(){
        return $this->menunombre;
    }
    public function setmenunombre($valor){
        $this->menunombre = $valor;
    }
        
    // Metodo get y set menuurl
    public function getmenuurl(){
        return $this->menuurl;
    }
    public function setmenuurl($valor){
        $this->menuurl = $valor;
    }

    // Metodo get y set MENSAJE ERROR
    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor; 
    }

    public function cargar(){
        $exito = false;
        $sql = "SELECT * FROM menu WHERE idmenu =" . $this->getidmenu();
        if($this ->Iniciar()){
            $res = $this->Ejecutar($sql);
            if($res > -1){
                $row = $this->Registro();
                $this->setear($row['idmenu'], $row['menunombre'],  $row['menuurl']);
                $exito = true;
            }else{
                $this->setmensajeoperacion("menu->cargar: ".$this->getError());
            }
        }else{
                $this->setmensajeoperacion("menu->cargar: ".$this->getError());
        }
        return $exito;
    }
    /**
     * Summary of insertar hace falta insertar un menu????
     * @return bool
     */
    public function insertar(){
        $resp = false;
        $sql  =  "INSERT INTO menu (idmenu, menunombre, menuurl) VALUES (null, '"
        .$this->getmenunombre()."', '"
        .$this->getmenuurl()."', 
        'null');";
        if ($this->Iniciar()) {
            if($elid = $this->Ejecutar($sql)){
                $this->setidmenu($elid);
                $resp = true;
            }else{
                $this->setmensajeoperacion("menu->insertar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("menu->insertar: ".$this->getError());
        }
        return $resp;
    }
    /**
     * Summary of modificar
     * @return bool
     */
    public function modificar(){
        $resp = false;
        $sql = "UPDATE menu SET 
        menunombre = '".$this->getmenunombre()."', 
        menuurl = '".$this->getmenuurl()."' WHERE idmenu = ".$this->getidmenu();
        if ($this->Iniciar()) {
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setmensajeoperacion("menu->modificar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("menu->modificar: ".$this->getError());
        }
        return $resp;
    }

    
    /**
     * Eliminar, borrado lógico
     */
    public function eliminar(){
        $resp = false;
        $sql = "UPDATE menu SET usdeshabilitado = '".date("Y-m-d h:i:sa")."' WHERE idmenu = ".$this->getidmenu();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            }else{
                $this->setmensajeoperacion("menu->eliminar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("menu->eliminar: ".$this->getError());
        }
        return $resp;
    }

    public function listar($parametro=""){
        $arreglo = array();
        $sql = "SELECT * FROM menu ";
        if ($parametro != "") {
            $sql .= " WHERE " .$parametro;
        }
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if($res > -1){
                if($res > 0){
                    while ($row = $this->Registro()){
                   
                            $obj = new menu();
                            $obj->setear($row['idmenu'], $row['menunombre'],  $row['menuurl']);
                            array_push($arreglo, $obj);
                        
                    }
                }
            }else{
                $this->setmensajeoperacion("menu->listar: ".$this->getError());
            }
        }
        return $arreglo;
    }

}

?>