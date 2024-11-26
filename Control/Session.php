<?php

/*
La clase Session administra y verifica las sesiones de usuario, incluyendo su autenticación, roles, y el estado de actividad de la sesión.
*/

class Session {

    //Inicia la sesión usando session_start(), permitiendo que se almacenen y accedan variables de sesión durante la ejecución.
    public function __construct(){
        @session_start();
    }

    /**
     * Summary of getUsuario
     * Obtiene el objeto Usuario actual de la sesión, si el usuario está validado. 
     * Usa AbmUsuario para buscar al usuario en la base de datos.
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
     * Summary of getRol.
     * Obtiene el rol del usuario si la sesión es válida. 
     * Utiliza AbmUsuarioRol para obtener la relación entre el usuario y el rol, devolviendo el primer rol de la lista asociada.
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

    /**
     * Summary of getCompra
     * Obtiene el objeto Compra actual de la sesión, si el usuario está validado. 
     * 
     * @return Compra
     */
    public function getCompra(){
        $obj = null;
        if ($this->validar()){
            $objAbmCompra = new AbmCompra();
            $listaCompra = $objAbmCompra->buscar($_SESSION);
            if ($listaCompra >0){
                $obj = $listaCompra[0];
            }
        }
        return $obj;
    }


    /**
     * Verifica si la sesión está activa y si el usuario tiene un idusuario definido en la sesión. 
     * También verifica si el tiempo de inactividad ha excedido los 280 segundos; si es así, cierra la sesión.
     * @return bool $resp
     */
    public function validar(){
        $resp = false;
        if ($this->activa() and isset($_SESSION['idusuario'])){
            if (isset($_SESSION['tiempo']) and (time() - $_SESSION['tiempo'] > 3600)) {
                session_destroy();  //$this->cerrar();         
            }else {
                $_SESSION['tiempo']=time(); //Si hay actividad seteamos el valor al tiempo actual
                $resp = true;
            }
        }
        return $resp;    
    }

    /**
     * Inicia la sesión para un usuario si el nombre de usuario y la contraseña son válidos. 
     * Utiliza AbmUsuario para buscar el usuario, y si lo encuentra, almacena el idusuario en la sesión.
     * @return bool $resp
     */
    public function iniciar($usuario, $psw){
        $resp = false;
        //if($this->cerrar());
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

    /**
     * Cierra la sesión destruyendo las variables y la sesión misma.
     * @return bool $resp
     */
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
     * Verifica si la session está activa.
     * Verifica si la sesión está activa retornando true si session_status está en PHP_SESSION_ACTIVE.
     * @return bool $resp
     */
    public function activa(){
        $resp = false;
        if (session_status() === PHP_SESSION_ACTIVE){
            $resp = true;
        }
        return $resp;
    }

    /**
     *  Retorna mensaje dependiendo del boleano que entre por parametros.
     * Este método permite establecer mensajes de sesión basados en el parámetro $bool, que indica si el registro fue exitoso o fallido. 
     * El mensaje queda almacenado en la variable de sesión mensaje.
     */
    public function getMensaje($bool = null){
        if($bool === true){
            $_SESSION['mensaje'] = 'Se ha registrado exitosamente';
        } elseif($bool === false){
            $_SESSION['mensaje'] = 'Usted no está registrado, primero debe registrarse';
        } else {
            $_SESSION['mensaje'] = "El usuario o el email ya están registrados.";
        }
        session_write_close();
        return $_SESSION['mensaje'];
    }

    /**
     * Verifica si el usuario tiene permiso para acceder a una URL específica basada en su rol. 
     * Primero obtiene el rol del usuario actual y luego verifica si el rol tiene acceso a la URL actual.
     * @return bool $resp
     */
    public function validarRol($cortar){
        $resp = false;
        $param['idrol'] = $this->getRol()->getidrol();
        $enlace_actual = substr(strtolower('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']), $cortar);
        $param['medescripcion'] = $enlace_actual;
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
/************************************************************************************************ */
//          Compras                 
/************************************************************************************************ */

/**
 * Toma el idusuario de la session activa y cargael idcompra en la sesion
 * @return bool
 */
public function iniciarCompra(){
    $resp = false;
    $objAbmCompra = new AbmCompra();
    $datos = $objAbmCompra->buscarCompra();
    if(isset($datos['idcompra'])){
        $resp = true;
        $_SESSION['idcompra'] = $datos['idcompra'];
    }else{
        $param['idusuario'] = $this->getUsuario()->getidusuario();
        $param['cofecha'] = date("Y-m-d h:i:sa");
        $objAbmCompra = new AbmCompra();
        if($param['idcompra'] = $objAbmCompra->alta($param)){ 
            $objAbmCompraEstado = new AbmCompraEstado();
            $param['idcompraestadotipo'] = 1; // estado ingresada = 1
            $param['cefechainit'] = $param['cofecha'] ;
            $param['cefechafin'] = null;
            if($objAbmCompraEstado->alta($param)){
                $resp = true;
                $_SESSION['idcompra'] = $param['idcompra'];
            }
        }
    }
    return $resp;
}
    /**
     * Verifica si la sesión está activa y si el usuario tiene un idusuario definido en la sesión. 
     * También verifica si el tiempo de inactividad ha excedido los 280 segundos; si es así, cierra la sesión.
     * @return bool $resp
     */
    public function validarCompra(){
        $resp = false;
        if ($this->activa() and isset($_SESSION['idusuario']) and isset($_SESSION['idcompra'])){
                $resp = true;
        }
        return $resp;    
    }
        /**
     * Cierra la sesión destruyendo las variables y la sesión misma.
     * @return bool $resp
     */
    public function cerrarCompra(){
        $resp = false;
        if($this->validarCompra()){
            unset($_SESSION['idcompra']);
            $resp = true;
        }
        return $resp;
    }

}
?>