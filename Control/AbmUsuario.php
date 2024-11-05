<?php
class AbmUsuario{
    //Espera como parametro un arreglo asociativo donde las claves coincidusuarioen con los nombres de las variables instancias del objeto

    
    public function abm($datos){
        $resp = false;
        if($datos['accion'] == 'editar'){
            if($this->modificacion($datos)){
                $resp = true;
            }
        }
        if($datos['accion'] == 'editarPass'){
            if($this->modificacionPass($datos)){
                $resp = true;
            }
        }
        if($datos['accion'] == 'borrar'){
            if($this->baja($datos)){
                $resp = true;
            }
        }
        if($datos['accion'] == 'nuevo'){
            if($this->alta($datos)){
                $resp = true;
            }
            
        }
        return $resp;

    }
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Usuario
     */
    protected function cargarObjeto($param){
        $objUsuario = null;
        
        if( array_key_exists('idusuario',$param) and 
            array_key_exists('usnombre',$param) and 
            array_key_exists('uspass',$param) and 
            array_key_exists('usmail',$param)){
            $objUsuario = new Usuario();
            $objUsuario->setear($param['idusuario'], $param['usnombre'], $param['uspass'], $param['usmail']);
        }
        return $objUsuario;
    }


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * Sin el campo uspass
     * @param array $param
     * @return Usuario
     */
    protected function cargarObjetoSinPass($param){
        $objUsuario = null;
        
        if( array_key_exists('idusuario',$param) and 
            array_key_exists('usnombre',$param) and 
            array_key_exists('usmail',$param)){
            $objUsuario = new Usuario();
            $objUsuario->setear($param['idusuario'], $param['usnombre'], null, $param['usmail']);
        }
        return $objUsuario;
    }


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Usuario
     */
    protected function cargarObjetoPass($param){
        $objUsuario = null;
        
        if( array_key_exists('idusuario',$param) and 
            array_key_exists('uspass',$param)){
            $objUsuario = new Usuario();
            $objUsuario->setear($param['idusuario'], null, $param['uspass'], null);
        }
        return $objUsuario;
    }


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Usuario
     */
    protected function cargarObjetoConClave($param){
        $objUsuario = null;
        
        if( isset($param['idusuario']) ){
            $objUsuario = new Usuario();
            $objUsuario->setear($param['idusuario'], null, null, null);
        }
        return $objUsuario;
    }


    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    protected function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idusuario']))
            $resp = true;
        return $resp;
    }


    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $param['idusuario'] = null;                             //Campo autoincremento
        $objUsuario = $this->cargarObjeto($param);
        if ($objUsuario != null and $objUsuario->insertar()){
            $resp = true;
        }
        return $resp;
    }


    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objUsuario = $this->cargarObjetoConClave($param);
            if ($objUsuario != null and $objUsuario->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * permite modificar un objeto menos la password
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objUsuario = $this->cargarObjetoSinPass($param);
            if($objUsuario != null and $objUsuario->modificarSinPass()){
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * permite modificar la password
     * @param array $param
     * @return boolean
     */
    public function modificacionPass($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objUsuario = $this->cargarObjetoPass($param);
            if($objUsuario != null and $objUsuario->modificarPass()){
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param){
        $where = " true ";
        if ($param <> NULL){
            if  (isset($param['idusuario']))
                $where.=" and idusuario =".$param['idusuario'];
            if  (isset($param['usnombre']))
                $where.=" and usnombre ='".$param['usnombre']."'";
                if  (isset($param['uspass']))
                $where.=" and uspass ='".$param['uspass']."'";
            if  (isset($param['usmail']))
                $where.=" and usmail ='".$param['usmail']."'";    
        }
        $objUsuario = new Usuario();
        $arreglo = $objUsuario->listar($where);
        return $arreglo;
    }


    /**
     * permite buscar una Usuario  por nombre parcial
     * @param $nombre
     * @return array
     */
    public function filtrarPorNombre($nombre){
        $where = " usnombre LIKE '%".$nombre."%'";   
        $objUsuario = new Usuario();
        $arreglo = $objUsuario->listar($where);  
        return $arreglo;
    }
}
?>