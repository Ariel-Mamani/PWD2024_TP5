<?php

/*
Este código permite realizar operaciones CRUD (Crear, Leer, Actualizar y Eliminar) sobre objetos de tipo CompraItem, encapsulando toda la lógica de interacción con la base de datos en una sola clase AbmCompraItem. Este enfoque organiza la lógica y facilita el mantenimiento del código.
*/

class AbmCompraItem{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto


    /**
     * Este método es una especie de "controlador" que ejecuta una acción (crear, editar o borrar) según el valor de la clave 'accion' en el array asociativo $datos.
     * Dependiendo de si $datos['accion'] es 'editar', 'borrar' o 'nuevo', llama a uno de los métodos modificacion, baja o alta.
     * Retorna true si la acción se ejecuta con éxito, o false en caso contrario.
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
     * Este método crea y carga un objeto CompraItem con los valores contenidos en $param.
     * Si existen en $param las claves idcompraitem, CompraItemnombre, y cicantidad, crea un nuevo CompraItem, asignando esos valores mediante el método setear (presumiblemente del objeto CompraItem).
     * Retorna el objeto CompraItem si los parámetros están correctos; si no, retorna null.
     * @param array $param
     * @return CompraItem
     */
    protected function cargarObjeto($param){
        $objCompraItem = null;
        
        if( array_key_exists('idcompraitem',$param) and 
            array_key_exists('idproducto',$param) and 
            array_key_exists('idcompra', $param) and 
            array_key_exists('cicantidad',$param) ){
                $objCompra = new Compra();
                $objCompra->setIdCompra($param['idcompra']);
                $objCompra->cargar();
                $objProducto = new Producto();
                $objProducto->setIdProducto($param['idproducto']);
                $objProducto->cargar();                
                $objCompraItem = new CompraItem();
                $objCompraItem->setear($param['idcompraitem'], $objProducto,  $objCompra, $param['cicantidad'] );
        }
        return $objCompraItem;
    }


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves.
     * Este método es similar a cargarObjeto, pero solo carga el objeto CompraItem con la clave idcompraitem (sin CompraItemnombre ni cicantidad), lo cual es útil para identificar un menú sin cargar toda su información.
     * Retorna un objeto CompraItem si idcompraitem está definido en $param; si no, retorna null.
     * @param array $param
     * @return CompraItem
     */
    protected function cargarObjetoConClave($param){
        $objCompra = null;
        
        if( isset($param['idcompraitem']) ){
            $objCompra = new CompraItem();
            $objCompra->setear($param['idcompraitem'], null,  null, null);
        }
        return $objCompra;
    }


    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves. Comprueba si el array $param contiene el campo clave idcompraitem.
     * Retorna true si idcompraitem está presente, indicando que se tiene el identificador del objeto CompraItem; si no, retorna false.
     * @param array $param
     * @return boolean $resp
     */
    protected function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idcompraitem']))
            $resp = true;
        return $resp;
    }


    /**
     * Realiza la creación de un nuevo CompraItem.
     * Establece el idcompraitem en null (usualmente un campo autoincremental en la base de datos).
     * Llama a cargarObjeto para crear el objeto CompraItem y, si se crea correctamente, llama a insertar (presumiblemente para guardarlo en la base de datos).
     * Retorna true si la inserción es exitosa, o false en caso contrario.
     * @param array $param
     * @return boolean $resp
     */
    public function alta($param){
        $resp = false;
        $param['idcompraitem'] = null;                    //Campo autoincremento
        $objCompra = $this->cargarObjeto($param);
        if ($objCompra != null and $objCompra->insertar()){
            $resp = true;
        }
        return $resp;
    }


    /**
     * permite eliminar un objeto.
     * Primero comprueba si están los campos clave (idcompraitem) usando seteadosCamposClaves.
     * Si están presentes, carga el objeto CompraItem con cargarObjetoConClave y luego llama a eliminar para borrarlo de la base de datos.
     * Retorna true si la eliminación es exitosa, o false en caso contrario.
     * @param array $param
     * @return boolean $resp
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objCompra = $this->cargarObjetoConClave($param);
            if ($objCompra != null and $objCompra->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * permite modificar un objeto menos la password.
     * Realiza la modificación de un CompraItem.
     * Comprueba si están los campos clave (idcompraitem) y luego carga el objeto completo con cargarObjeto.
     * Llama a modificar (que probablemente actualiza el registro en la base de datos).
     * Retorna true si la modificación es exitosa, o false en caso contrario.
     * @param array $param
     * @return boolean $resp
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objCompra = $this->cargarObjeto($param);
            if($objCompra != null and $objCompra->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * permite buscar un objeto.
     * Realiza una búsqueda de menús en la base de datos.
     * Construye una condición WHERE en SQL en función de los valores en $param (como idcompraitem, CompraItemnombre y cicantidad).
     * Llama a listar en el objeto CompraItem, que devuelve una lista de menús que coinciden con los criterios.
     * Retorna un arreglo con los menús encontrados.
     * @param array $param
     * @return array $arreglo
     */
    public function buscar($param){
        $where = " true ";
        if ($param <> NULL){
            if (isset($param['idcompraitem']))
                $where .= " and idcompraitem = ".$param['idcompraitem'];
            if (isset($param['idproducto']))
                $where .= " and idproducto = '".$param['idproducto']."'";    
            if (isset($param['idcompra']))
                $where .= " and idcompra = '".$param['idcompra']."'";
        }
        $objCompra = new CompraItem();
        $arreglo = $objCompra->listar($where);
        return $arreglo;
    }

}
?>