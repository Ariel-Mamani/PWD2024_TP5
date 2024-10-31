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
        $obj = null;
        if ($this->validar()){
            $objAbmUsuario = new AbmUsuario();
            $listaUsuario = $objAbmUsuario->buscar($_SESSION);
            if ($listaUsuario >0){
                $obj = $listaUsuario[0];
            }
        }
        return $obj;
    }
    /**
     * Summary of getRol
     * @return string
     */
    public function getRol(){
        $objRol = null;
        if ($this->validar()){
            $objAbmUsuarioRol = new AbmUsuarioRol();
            $listaUsuarioRol = $objAbmUsuarioRol->buscar($_SESSION);
            if (count($listaUsuarioRol) > 0){
                $objRol = $listaUsuarioRol[0]->getRol();
            }
        }
        return $objRol;
    }

    public function validar(){
        $resp = false;
        if ($this->activa() and isset($_SESSION['idusuario'])){
            $resp = true;
        }
        return $resp;    
    }

    public function iniciar($usuario, $psw){
        $resp = false;
        $param['usnombre'] = $usuario;
        $param['uspass'] = $psw;
        $objAbmUsuario = new AbmUsuario;
        $listaUsuario = $objAbmUsuario->buscar($param);
        if(count($listaUsuario) > 0){
            $_SESSION['idusuario'] = $listaUsuario[0]->getidusuario();    
            $resp = true;
        }else {
            $this->cerrar();
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