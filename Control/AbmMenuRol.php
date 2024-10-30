<?php
class AbmMenuRol{
    //Espera como parametro un arreglo asociativo donde las claves coincidmenuen con los nombres de las variables instancias del objeto


    public function abm($datos){
        $resp = false;
        if($datos['accion']=='editar'){
            if($this->modificacion($datos)){
                $resp = true;
            }
        }
        if($datos['accion']=='borrar'){
            if($this->baja($datos)){
                $resp =true;
            }
        }
        if($datos['accion']=='nuevo'){
            if($this->alta($datos)){
                $resp =true;
            }
            
        }
        return $resp;

    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return MenuRol
     */
    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idmenu',$param) and array_key_exists('idrol',$param) ){
            $obj = new MenuRol();
            $objMenu = new Menu();
            $objMenu->setidmenu($param['idmenu']);
            $objMenu->cargar();
            $objRol = new Rol();
            $objRol->setidrol($param['idrol']);
            $objRol->cargar();
            $obj->setear($objMenu, $objRol);
        }
        return $obj;
    }
    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return MenuRol
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idmenu']) and isset($param['idrol']) ){
            $obj = new MenuRol();
            $objMenu = new Menu();
            $objMenu->setidmenu($param['idmenu']);
            $objMenu->cargar();
            $objRol = new Rol();
            $objRol->setidrol($param['idrol']);
            $objRol->cargar();
            $obj->setear($objMenu, $objRol);
        }
        return $obj;
    }
    
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idmenu']) and isset($param['idrol']))
            $resp = true;
        return $resp;
    }
    
    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $objMenuRol = $this->cargarObjeto($param);
        if ($objMenuRol!=null and $objMenuRol->insertar()){
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
            $objMenuRol = $this->cargarObjetoConClave($param);
            if ($objMenuRol!=null and $objMenuRol->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }
    
    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objMenuRol = $this->cargarObjeto($param);
            if($objMenuRol!=null and $objMenuRol->modificar()){
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
            if  (isset($param['idmenu']))
                $where.=" and idmenu =".$param['idmenu'];
            if  (isset($param['idrol']))
                 $where.=" and idrol ='".$param['idrol']."'";
        }
        $obj = new MenuRol();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }
    
}
?>