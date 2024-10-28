<?php
class Usuario extends BaseDatos{
    private $idusuario;
    private $usnombre;
    private $uspass;
    private $usmail;
    private $mensajeoperacion;

    public function __construct()
    {
        parent::__construct();
        $this->idusuario = "";
        $this->usnombre = "";
        $this->uspass = "";
        $this->usmail = "";
        $this->mensajeoperacion = "";
    }

    public function setear($idusuario, $usnombre, $uspass, $usmail)    {
        $this->setidusuario($idusuario);
        $this->setusnombre($usnombre);
        $this->setuspass($uspass);
        $this->setusmail($usmail);
    }
    // Metodo get y set ID
    public function getidusuario(){
        return $this->idusuario;
    }
    public function setidusuario($valor){
        $this->idusuario = $valor;
    }
    
    // Metodo get y set usnombre
    public function getusnombre(){
        return $this->usnombre;
    }
    public function setusnombre($valor){
        $this->usnombre = $valor;
    }
    
    // Metodo get y set uspass
    public function getuspass(){
        return $this->uspass;
    }
    public function setuspass($valor){
        $this->uspass = $valor;
    }
        
    // Metodo get y set usmail
    public function getusmail(){
        return $this->usmail;
    }
    public function setusmail($valor){
        $this->usmail = $valor;
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
        $sql = "SELECT * FROM usuario WHERE idusuario =" . $this->getidusuario();
        if($this ->Iniciar()){
            $res = $this->Ejecutar($sql);
            if($res > -1){
                $row = $this->Registro();
                $this->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usmail']);
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
        $sql  =  "INSERT INTO usuario (idusuario, usnombre, uspass, usmail, usdeshabilitado) VALUES (null, '"
        .$this->getusnombre()."', '"
        .$this->getuspass()."', '"
        .$this->getusmail()."', 
        'null');";
        if ($this->Iniciar()) {
            if($elid = $this->Ejecutar($sql)){
                $this->setidusuario($elid);
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
        usnombre = '".$this->getusnombre()."', 
        uspass = '".$this->getuspass()."', 
        usmail = '".$this->getusmail()."' WHERE idusuario = ".$this->getidusuario();
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
        $sql = "UPDATE usuario SET usdeshabilitado = '".date("Y-m-d h:i:sa")."' WHERE idusuario = ".$this->getidusuario();
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
                        if ($row['usdeshabilitado'] == '0000-00-00 00:00:00'){
                            $obj = new Usuario();
                            $obj->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usmail']);
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