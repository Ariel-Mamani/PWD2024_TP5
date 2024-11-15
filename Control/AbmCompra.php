<?php
class AbmCompra{
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
     * Este método crea y carga un objeto Compra con los valores contenidos en $param.
     * Si existen en $param las claves idcompra, Compranombre, y medescripcion, crea un nuevo Compra, asignando esos valores mediante el método setear (presumiblemente del objeto Compra).
     * Retorna el objeto Compra si los parámetros están correctos; si no, retorna null.
     * @param array $param
     * @return Compra
     */
    protected function cargarObjeto($param){
        $objCompra = null;
        
        if( array_key_exists('idcompra',$param) and 
            array_key_exists('cofecha',$param) and 
            array_key_exists('idusuario', $param) ){
                $objUsuario = new Usuario();
                $objUsuario->setidUsuario($param['idusuario']);
                $objUsuario->cargar();
                $objCompra = new Compra();
                $objCompra->setear($param['idcompra'], $param['cofecha'], $objUsuario );
        }
        return $objCompra;
    }


    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves.
     * Este método es similar a cargarObjeto, pero solo carga el objeto Compra con la clave idcompra (sin Compranombre ni medescripcion), lo cual es útil para identificar un menú sin cargar toda su información.
     * Retorna un objeto Compra si idcompra está definido en $param; si no, retorna null.
     * @param array $param
     * @return Compra
     */
    protected function cargarObjetoConClave($param){
        $objCompra = null;
        
        if( isset($param['idcompra']) ){
            $objCompra = new Compra();
            $objCompra->setear($param['idcompra'], null,  null);
        }
        return $objCompra;
    }


    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves. Comprueba si el array $param contiene el campo clave idcompra.
     * Retorna true si idcompra está presente, indicando que se tiene el identificador del objeto Compra; si no, retorna false.
     * @param array $param
     * @return boolean $resp
     */
    protected function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idcompra']))
            $resp = true;
        return $resp;
    }


    /**
     * Realiza la creación de un nuevo Compra.
     * Establece el idcompra en null (usualmente un campo autoincremental en la base de datos).
     * Llama a cargarObjeto para crear el objeto Compra y, si se crea correctamente, llama a insertar (presumiblemente para guardarlo en la base de datos).
     * Retorna true si la inserción es exitosa, o false en caso contrario.
     * @param array $param
     * @return boolean $resp
     */
    public function alta($param){
        $resp = false;
        $param['idcompra'] = null;                    //Campo autoincremento
        $objCompra = $this->cargarObjeto($param);
        if ($objCompra != null and $objCompra->insertar()){
            $resp = true;
        }
        return $resp;
    }


    /**
     * permite eliminar un objeto.
     * Primero comprueba si están los campos clave (idcompra) usando seteadosCamposClaves.
     * Si están presentes, carga el objeto Compra con cargarObjetoConClave y luego llama a eliminar para borrarlo de la base de datos.
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
     * Realiza la modificación de un Compra.
     * Comprueba si están los campos clave (idcompra) y luego carga el objeto completo con cargarObjeto.
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
     * Construye una condición WHERE en SQL en función de los valores en $param (como idcompra, Compranombre y medescripcion).
     * Llama a listar en el objeto Compra, que devuelve una lista de menús que coinciden con los criterios.
     * Retorna un arreglo con los menús encontrados.
     * @param array $param
     * @return array $arreglo
     */
    public function buscar($param){
        $where = " true ";
        if ($param <> NULL){
            if (isset($param['idcompra']))
                $where .= " and idcompra = ".$param['idcompra'];
            if (isset($param['cofecha']))
                $where .= " and cofecha = '".$param['cofecha']."'";
            if (isset($param['idusuario']))
                $where .= " and idusuario = '".$param['idusuario']."'";    
        }
        $objCompra = new Compra();
        $arreglo = $objCompra->listar($where);
        return $arreglo;
    }






/**
 * @param int
 * @return int
 */
    public function iniciar($idusuario){
        $idcompra = 0;

        return $idcompra;
    }

/**
 * @param int
 * @param int
 * @return bool
 */
    public function agregarProducto($idProducto, $idcompra){
        $resp = false;


        return $resp;
    }

/**
 * @param int
 * @param int
 * @return bool
 */
public function quitarProducto($idProducto, $idcompra){
    $resp = false;


    return $resp;
}

/**
 * @param int
 * @return bool
 */
public function finalizar($idcompra){
    $resp = false;


    return $resp;
}

/**
 * @param int
 * @return bool
 */
public function cancelarCompra($param){
    $resp = false;
    if ($this->seteadosCamposClaves($param)){
        $objUsuario = $this->cargarObjeto($param);
        if($objUsuario != null and $objUsuario->modificar()){
            $resp = true;
        }
    }

    return $resp;
}







}

?>