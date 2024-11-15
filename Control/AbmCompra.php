<?php
class AbmCompra{

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
public function cancelarCompra($idcompra){
    $resp = false;


    return $resp;
}

}

?>