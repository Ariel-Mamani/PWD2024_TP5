<?php
//include_once "../Modelo/CompraEstadoTipo.php";
class AbmCompraEstadoTipo{
    //Espera como parametro un arreglo asociativo donde las claves coincidcompraestadotipoen con los nombres de las variables instancias del objeto

    
    public function abm($datos){
        $resp = false;
        if($datos['accion'] == 'editar'){
            if($this->modificacion($datos)){
                $resp = true;
            }
        }
        if($datos['accion'] == 'editarPass'){
            if($this->modificacion($datos)){
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
     * @return CompraEstadoTipo
     */
    protected function cargarObjeto($param){
        $objcompraEstadoTipo = null;
        
        if( array_key_exists('idcompraestadotipo',$param) and 
            array_key_exists('cetdescripcion',$param) and 
            array_key_exists('cetdetalle',$param)){
            $objcompraEstadoTipo = new compraEstadoTipo();
            $objcompraEstadoTipo->setear($param['idcompraestadotipo'], $param['cetdescripcion'], $param['cetdetalle']);
        }
        return $objcompraEstadoTipo;
    }



    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return compraEstadoTipo
     */
    protected function cargarObjetoConClave($param){
        $objcompraEstadoTipo = null;
        
        if( isset($param['idcompraestadotipo']) ){
            $objcompraEstadoTipo = new compraEstadoTipo();
            $objcompraEstadoTipo->setear($param['idcompraestadotipo'], null, null);
        }
        return $objcompraEstadoTipo;
    }


    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    protected function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idcompraestadotipo']))
            $resp = true;
        return $resp;
    }


    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $param['idcompraestadotipo'] = null;                             //Campo autoincremento
        $objcompraEstadoTipo = $this->cargarObjeto($param);
        if ($objcompraEstadoTipo != null and $objcompraEstadoTipo->insertar()){
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
            $objcompraEstadoTipo = $this->cargarObjetoConClave($param);
            if ($objcompraEstadoTipo != null and $objcompraEstadoTipo->eliminar()){
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
            $objcompraEstadoTipo = $this->cargarObjeto($param);
            if($objcompraEstadoTipo != null and $objcompraEstadoTipo->modificar()){
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
            if  (isset($param['idcompraestadotipo']))
                $where.=" and idcompraestadotipo =".$param['idcompraestadotipo'];
            if  (isset($param['cetdescripcion']))
                $where.=" and cetdescripcion ='".$param['cetdescripcion']."'";
            if  (isset($param['cetdetalle']))
                $where.=" and cetdetalle ='".$param['cetdetalle']."'";
        }
        $objcompraEstadoTipo = new CompraEstadoTipo(); 
        $arreglo = $objcompraEstadoTipo->listar($where);
        return $arreglo;
    }

}
?>