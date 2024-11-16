<?php
class AbmRol{
    //Espera como parametro un arreglo asociativo donde las claves coincidrolen con los nombres de las variables instancias del objeto

    
    public function abm($datos){
        $resp = false;
        if($datos['accion'] == 'editar'){
            if($this->modificacion($datos)){
                $resp = true;
            }
        }
     /*   if($datos['accion'] == 'borrar'){
            if($this->baja($datos)){
                $resp = true;
            }
        }*/
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
     * @return Rol
     */
    private function cargarObjeto($param){
        $objRol = null;
        
        if( array_key_exists('idrol',$param) and array_key_exists('roldescripcion',$param)){
            $objRol = new Rol();
            $objRol->setear($param['idrol'], $param['roldescripcion']);
        }
        return $objRol;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Rol
     */
    private function cargarObjetoConClave($param){
        $objRol = null;
        
        if( isset($param['idrol']) ){
            $objRol = new Rol();
            $objRol->setear($param['idrol'], null);
        }
        return $objRol;
    }
    
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idrol']))
            $resp = true;
        return $resp;
    }
    
    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $param['idrol'] = null;                             //Campo autoincremento
        $objRol = $this->cargarObjeto($param);
        if ($objRol != null and $objRol->insertar()){
            $resp = true;
        }
        return $resp;
        
    }
    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
/*    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objRol = $this->cargarObjetoConClave($param);
            if ($objRol != null and $objRol->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }*/
    
    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objRol = $this->cargarObjeto($param);
            if($objRol != null and $objRol->modificar()){
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
        if ($param<>NULL){
            if  (isset($param['idrol']))
                $where .= " and idrol =".$param['idrol'];
            if  (isset($param['roldescripcion']))
                $where .= " and roldescripcion ='".$param['roldescripcion']."'";
        }
        $objRol = new Rol();
        $arreglo = $objRol->listar($where);
        return $arreglo;
    }


    /**
     * permite buscar una Rol  por nombre parcial
     * @param $nombre
     * @return array
     */
    public function filtrarPorNombre($nombre){
        $where = " roldescripcion LIKE '%".$nombre."%'";   
        $objRol = new Rol();
        $arreglo = $objRol->listar($where);  
        return $arreglo;
    }
}
?>