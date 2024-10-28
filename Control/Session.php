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
        return $_SESSION['usnombre'];
    }
    public function setUsuario($usr){
        $_SESSION['usnombre'] = $usr;
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
        return $_SESSION['uspass'];
    }
    public function setPsw($valor){
        $_SESSION['uspass'] = $valor;
    }


    public function iniciar($usuario, $psw){
        $_SESSION['usnombre'] = $usuario;
        $_SESSION['uspass'] = $psw;
    }

    /**
     * Valida s i el usuario y el psw existen en la BDD
     */
    public function validar(){
        $resp = false;
        $param = array();
        $param['usnombre'] = $this->getUsuario();
        $param['uspass'] = $this->getPsw();
        $objAbmUsuario = new AbmUsuario;
        $objAbmUsuarioRol = new AbmUsuarioRol();

        $listaAbmUsuario = $objAbmUsuario->buscar($param);
        if (count($listaAbmUsuario) > 0){
           if ($listaAbmUsuario[0]->getusnombre() == $param['usnombre'] and $listaAbmUsuario[0]->getuspass() == $param['uspass']){
            /* $param['idusuario'] = $listaAbmUsuario[0]->getIdUsuario();
                $listaAbmUsuarioRol = $objAbmUsuarioRol->buscar($param);
                $this->setRol($listaAbmUsuarioRol[0]->getRol()->getDescripcion())*/
                $this->setRol('user');
                $resp = true;      
           }
        }
        return $resp;
    }

    public function cerrar(){
        $resp = false;
        // remove all session variables
        if(session_status() === PHP_SESSION_ACTIVE){
            session_unset();
            // destroy the session
            session_destroy();
            $resp = true;
        }
        return $resp;
    }

}
?>