<?php

/*
Este código define la clase Menu, que extiende de la clase BaseDatos, para manejar operaciones sobre la tabla menu de una base de datos.
Permite realizar operaciones básicas de CRUD (crear, leer, actualizar y eliminar) y maneja los errores mediante el atributo mensajeoperacion. La clase es muy útil para trabajar con menús de manera estructurada, facilitando la conexión y las operaciones con la base de datos.
*/

class Menu extends BaseDatos{
    private $idmenu; //Identificador único del menú.
    private $menunombre;
    private $menuurl;
    private $mensajeoperacion; //Mensaje de error o información sobre la última operación.

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

    // Metodo get y set mensajeoperacion
    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor; 
    }


    /**
     * Carga un menú de la base de datos a partir de su idmenu.
     * Ejecuta un SELECT y, si encuentra el menú, llama a setear para cargar sus datos. Si no, almacena el mensaje de error en mensajeoperacion.
     * Retorna true si carga el menú correctamente, y false en caso contrario.
     * @return bool $exito
     */
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
     * Summary of insertar ---hace falta insertar un menu???? --> SI HICIERA FALTA YA LO TENEMOS, SINO NO MOLESTA QUE ESTÉ---
     * Inserta un nuevo menú en la base de datos.
     * Crea una sentencia INSERT con menunombre y menuurl, y establece idmenu en null (autoincremental).
     * Al finalizar, guarda el idmenu asignado por la base de datos.
     * Retorna true si la inserción es exitosa y false en caso de error.
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
     * Actualiza el menunombre y menuurl de un menú en la base de datos, identificándolo por idmenu.
     * Retorna true si la modificación es exitosa, y false en caso contrario.
     * @return bool $resp
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
     * Realiza un borrado lógico, cambiando usdeshabilitado al valor de la fecha y hora actual, sin eliminar realmente el registro de la base de datos.
     * Retorna true si el borrado es exitoso, y false en caso contrario.
     * @return bool $resp
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


    /**
     * Retorna una lista de objetos Menu que cumplen con el parámetro where especificado.
     * Ejecuta un SELECT y, por cada resultado, crea un objeto Menu, lo carga con setear, y lo añade al arreglo arreglo.
     * Retorna un arreglo de objetos Menu.
     * @return array $arreglo
     */
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