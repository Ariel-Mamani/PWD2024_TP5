<?php

/*
La clase AbmMenuRol gestiona la relación entre un menú y un rol, permitiendo realizar operaciones de alta, baja, modificación y búsqueda sobre los objetos MenuRol, que representan la asociación entre el menú (Menu) y el rol (Rol) en una aplicación.

La clase AbmMenuRol ofrece una interfaz para gestionar la relación entre menús y roles. Con esta clase, es posible realizar las siguientes operaciones sobre objetos MenuRol:

Alta: Inserta un nuevo MenuRol en la base de datos.
Baja: Elimina un MenuRol existente.
Modificación: Modifica los detalles de un MenuRol.
Buscar: Realiza una búsqueda de MenuRol en la base de datos.
*/

class AbmMenuRol{
    //Espera como parametro un arreglo asociativo donde las claves coincidmenuen con los nombres de las variables instancias del objeto


    /**
     * Este método recibe un arreglo $datos con información para realizar una de las siguientes operaciones: editar, borrar o nuevo. Dependiendo de la acción indicada, llama a los métodos modificacion, baja o alta, respectivamente.
     * @return bool $resp
     */
    public function abm($datos){
        $resp = false;
        if($datos['accion'] == 'editar'){
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
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto.
     * Este método crea un objeto MenuRol utilizando los datos pasados en el arreglo $param, siempre que contenga idmenu e idrol. 
     * Primero, carga el objeto Menu y el objeto Rol correspondientes y luego configura el objeto MenuRol con estos datos.
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
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves.
     * Similar a cargarObjeto, pero este método se usa cuando el objeto MenuRol ya existe y se desea cargarlo utilizando las claves idmenu e idrol.
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
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves.
     * Verifica si los campos clave idmenu y idrol están definidos en $param. 
     * Retorna true si están presentes, false de lo contrario.
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
     * Crea un nuevo objeto MenuRol y lo inserta en la base de datos. 
     * Utiliza el método cargarObjeto para cargar los datos y luego llama al método insertar de MenuRol.
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $objMenuRol = $this->cargarObjeto($param);
        if ($objMenuRol != null and $objMenuRol->insertar()){
            $resp = true;
        }
        return $resp;
    }


    /**
     * permite eliminar un objeto.
     * Elimina un objeto MenuRol de la base de datos. 
     * Verifica que las claves estén seteadas y luego utiliza cargarObjetoConClave para obtener el objeto a eliminar.
     * @param array $param
     * @return boolean $resp
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objMenuRol = $this->cargarObjetoConClave($param);
            if ($objMenuRol != null and $objMenuRol->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * permite modificar un objeto.
     * Modifica un objeto MenuRol existente en la base de datos. 
     * Similar a baja, verifica las claves y carga el objeto a modificar, luego llama al método modificar.
     * @param array $param
     * @return boolean $resp
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objMenuRol = $this->cargarObjeto($param);
            if($objMenuRol != null and $objMenuRol->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * permite buscar un objeto.
     * Permite buscar objetos MenuRol en la base de datos basándose en las claves idmenu e idrol. 
     * Construye una consulta WHERE con los valores dados en $param.
     * @param array $param
     * @return array $arreglo
     */
    public function buscar($param){
        $where = " true ";
        if ($param <> NULL){
            if  (isset($param['idmenu']))
                $where .= " and idmenu =".$param['idmenu'];
            if  (isset($param['idrol']))
                $where .= " and idrol ='".$param['idrol']."'";
        }
        $obj = new MenuRol();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }
}
?>