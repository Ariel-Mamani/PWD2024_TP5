<?php
class UsuarioRol{
    private $objUsuario; // Objeto de la clase Usuario
    private $objRol;     // Objeto de la clase Rol
    private $mensajeoperacion;

    public function __construct(){
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
    public function buscar($idUsuario, $idRol){
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuariorol WHERE idusuario = " . $idUsuario . " AND idrol = " . $idRol;
        $exito = false;
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                if ($row = $base->Registro()) {
                    $this->objUsuario->buscar($row['idusuario']); // Busca el usuario por id
                    $this->objRol->buscar($row['idrol']);         // Busca el rol por id
                    $exito = true;
                }
            }else{
                $this->setMensajeoperacion("UsuarioRol->buscar: " . $base->getError());
            }
        }else{
            $this->setMensajeoperacion("UsuarioRol->buscar: " . $base->getError());
        }
        return $exito;
    }

    // Método para insertar una nueva relación usuario-rol
    public function insertar(){
        $base = new BaseDatos();
        $resp = false;
        $sql = "INSERT INTO usuariorol(idusuario, idrol) VALUES(" 
        . $this->objUsuario->getIdUsuario() . ", " 
        . $this->objRol->getIdRol() . ")";
        if($base->Iniciar()) {
            if($base->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeoperacion("UsuarioRol->insertar: " . $base->getError());
            }
        }else{
            $this->setMensajeoperacion("UsuarioRol->insertar: " . $base->getError());
        }
        return $resp;
    }

    //Método para eliminar una relación usuario-rol
    public function eliminar(){
        $base = new BaseDatos();
        $resp = false;
        $sql = "DELETE FROM usuariorol WHERE idusuario = " 
        . $this->objUsuario->getIdUsuario() . " AND idrol = " 
        . $this->objRol->getIdRol();
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeoperacion("UsuarioRol->eliminar: " . $base->getError());
            }
        }else{
            $this->setMensajeoperacion("UsuarioRol->eliminar: " . $base->getError());
        }
        return $resp;
    }

    // Método para listar todas las relaciones usuario-rol
    public static function listar($parametro = ""){
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM usuariorol ";
        if($parametro != ""){
            $sql .= " WHERE " . $parametro;
        }
        if($base->Iniciar()){
            if ($base->Ejecutar($sql)){
                while ($row = $base->Registro()){
                    $objUsuario = new Usuario();
                    $objUsuario->buscar($row['idusuario']);

                    $objRol = new Rol();
                    $objRol->buscar($row['idrol']);

                    $obj = new UsuarioRol();
                    $obj->setear($objUsuario, $objRol);
                    array_push($arreglo, $obj);
                }
            }else{
                self::setMensajeoperacion("UsuarioRol->listar: " . $base->getError());
            }
        }
        return $arreglo;
    }
}
?>
