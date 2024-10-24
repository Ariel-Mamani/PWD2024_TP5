<?php
class Usuario{
    private $idUsuario;
    private $nombre;
    private $password;
    private $email;
    private $usdeshabilitado;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idUsuario = "";
        $this->nombre = "";
        $this->password = "";
        $this->email = "";
        $this->usdeshabilitado = null;
        $this->mensajeoperacion = "";
    }

    public function setear($idUsuario, $nombre, $password, $email, $usdeshabilitado)    {
        $this->setIdUsuario($idUsuario);
        $this->setNombre($nombre);
        $this->setPassword($password);
        $this->setEmail($email);
        $this->setUsdeshabilitado($usdeshabilitado);
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

    // Metodo get y set DESHASBILITADO
    public function getUsdeshabilitado(){
        return $this->usdeshabilitado;
    }
    public function setUsdeshabilitado($valor){
        $this->usdeshabilitado = $valor;
    }

    // Metodo get y set MENSAJE ERROR
    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor; 
    }

    public function buscar($idUsuario){
        $base = new BaseDatos();
        $exito = false;
        $sql = "Select * from usuario where idusuario =" . $idUsuario;
        if($base ->Iniciar()){
            if($base->Ejecutar($sql)){
                if($row = $base->Registro()){
                    $this -> setIdUsuario($idUsuario);
                    $this -> setNombre($row['usnombre']);
                    $this -> setPassword($row['uspass']);
                    $this -> setEmail($row['usemail']);
                    $this->setUsdeshabilitado($row['usdeshabilitado']);
                    $exito = true;
                }
            }
        }
        return $exito;
    }

    public function insertar(){
        $resp = false;
        $base  =  new BaseDatos();
        $sql  =  "INSERT INTO usuario(usnombre, uspass, usemail) VALUES('"
        .$this->getNombre()."', '"
        .$this->getPassword()."', '"
        .$this->getEmail()."','"
        .$this->getUsdeshabilitado()."');";
        if ($base->Iniciar()) {
            if($base->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setmensajeoperacion("Usuario->insertar: ".$base->getError());
            }
        }else{
            $this->setmensajeoperacion("Usuario->insertar: ".$base->getError());
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE usuario SET 
        usnombre = '".$this->getNombre()."', 
        uspass = '".$this->getPassword()."', 
        usemail = '".$this->getEmail()."', 
        usdeshabilitado = '".$this->getUsdeshabilitado()."' 
        WHERE idusuario = '".$this->getIdUsuario()."'";
        if ($base->Iniciar()) {
            if($base->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setmensajeoperacion("Tabla->modificar: ".$base->getError());
            }
        }else{
            $this->setmensajeoperacion("Tabla->modificar: ".$base->getError());
        }
        return $resp;
    }

    /**
     * Summary of borrar
     * @return bool
     */
    public function borrar(){
        $resp = false;
        $base = new BaseDatos(); 
        $sql = "UPDATE usuario SET usdeshabilitado = '".date("Y-m-d H:i:s")."' ".
            " WHERE idusuario = ".$this->getIdUsuario();  

        if($base->Iniciar()){  
            if($base->Ejecutar($sql)){  
                $resp = true;
            }else{
                $this->setMensajeoperacion("Usuario->borrar: ".$base->getError()); 
            }
        }else{
            $this->setMensajeoperacion("Usuario->borrar: ".$base->getError());  
        }
        return $resp;
    }


    public static function listar($parametro=""){
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuario ";
        if ($parametro != "") {
            $sql .= " WHERE " .$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res > -1){
            if($res > 0){
                while ($row = $base->Registro()){
                    $obj = new Usuario();
                    $obj->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usemail'], $row['usdeshabilitado']);                    array_push($arreglo, $obj);
                }
            }
        }else{
            self::setmensajeoperacion("Usuario->listar: ".$base->getError());
        }
        return $arreglo;
    }
}