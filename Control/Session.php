<?php
class Session {

    public function __construct(){
        @session_start([
            'cookie_lifetime' => 400,
        ]);
    }
    /**
     * Summary of getUsuario
     * @return string
     */
    public function getUsuario(){
        return $_SESSION['usuario'];
    }
    public function setUsuario($usr){
        $_SESSION['usuario'] = $usr;
    }
        /**
     * Summary of getUsuario
     * @return string
     */
    public function getRol(){
        return $_SESSION['rol'];
    }
    public function setRol($usr){
        $_SESSION['rol'] = $usr;
    }
    /**
     * Summary of getPsw
     * @return string
     */
    public function getPsw(){
        return $_SESSION['psw'];
    }
    public function setPsw($valor){
        $_SESSION['psw'] = $valor;
    }


    public function iniciar($usuario, $psw){
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
        if (count($listaAbm) > 0){
            if($this->getUsuario() == $listaAbm[0]->getNombre() and $this->getPsw() == $listaAbm[0]->getPassword()){
                $resp = true;
            }
        }
            return $resp;
    }

    public function cerrar(){
        // remove all session variables
        session_unset();
        // destroy the session
        session_destroy();
    }

}
?>