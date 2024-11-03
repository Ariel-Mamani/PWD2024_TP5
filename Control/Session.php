<?php
class Session {

    public function __construct(){
        @session_start();
    }
    /**
     * Summary of getUsuario
     * @return Usuario
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
     * @return Rol
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
            if (isset($_SESSION['tiempo']) and (time() - $_SESSION['tiempo'] > 280)) {
                session_destroy();  //$this->cerrar();         
            }else {
                $_SESSION['tiempo']=time(); //Si hay actividad seteamos el valor al tiempo actual
                $resp = true;
            }
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
    
        
    public function validarRol(){
        $resp = false;
        $param['idrol'] = $this->getRol()->getidrol();
       // $cortar = strlen($VISTA);
        $enlace_actual = substr(strtolower('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']),35);
        $param['menuurl'] = $enlace_actual;
        $objAbmMenu = new AbmMenu();
        $listaMenu = $objAbmMenu->buscar($param);
        if(count($listaMenu) == 1){
            $param['idmenu'] = $listaMenu[0]->getidmenu();
            $objAbmMenuRol = new AbmMenuRol();
            $listaMenuRol = $objAbmMenuRol->buscar($param);
            if(count($listaMenuRol) > 0){
                $resp = true;
            }
        }
        return $resp;
    }
 


}
?>