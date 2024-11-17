<?php
class AbmProducto{
    //Espera como parametro un arreglo asociativo donde las claves coincidProductoen con los nombres de las variables instancias del objeto

    
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
     * @return Producto
     */
    protected function cargarObjeto($param){
        $objProducto = null;
        
        if( array_key_exists('idProducto',$param) and 
            array_key_exists('pronombre',$param) and 
            array_key_exists('prodetalle',$param) and 
            array_key_exists('proprecio',$param) and 
            array_key_exists('procantstock',$param) and 
            array_key_exists('proimagen',$param)){
            $objProducto = new Producto();
            $objProducto->setear($param['idproducto'], $param['pronombre'], $param['prodetalle'], $param['proprecio'], $param['procantstock'], $param['proimagen']);
        }
        return $objProducto;
    }



    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Producto
     */
    protected function cargarObjetoConClave($param){
        $objProducto = null;
        
        if( isset($param['idProducto']) ){
            $objProducto = new Producto();
            $objProducto->setear($param['idProducto'], null, null, null, null, null);
        }
        return $objProducto;
    }


    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    protected function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idProducto']))
            $resp = true;
        return $resp;
    }


    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $param['idProducto'] = null;                             //Campo autoincremento
        $objProducto = $this->cargarObjeto($param);
        if ($objProducto != null and $objProducto->insertar()){
            $resp = true;
        }
        return $resp;
    }

    public function ingresarDatos($param){
        $resp = false;
        $param['idProducto']= null;
        $objProducto = new Producto();
        $objProducto-> setear($param['idProducto'],$param['pronombre'],$param['prodetalle'],$param['proprecio'],$param['procantstock'],$param['proimagen']);
        if($objProducto -> insertar()){
            $resp = true;
        }

        return $resp;
    }


    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
   /* public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objProducto = $this->cargarObjetoConClave($param);
            if ($objProducto != null and $objProducto->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }*/

    public function baja($idProducto){
        $objProducto = new Producto();
        $resp= false;
        $objProducto -> SetIdProducto($idProducto);
        $objProducto -> cargar();
        if($objProducto !=null && $objProducto -> eliminar()){
            $resp= true;
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
            $objProducto = $this->cargarObjeto($param);
            if($objProducto != null and $objProducto->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }

    public function modificarP ($param){
        $resp = false;
        $objProducto = new Producto();
        $objProducto -> setear($param['idproducto'],$param['pronombre'],$param['prodetalle'],$param['proprecio'],$param['procantstock'],$param['proimagen']);
        if($objProducto -> modificar()){
            $resp = true;
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
            if  (isset($param['idProducto']))
                $where.=" and idProducto =".$param['idProducto'];
            if  (isset($param['pronombre']))
                $where.=" and pronombre ='".$param['pronombre']."'";
            if  (isset($param['prodetalle']))
                $where.=" and prodetalle ='".$param['prodetalle']."'";
            if  (isset($param['proprecio']))
                $where.=" and proprecio ='".$param['proprecio']."'";    
            if  (isset($param['procantstock']))
                $where.=" and procantstock ='".$param['procantstock']."'";    
            if  (isset($param['proimagen']))
                $where.=" and proimagen ='".$param['proimagen']."'";    
        }
        $objProducto = new Producto();
        $arreglo = $objProducto->listar($where);
        return $arreglo;
    }



    public function buscarProducto($idProducto){
        $objProducto = new Producto();
        $productoEncontrado = null;
        if($objProducto -> buscar($idProducto)){
            $productoEncontrado = $objProducto;
        }

        return $productoEncontrado;
    }


    /**
     * permite buscar una Producto  por nombre parcial
     * @param $nombre
     * @return array
     */
    public function filtrarPorNombre($nombre){
        $where = " pronombre LIKE '%".$nombre."%'";   
        $objProducto = new Producto();
        $arreglo = $objProducto->listar($where);  
        return $arreglo;
    }
}
?>