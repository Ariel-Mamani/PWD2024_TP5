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
        $objAbmUsuario = new AbmUsuario();
        $listaUsuario = $objAbmUsuario->buscar($_SESSION);
        $obj = $listaUsuario[0];
        return $obj;
    }
    /**
     * Summary of getRol
     * @return string
     */
    public function getRol(){
        $objAbmRol = new AbmRol();
        $listaRol = $objAbmRol->buscar($_SESSION);
        $obj = $listaRol[0];
        return $obj;
    }
    public function setRol($idrol){
        $_SESSION['idrol'] = $idrol;
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
        $param['usnombre'] = $_SESSION['usnombre'];
        $param['uspass'] = $_SESSION['uspass'];
        $objAbmUsuario = new AbmUsuario;
        $objAbmUsuarioRol = new AbmUsuarioRol();

        $listaUsuario = $objAbmUsuario->buscar($param);
        if(count($listaUsuario) > 0){
            if ($listaUsuario[0]->getusnombre() == $param['usnombre'] and $listaUsuario[0]->getuspass() == $param['uspass']){
                $param['idusuario'] = $listaUsuario[0]->getidusuario();
                $listaUsuarioRol = $objAbmUsuarioRol->buscar($param);
                $this->setRol($listaUsuarioRol[0]->getRol()->getidrol());
           
                $resp = true;      
            }
        }
        return $resp;
    }

    public function cerrar(){
        $resp = false;
        if(session_status() === PHP_SESSION_ACTIVE){
            // remove all session variables
            session_unset();
            // destroy the session
            session_destroy();
            $resp = true;
        }
        return $resp;
    }
    /**
     * Verifica si la session está activa
     */
    public function activa(){
        $resp = false;
        if (session_status() === PHP_SESSION_ACTIVE){
            $resp = true;
        }
        return $resp;
    }
    /**
     *  Retorna mensaje dependiendo del boleano que entre por parametros
     */
    public function getMensaje($bool = null){
        // si no esta el === no funca XD
        if($bool === true){
            $_SESSION['mensaje'] = 'Se ha registrado exitosamente';
        }elseif($bool === false){
            $_SESSION['mensaje'] = 'Usted no está registrado, primero debe registrarse';
        }else{
            $_SESSION['mensaje'] = "El usuario o el email ya están registrados.";
        }
        return $_SESSION['mensaje'];
    }
    

}
?>