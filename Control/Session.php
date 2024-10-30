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
        $listaAbmUsuario = $objAbmUsuario->buscar($_SESSION);
        return $listaAbmUsuario[0];
    }
    /**
     * Summary of getRol
     * @return string
     */
    public function getRol(){
        $objAbmRol = new AbmRol();
        $listaAbmRol = $objAbmRol->buscar($_SESSION);
        return $listaAbmRol[0];
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

        $listaAbmUsuario = $objAbmUsuario->buscar($param);
        if(count($listaAbmUsuario) > 0){
            if ($listaAbmUsuario[0]->getusnombre() == $param['usnombre'] and $listaAbmUsuario[0]->getuspass() == $param['uspass']){
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