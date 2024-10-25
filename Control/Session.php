<?php
class Session {
    private $id;
    private $usuario;
    private $psw;
    private $rol;

    public function __construct(){
        session_start();
        $this->id = $_SESSION['id'];
        $this->usuario = "";
        $this->psw = "";
        $this->rol = "";
    }
    /**
     * Summary of getUsuario
     * @return string
     */
    public function getUsuario(){
        return $this->usuario;
    }
    public function setUsuario($usr){
        $this->usuario = $usr;
    }
    /**
     * Summary of getPsw
     * @return string
     */
    public function getPsw(){
        return $this->psw;
    }
    public function setPsw($valor){
        $this->psw = $valor;
    }
    public function iniciar($usuario, $psw){
        $this->usuario = $usuario;
        $this->psw = $psw;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['psw'] = $psw;
    }

    /**
     * Valida s i el usuario y el psw existen en la BDD
     */
    public function validar(){
        $resp = false;
        $param = array();
        $objAbmUsuario = new AbmUsuario;
        $param['usnombre'] = $this->getUsuario();
        $param['uspass'] = $this->getPsw();
        $listaAbm = $objAbmUsuario->buscar($param);

        if($this->getUsuario() == $listaAbm[0]->getNombre() and $this->getPsw() == $listaAbm[0]->getPassword()){
            $resp = true;
        }
        return $resp;
    }






}
?>