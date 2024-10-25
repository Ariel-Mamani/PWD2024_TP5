<?php
class UsuarioRol extends BaseDatos{
    private $objUsuario; // Objeto de la clase Usuario
    private $objRol;     // Objeto de la clase Rol
    private $mensajeoperacion;

    public function __construct(){
        parent::__construct();
        $this->objUsuario = new Usuario();
        $this->objRol = new Rol();
        $this->mensajeoperacion = "";
    }

    public function setear($objUsuario, $objRol){
        $this->setUsuario($objUsuario);
        $this->setRol($objRol);
    }

    // Métodos Get y Set para el objeto Usuario
    public function getUsuario(){
        return $this->objUsuario;
    }

    public function setUsuario($objUsuario){
        $this->objUsuario = $objUsuario;
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

    //Método para buscar una relación usuario-rol
    public function cargar(){
        $exito = false;
        $sql = "SELECT * FROM usuariorol WHERE 
        idusuario = ".$this->getUsuario()->getIdUsuario()." AND 
        idrol = ".$this->getRol()->getIdRol();
        if($this->Iniciar()){
            $res = $this->Ejecutar($sql);
            if($res > -1){
                $row = $this->Registro();
                $objUsuario = new Usuario();
                $objUsuario->setIdUsuario($row['idusuario']);
                $objUsuario->cargar();
                $objRol = new Rol();
                $objRol->setIdRol($row['idrol']);
                $objRol->cargar(); 
                $this->setear($objUsuario, $objRol);
                $exito = true;             
            }else{
                $this->setMensajeoperacion("UsuarioRol->buscar: " . $this->getError());
            }
        }else{
            $this->setMensajeoperacion("UsuarioRol->buscar: " . $this->getError());
        }
        return $exito;
    }

    // Método para insertar una nueva relación usuario-rol
    public function insertar(){
        $resp = false;
        $sql = "INSERT INTO usuariorol(idusuario, idrol) VALUES(" 
        .$this->getUsuario()->getIdUsuario().", " 
        .$this->getRol()->getIdRol().")";
        if($this->Iniciar()) {
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeoperacion("UsuarioRol->insertar: " . $this->getError());
            }
        }else{
            $this->setMensajeoperacion("UsuarioRol->insertar: " . $this->getError());
        }
        return $resp;
    }


  /**
     * Summary of modificar
     * @return bool
     */
    public function modificar(){
        $resp = false;
        $sql = "UPDATE usuariorol SET 
        idusuario = '".$this->getUsuario()->getIdUsuario()."', 
        idrol = '".$this->getRol()->getIdRol()."', 
        WHERE idusuario = ".$this->getUsuario()->getIdUsuario()." idusuario = ".$this->getRol()->getIdRol();
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


    //Método para eliminar una relación usuario-rol
    public function eliminar(){
        $resp = false;
        $sql = "DELETE FROM usuariorol WHERE idusuario = " 
        . $this->getUsuario()->getIdUsuario() . " AND idrol = " 
        . $this->getRol()->getIdRol();
        if($this->Iniciar()){
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeoperacion("UsuarioRol->eliminar: " . $this->getError());
            }
        }else{
            $this->setMensajeoperacion("UsuarioRol->eliminar: " . $this->getError());
        }
        return $resp;
    }

    // Método para listar todas las relaciones usuario-rol
    public function listar($parametro = ""){
        $arreglo = array();
        $sql = "SELECT * FROM usuariorol ";
        if($parametro != ""){
            $sql .= " WHERE " . $parametro;
        }
        if($this->Iniciar()){
            if ($this->Ejecutar($sql)){
                while ($row = $this->Registro()){
                    $objUsuario = new Usuario();
                    $objUsuario->setIdUsuario($row['idusuario']);
                    $objUsuario->cargar();
                    $objRol = new Rol();
                    $objRol->setIdRol($row['idrol']);
                    $objRol->cargar();
                    $obj = new UsuarioRol();
                    $obj->setear($objUsuario, $objRol);
                    array_push($arreglo, $obj);
                }
            }else{
                self::setMensajeoperacion("UsuarioRol->listar: " . $this->getError());
            }
        }
        return $arreglo;
    }
}
?>
