<?php
class AbmMenu{
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
     * @return Menu
     */
    protected function cargarObjeto($param){
        $objMenu = null;
           
        if( array_key_exists('idmenu',$param) and 
            array_key_exists('menunombre',$param) and 
            array_key_exists('menuurl',$param)){
            $objMenu = new Menu();
            $objMenu->setear($param['idmenu'], $param['menunombre'],  $param['menuurl']);
        }
        return $objMenu;
    }

    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Menu
     */
    protected function cargarObjetoConClave($param){
        $objMenu = null;
        
        if( isset($param['idmenu']) ){
            $objMenu = new Menu();
            $objMenu->setear($param['idmenu'], null,  null);
        }
        return $objMenu;
    }
    
    
    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    protected function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idmenu']))
            $resp = true;
        return $resp;
    }
    
    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $param['idmenu'] = null;                             //Campo autoincremento
        $objMenu = $this->cargarObjeto($param);
        if ($objMenu!=null and $objMenu->insertar()){
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
            $objMenu = $this->cargarObjetoConClave($param);
            if ($objMenu!=null and $objMenu->eliminar()){
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
            $objMenu = $this->cargarObjeto($param);
            if($objMenu!=null and $objMenu->modificar()){
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
                $where.=" and idmenu = ".$param['idmenu'];
            if  (isset($param['menunombre']))
                 $where.=" and menunombre = '".$param['menunombre']."'";
            if  (isset($param['menuurl']))
                $where.=" and menuurl = '".$param['menuurl']."'";    
        }
        $objMenu = new Menu();
        $arreglo = $objMenu->listar($where);
        return $arreglo;
        
    }

    /**
     * permite buscar una Menu  por nombre parcial
     * @param $nombre
     * @return array
     */
    public function filtrarPorNombre($nombre){
        $where = " menunombre LIKE '%".$nombre."%'";   
        $objMenu = new Menu();
        $arreglo = $objMenu->listar($where);  
        return $arreglo;
    }
}
?>