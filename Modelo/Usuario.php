<?php
class Usuario extends BaseDatos{
    private $idUsuario;
    private $nombre;
    private $password;
    private $email;
    private $mensajeoperacion;

    public function __construct()
    {
        parent::__construct();
        $this->idUsuario = "";
        $this->nombre = "";
        $this->password = "";
        $this->email = "";
        $this->mensajeoperacion = "";
    }

    public function setear($idUsuario, $nombre, $password, $email)    {
        $this->setIdUsuario($idUsuario);
        $this->setNombre($nombre);
        $this->setPassword($password);
        $this->setEmail($email);
    }
    // Metodo get y set ID
    public function getIdUsuario(){
        return $this->idUsuario;
    }
    public function setIdUsuario($valor){
        $this->idUsuario = $valor;
    }
    
    // Metodo get y set NOMBRE
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($valor){
        $this->nombre = $valor;
    }
    
    // Metodo get y set PASSWORD
    public function getPassword(){
        return $this->password;
    }
    public function setPassword($valor){
        $this->password = $valor;
    }
        
    // Metodo get y set EMAIL
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($valor){
        $this->email = $valor;
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
        $sql = "SELECT * FROM usuario WHERE idusuario =" . $this->getIdUsuario();
        if($this ->Iniciar()){
            $res = $this->Ejecutar($sql);
            if($res > -1){
                $row = $this->Registro();
                $this->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usemail']);
                $exito = true;
            }else{
                $this->setmensajeoperacion("Usuario->cargar: ".$this->getError());
            }
        }else{
                $this->setmensajeoperacion("Usuario->cargar: ".$this->getError());
        }
        return $exito;
    }

    public function insertar(){
        $resp = false;
        $sql  =  "INSERT INTO usuario(idusuario, usnombre, uspass, usemail) VALUES("
        .$this->getIdUsuario().", '"
        .$this->getNombre()."', '"
        .$this->getPassword()."', '"
        .$this->getEmail()."');";
        if ($this->Iniciar()) {
            if($elid = $this->Ejecutar($sql)){
                $this->setIdUsuario($elid);
                $resp = true;
            }else{
                $this->setmensajeoperacion("Usuario->insertar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("Usuario->insertar: ".$this->getError());
        }
        return $resp;
    }
    /**
     * Summary of modificar
     * @return bool
     */
    public function modificar(){
        $resp = false;
        $sql = "UPDATE usuario SET 
        usnombre = '".$this->getNombre()."', 
        uspass = '".$this->getPassword()."', 
        usemail = '".$this->getEmail()."' WHERE idusuario = ".$this->getIdUsuario();
        if ($this->Iniciar()) {
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setmensajeoperacion("Usuario->modificar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("Usuario->modificar: ".$this->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $resp = false;
        $sql = "UPDATE usuario SET usdeshabilitado = ".date("Y-m-d")." WHERE idusuario = ".$this->getIdUsuario();
        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            }else{
                $this->setmensajeoperacion("Usuario->eliminar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("Usuario->eliminar: ".$this->getError());
        }
        return $resp;
    }

    public function listar($parametro=""){
        $arreglo = array();
        $sql = "SELECT * FROM usuario ";
        if ($parametro != "") {
            $sql .= " WHERE " .$parametro;
        }
        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if($res > -1){
                if($res > 0){
                    while ($row = $this->Registro()){
                        if ($row['usdeshabilitado'] === NULL){
                            $obj = new Usuario();
                            $obj->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usemail']);
                            array_push($arreglo, $obj);
                        }
                    }
                }
            }else{
                $this->setmensajeoperacion("Usuario->listar: ".$this->getError());
            }
        }
        return $arreglo;
    }

}

?>