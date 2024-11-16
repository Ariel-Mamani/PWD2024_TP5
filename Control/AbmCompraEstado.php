<?php
class AbmCompraEstado{
    //Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto


    /**
     * Este método es una especie de "controlador" que ejecuta una acción (crear, editar o borrar) según el valor de la clave 'accion' en el array asociativo $datos.
     * Dependiendo de si $datos['accion'] es 'editar', 'borrar' o 'nuevo', llama a uno de los métodos modificacion, baja o alta.
     * Retorna true si la acción se ejecuta con éxito, o false en caso contrario.
     */
    public function abm($datos){
        $resp = false;
  /*      if($datos['accion'] == 'editar'){
            if($this->modificacion($datos)){
                $resp = true;
            }
        }
        if($datos['accion'] == 'borrar'){
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
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto.
     * Este método crea y carga un objeto CompraEstado con los valores contenidos en $param.
     * Si existen en $param las claves idcompraestado, CompraEstadonombre, y medescripcion, crea un nuevo CompraEstado, asignando esos valores mediante el método setear (presumiblemente del objeto CompraEstado).
     * Retorna el objeto CompraEstado si los parámetros están correctos; si no, retorna null.
     * @param array $param
     * @return CompraEstado
     */
    protected function cargarObjeto($param){
        $objCompraEstado = null;
        
        if( array_key_exists('idcompraestado',$param) and
            array_key_exists('idcompra',$param) and 
            array_key_exists('idcompraestadotipo',$param) and
            array_key_exists('cefechainit',$param) and 
            array_key_exists('cefechafin', $param) ){
                $objCompra = new Compra();
                $objCompra->setidCompra($param['idcompra']);
                $objCompra->cargar();
                $objCompraEstadoTipo = new CompraEstadoTipo();
                $objCompraEstadoTipo->setidcompraestadoTipo($param['idcompraestadotipo']);
                $objCompraEstadoTipo->cargar();
                $objCompraEstado = new CompraEstado();
                $objCompraEstado->setear($param['idcompraestado'], $objCompra, $objCompraEstadoTipo, $param['cefechainit'], $param['cefechafin'] );
        }
        return $objCompraEstado;
    }


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves.
     * Este método es similar a cargarObjeto, pero solo carga el objeto CompraEstado con la clave idcompraestado (sin CompraEstadonombre ni medescripcion), lo cual es útil para identificar un menú sin cargar toda su información.
     * Retorna un objeto CompraEstado si idcompraestado está definido en $param; si no, retorna null.
     * @param array $param
     * @return CompraEstado
     */
    protected function cargarObjetoConClave($param){
        $objCompraEstado = null;
        
        if( isset($param['idcompraestado']) ){
            $objCompraEstado = new CompraEstado();
            $objCompraEstado->setear($param['idcompraestado'], null,  null, null, null);
        }
        return $objCompraEstado;
    }


    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves. Comprueba si el array $param contiene el campo clave idcompraestado.
     * Retorna true si idcompraestado está presente, indicando que se tiene el identificador del objeto CompraEstado; si no, retorna false.
     * @param array $param
     * @return boolean $resp
     */
    protected function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idcompraestado']))
            $resp = true;
        return $resp;
    }


    /**
     * Realiza la creación de un nuevo CompraEstado.
     * Establece el idcompraestado en null (usualmente un campo autoincremental en la base de datos).
     * Llama a cargarObjeto para crear el objeto CompraEstado y, si se crea correctamente, llama a insertar (presumiblemente para guardarlo en la base de datos).
     * Retorna true si la inserción es exitosa, o false en caso contrario.
     * @param array $param
     * @return boolean $resp
     */
    public function alta($param){
        $resp = false;
        $param['idcompraestado'] = null;                    //Campo autoincremento
        $objCompraEstado = $this->cargarObjeto($param);
        if ($objCompraEstado != null and $objCompraEstado->insertar()){
            $resp = true;
        }
        return $resp;
    }


    /**
     * permite eliminar un objeto.
     * Primero comprueba si están los campos clave (idcompraestado) usando seteadosCamposClaves.
     * Si están presentes, carga el objeto CompraEstado con cargarObjetoConClave y luego llama a eliminar para borrarlo de la base de datos.
     * Retorna true si la eliminación es exitosa, o false en caso contrario.
     * @param array $param
     * @return boolean $resp
     */
/*    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objCompraEstado = $this->cargarObjetoConClave($param);
            if ($objCompraEstado != null and $objCompraEstado->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }
*/

    /**
     * permite modificar un objeto menos la password.
     * Realiza la modificación de un CompraEstado.
     * Comprueba si están los campos clave (idcompraestado) y luego carga el objeto completo con cargarObjeto.
     * Llama a modificar (que probablemente actualiza el registro en la base de datos).
     * Retorna true si la modificación es exitosa, o false en caso contrario.
     * @param array $param
     * @return boolean $resp
     */
  /*  public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objCompraEstado = $this->cargarObjeto($param);
            if($objCompraEstado != null and $objCompraEstado->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }*/


    /**
     * permite buscar un objeto.
     * Realiza una búsqueda de menús en la base de datos.
     * Construye una condición WHERE en SQL en función de los valores en $param (como idcompraestado, CompraEstadonombre y medescripcion).
     * Llama a listar en el objeto CompraEstado, que devuelve una lista de menús que coinciden con los criterios.
     * Retorna un arreglo con los menús encontrados.
     * @param array $param
     * @return array $arreglo
     */
    public function buscar($param){
        $where = " true ";
        if ($param <> NULL){
            if (isset($param['idcompraestado']))
                $where .= " and idcompraestado = ".$param['idcompraestado'];
            if (isset($param['idcompra']))
            $where .= " and idcompra = '".$param['idcompra']."'";   
            if (isset($param['idcompraestadotipo']))
            $where .= " and idcompraestadotipo = '".$param['idcompraestadotipo']."'";    
            if (isset($param['cefechainit']))
                $where .= " and cefechainit = '".$param['cefechainit']."'";
            if (isset($param['cefechafin']))
            $where .= " and cefechafin = '".$param['cefechafin']."'";
    }
        $objCompraEstado = new CompraEstado();
        $arreglo = $objCompraEstado->listar($where);
        return $arreglo;
    }





}

?>