<?php
include_once "../../Estructura/header.php.php";
$data = data_submitted();

$arreglo_salida =  array();
if (isset($data['idcompra'])){
    $objAbmCompraItem = new AbmCompraItem();
    $listaCompraItem = $objAbmCompraItem->buscar($data);
    if(count($listaCompraItem) > 0){
        foreach ($listaCompraItem as $objCompraItem ){
            $arrCompraItem["idcompraitem"]  = $objCompraItem->getIdCompraItem();
            $arrCompraItem["idproducto"]    = $objCompraItem->getProducto()->getIdProducto();
            $arrCompraItem['idcompra']      = $objCompraItem->getIdCompra();
            $arrCompraItem["cicantidad"]    = $objCompraItem->getCiCantidad();
            array_push($arreglo_salida,$arrCompraItem);
        } 
    }     
}
echo json_encode($arreglo_salida);


//data_submitted(): Esta función obtiene los datos enviados al script

//Inicialización de un arreglo para la salida ($arreglo_salida = array();): Se crea un arreglo vacío llamado $arreglo_salida que se llenará con los datos que se van a devolver en formato JSON.

//Verificación de la existencia de idcompra en los datos recibidos (isset($data['idcompra'])): Se verifica si el parámetro idcompra fue enviado en la solicitud. Si no se encuentra, el script no hace nada, y simplemente no rellena el arreglo de salida.

//Obtención de los items de la compra ($objAbmCompraItem->buscar($data);)
//Se crea un objeto de la clase AbmCompraItem, que se encarga de la gestión de los items de compra (ABM: Alta, Baja, Modificación).
//Se llama al método buscar($data) de la clase AbmCompraItem para obtener los items de la compra. Este método probablemente realiza una consulta a la base de datos utilizando el idcompra proporcionado en $data.
//El método buscar() devuelve una lista de objetos de tipo CompraItem, que representa los items asociados a la compra.

//Verificación de los resultados obtenidos
//if(count($listaCompraItem) > 0): Si se obtuvieron items de compra (es decir, si la lista no está vacía), el script procede a procesarlos.
//Se recorre la lista de items ($listaCompraItem) y para cada objeto CompraItem:
//Se obtiene el idcompraitem del objeto mediante el método getIdCompraItem().
//Se obtiene el idproducto del objeto Producto relacionado con el item mediante el método getProducto()->getIdProducto().
//Se obtiene el idcompra y la cantidad de unidades del item mediante los métodos getIdCompra() y getCiCantidad().
//Se almacena esta información en un arreglo asociativo ($arrCompraItem)//

//Agregando los datos al arreglo de salida
//Cada arreglo $arrCompraItem que contiene los datos del item de compra se agrega al arreglo principal $arreglo_salida mediante la función array_push()

//Devolución de los datos en formato JSON
//Finalmente, el arreglo $arreglo_salida (que contiene los datos de los items de la compra) se convierte en una cadena JSON con la función json_encode($arreglo_salida), y se imprime como la respuesta del script.
//echo json_encode($arreglo_salida);: Esto devuelve los datos en formato JSON, que probablemente serán procesados en el frontend (por ejemplo, por medio de una solicitud AJAX).

//Resumen del flujo:
//El script recibe datos (principalmente el idcompra).
//Si se recibe un idcompra, busca los items de esa compra mediante la clase AbmCompraItem y su método buscar().
//Para cada item de compra, extrae información relevante como el idcompraitem, idproducto, idcompra, y la cicantidad.
//Esta información se organiza en un arreglo y se convierte en JSON.
//Finalmente, se devuelve el JSON con los datos al cliente.

//

//

//





/*
if (isset($data['idcompra'])){
    $objC = new AbmCompra();
    $respuesta = $objC->modificacion($data);
    
    if (!$respuesta){

        $sms_error = " La accion  MODIFICACION No pudo concretarse";
        
    }else $respuesta =true;
    
}
$retorno['respuesta'] = $respuesta;
if (isset($mensaje)){
    
    $retorno['errorMsg']=$sms_error;
    
}
echo json_encode($retorno);*/
?>