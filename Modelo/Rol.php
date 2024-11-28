<?php

/*

Este código define una clase Rol, que representa la entidad de un rol en una base de datos. La clase hereda de BaseDatos, lo que permite ejecutar operaciones en la base de datos, como inserciones, actualizaciones y consultas.

La clase Rol permite:

Cargar un rol desde la base de datos.
Insertar un nuevo rol.
Modificar la descripción de un rol.
Eliminar un rol específico.
Listar todos los roles que cumplan con un criterio opcional.
Esta clase es esencial para gestionar roles en una aplicación y se comunica con la base de datos mediante la clase BaseDatos.
*/

class Rol extends BaseDatos{
    private $idrol; //Identifica de manera única un rol en la base de datos.
    private $roldescripcion;
    private $mensajeoperacion;

    public function __construct() {
        parent::__construct();
        $this->idrol = "";
        $this->roldescripcion = "";
        $this->mensajeoperacion = "";
    }

    //Permite asignar valores a las propiedades idrol y roldescripcion.
    public function setear($idrol, $roldescripcion) {
        $this->setidrol($idrol);
        $this->setroldescripcion($roldescripcion);
    }

    // Métodos Get y Set para idrol
    public function getidrol() {
        return $this->idrol;
    }

    public function setidrol($valor) {
        $this->idrol = $valor;
    }

    // Métodos Get y Set para roldescripcion
    public function getroldescripcion() {
        return $this->roldescripcion;
    }

    public function setroldescripcion($valor) {
        $this->roldescripcion = $valor;
    }

    // Métodos Get y Set para mensajeoperacion
    public function getMensajeoperacion() {
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($valor) {
        $this->mensajeoperacion = $valor;
    }


    /**
     * Summary of cargar
     * Busca en la base de datos un rol específico según su idrol. 
     * Si encuentra un rol, carga su descripción en el objeto actual.
     * @return bool $resp
     */
    public function cargar(){
        $resp = false;

        $sql = "SELECT * FROM rol WHERE idrol = ".$this->getidrol();

        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $resp = true;
                    $row = $this->Registro();
                    $this->setear($row['idrol'], $row['rodescripcion']);
                }
            }
        }else{
            $this->setMensajeoperacion("rol->cargar: ".$this->getError());
        }
        return $resp;
    }


    /**
     * Summary of insertar
     * Inserta un nuevo rol en la base de datos con la descripción dada. 
     * Si la inserción es exitosa, asigna el idrol generado a la propiedad idrol del objeto actual.
     * @return bool
     */
    public function insertar(){
        $resp = false;

        $sql="INSERT INTO rol (rodescripcion)  VALUES ('".$this->getroldescripcion()."');";

        if ($this->Iniciar()) {
            if ($elid = $this->Ejecutar($sql)) {
                $this->setidrol($elid);
                $resp = true;
            } else {
                $this->setMensajeoperacion("rol->insertar: ".$this->getError());
            }
        }else{
            $this->setMensajeoperacion("rol->insertar: ".$this->getError());
        }
        return $resp;
    }
    /**
     * Summary of modificar
     * Actualiza la descripción del rol en la base de datos para el idrol actual. 
     * Devuelve true si la actualización es exitosa.
     * @return bool $resp
     */
    public function modificar(){
        $resp = false;

        $sql="UPDATE rol SET rodescripcion = '".$this->getroldescripcion()."' ".
            " WHERE idrol = ".$this->getidrol();

        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion("rol->modificar: ".$this->getError());
            }
        }else{
            $this->setMensajeoperacion("rol->modificar: ".$this->getError());
        }
        return $resp;
    }


    /**
     * Summary of eliminar
     * Elimina el rol de la base de datos según su idrol. 
     * Devuelve true si la eliminación es exitosa
     * @return bool $resp
     */
    public function eliminar(){
        $resp = false;

        $sql="DELETE FROM rol WHERE idrol = ".$this->getidrol();

        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql) > 0) {
                $resp = true;
            }else{
                $this->setMensajeoperacion("rol->eliminar: ".$this->getError());
            }
        }else{
            $this->setMensajeoperacion("rol->eliminar: ".$this->getError());
        }
        return $resp;
    }


    /**
     * Summary of listar
     * Devuelve un arreglo de objetos Rol que cumplen con un criterio opcional ($parametro). 
     * Cada registro en la base de datos se convierte en un objeto Rol, y se añade al arreglo.
     * @param mixed $parametro
     * @return array $arreglo
     */
    public function listar($parametro=""){
        $arreglo = array();
        $sql="SELECT * FROM rol ";
        if ($parametro!="") {
            $sql.= ' WHERE '.$parametro;
        }
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    while ($row = $this->Registro()){
                            $objrol= new rol();
                            $objrol->setear($row['idrol'], $row['rodescripcion']);
                            array_push($arreglo, $objrol);
                    }
                } 
            }else{
                $this->setMensajeoperacion("rol->listar: ".$this->getError());
            }
        }
        return $arreglo;
    }
}

?>
