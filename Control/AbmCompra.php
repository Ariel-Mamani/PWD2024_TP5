<?php
class AbmCompra{














    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    protected function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idcompra']))
            $resp = true;
        return $resp;
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
        $objUsuario = $this->cargarObjetoSinPass($param);
        if($objUsuario != null and $objUsuario->modificarSinPass()){
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
            if  (isset($param['idcompra']))
                $where.=" and idcompra =".$param['idcompra'];   
        }
        $objCompra = new Compra();
        $arreglo = $objCompra->listar($where);
        return $arreglo;
    }






}

?>