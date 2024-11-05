<?php

/*
Este código permite realizar operaciones CRUD (Crear, Leer, Actualizar y Eliminar) sobre objetos de tipo Menu, encapsulando toda la lógica de interacción con la base de datos en una sola clase AbmMenu. Este enfoque organiza la lógica y facilita el mantenimiento del código.
*/

class AbmMenu{
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
     * Este método crea y carga un objeto Menu con los valores contenidos en $param.
     * Si existen en $param las claves idmenu, menunombre, y menuurl, crea un nuevo Menu, asignando esos valores mediante el método setear (presumiblemente del objeto Menu).
     * Retorna el objeto Menu si los parámetros están correctos; si no, retorna null.
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
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves.
     * Este método es similar a cargarObjeto, pero solo carga el objeto Menu con la clave idmenu (sin menunombre ni menuurl), lo cual es útil para identificar un menú sin cargar toda su información.
     * Retorna un objeto Menu si idmenu está definido en $param; si no, retorna null.
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
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves. Comprueba si el array $param contiene el campo clave idmenu.
     * Retorna true si idmenu está presente, indicando que se tiene el identificador del objeto Menu; si no, retorna false.
     * @param array $param
     * @return boolean $resp
     */
    protected function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idmenu']))
            $resp = true;
        return $resp;
    }


    /**
     * Realiza la creación de un nuevo Menu.
     * Establece el idmenu en null (usualmente un campo autoincremental en la base de datos).
     * Llama a cargarObjeto para crear el objeto Menu y, si se crea correctamente, llama a insertar (presumiblemente para guardarlo en la base de datos).
     * Retorna true si la inserción es exitosa, o false en caso contrario.
     * @param array $param
     * @return boolean $resp
     */
    public function alta($param){
        $resp = false;
        $param['idmenu'] = null;                    //Campo autoincremento
        $objMenu = $this->cargarObjeto($param);
        if ($objMenu != null and $objMenu->insertar()){
            $resp = true;
        }
        return $resp;
    }


    /**
     * permite eliminar un objeto.
     * Primero comprueba si están los campos clave (idmenu) usando seteadosCamposClaves.
     * Si están presentes, carga el objeto Menu con cargarObjetoConClave y luego llama a eliminar para borrarlo de la base de datos.
     * Retorna true si la eliminación es exitosa, o false en caso contrario.
     * @param array $param
     * @return boolean $resp
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objMenu = $this->cargarObjetoConClave($param);
            if ($objMenu != null and $objMenu->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * permite modificar un objeto menos la password.
     * Realiza la modificación de un Menu.
     * Comprueba si están los campos clave (idmenu) y luego carga el objeto completo con cargarObjeto.
     * Llama a modificar (que probablemente actualiza el registro en la base de datos).
     * Retorna true si la modificación es exitosa, o false en caso contrario.
     * @param array $param
     * @return boolean $resp
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $objMenu = $this->cargarObjeto($param);
            if($objMenu != null and $objMenu->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }


    /**
     * permite buscar un objeto.
     * Realiza una búsqueda de menús en la base de datos.
     * Construye una condición WHERE en SQL en función de los valores en $param (como idmenu, menunombre y menuurl).
     * Llama a listar en el objeto Menu, que devuelve una lista de menús que coinciden con los criterios.
     * Retorna un arreglo con los menús encontrados.
     * @param array $param
     * @return array $arreglo
     */
    public function buscar($param){
        $where = " true ";
        if ($param <> NULL){
            if (isset($param['idmenu']))
                $where .= " and idmenu = ".$param['idmenu'];
            if (isset($param['menunombre']))
                $where .= " and menunombre = '".$param['menunombre']."'";
            if (isset($param['menuurl']))
                $where .= " and menuurl = '".$param['menuurl']."'";    
        }
        $objMenu = new Menu();
        $arreglo = $objMenu->listar($where);
        return $arreglo;
    }


    /**
     * permite buscar una Menu por nombre parcial.
     * Similar a buscar, pero aquí la condición WHERE busca menús cuyo menunombre contenga una cadena parcial (LIKE '%$nombre%').
     * Retorna un arreglo con los menús que coinciden con el nombre parcial.
     * @param $nombre
     * @return array $arreglo
     */
    public function filtrarPorNombre($nombre){
        $where = " menunombre LIKE '%".$nombre."%'";   
        $objMenu = new Menu();
        $arreglo = $objMenu->listar($where);  
        return $arreglo;
    }
}
?>