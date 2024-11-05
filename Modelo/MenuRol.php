<?php

/*
Este código define una clase MenuRol que representa una relación entre Menu y Rol en una base de datos. Esta clase permite gestionar las relaciones entre un menú y un rol (por ejemplo, asignando un rol específico a un menú).
Facilita la creación, modificación, eliminación y búsqueda de relaciones entre Menu y Rol en una base de datos. Esta clase es útil para gestionar permisos o asociaciones entre menús y roles en una aplicación de software, permitiendo establecer qué roles tienen acceso a cada elemento del menú. 
*/

class MenuRol extends BaseDatos{
    private $objMenu; // Objeto de la clase Menu
    private $objRol;     // Objeto de la clase Rol
    private $mensajeoperacion;

    //Inicializa los objetos objMenu y objRol usando sus constructores, y llama al constructor de la clase BaseDatos (probablemente maneja la conexión a la base de datos).
    public function __construct(){
        parent::__construct();
        $this->objMenu = new Menu();
        $this->objRol = new Rol();
        $this->mensajeoperacion = "";
    }

    //Asigna valores a los objetos objMenu y objRol, facilitando la creación de una relación entre un menú y un rol.
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

    /**
     * Método para buscar una relación Menu-rol
     * Busca una relación específica entre un menú y un rol en la base de datos.
     * Ejecuta una consulta SELECT usando idmenu y idrol para cargar los objetos Menu y Rol correspondientes.
     * Retorna true si encuentra la relación, y false si no la encuentra o en caso de error.
     * @return bool $exito
     */
    public function cargar(){
        //Inicializo variables
        $exito = false;

        //Ejecuta una consulta SELECT a la BD
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


    /**
     * Método para insertar una nueva relación Menu-rol.
     * Inserta una nueva relación Menu-Rol en la tabla menurol.
     * Ejecuta una consulta INSERT con los valores de idmenu y idrol de los objetos asociados.
     * Retorna true si la inserción es exitosa, y false en caso de error.
     * @return bool $resp
     */
    public function insertar(){
        //Inicializo variables
        $resp = false;

        //Ejecuta consulta INSERT INTO a la BD
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
     * Modifica una relación existente en la tabla menurol.
     * Ejecuta un UPDATE usando los valores de idmenu y idrol, actualizando los datos según el nuevo valor de estos campos.
     * Retorna true si la modificación es exitosa, y false en caso de error
     * @return bool $resp
     */
    public function modificar(){
        //Inicializo variables
        $resp = false;

        //Ejecuta consulta UPDATE a la BD
        $sql = "UPDATE menurol SET 
        idmenu = '".$this->getMenu()->getidMenu()."', 
        idrol = '".$this->getRol()->getidrol()."' 
        WHERE idmenu = ".$this->getMenu()->getidMenu()." and idrol = ".$this->getRol()->getidrol();
        /*
        ESTE TIENE UN ERROR
        $sql = "UPDATE menurol SET 
        idmenu = '".$this->getMenu()->getidMenu()."', 
        idrol = '".$this->getRol()->getidrol()."', 
        WHERE idmenu = ".$this->getMenu()->getidMenu()." and idrol = ".$this->getRol()->getidrol();
        */

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


    /**
     * Método para eliminar una relación Menu-rol
     * Elimina una relación Menu-Rol específica de la tabla menurol.
     * Ejecuta un DELETE con los valores de idmenu y idrol para borrar la relación.
     * Retorna true si el borrado es exitoso, y false en caso de error.
     * @return bool $resp
     */
    public function eliminar(){
        //Inicializo variables
        $resp = false;

        //Ejecuta consulta DELETE FROM a la BD
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

    /**
     * Método para listar todas las relaciones Menu-rol.
     * Lista todas las relaciones Menu-Rol de la tabla menurol.
     * Ejecuta un SELECT para obtener todos los registros o los que cumplan con un criterio WHERE dado.
     * Por cada registro encontrado, crea un nuevo objeto MenuRol, carga los datos de Menu y Rol, y lo agrega a un arreglo.
     * Retorna un arreglo de objetos MenuRol que representan todas las relaciones encontradas.
     * @return array $arreglo
     */
    public function listar($parametro = ""){
        //Inicializo variables
        $arreglo = array();

        //Ejecuta consulta SELECT a la BD
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
