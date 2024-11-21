<?php
include_once "../../../configuracion.php";
$data = data_submitted();


if (isset($data['idcompra'])){
    $objC = new AbmCompra();
    $respuesta = $objC->baja($data);
    if (!$respuesta){
        $mensaje = " La accion  ELIMINACION No pudo concretarse";
    }
}

$retorno['respuesta'] = $respuesta;
if (isset($mensaje)){
    $retorno['errorMsg']=$mensaje;
}
echo json_encode($retorno);

//EXPLICACION

//isset($data['idcompra']): Se verifica si el parámetro idcompra está presente en los datos enviados. Si está presente, se procede con la eliminación de la compra.
//new AbmCompra(): Se crea un objeto de la clase AbmCompra (ABM: Alta, Baja, Modificación)
//$respuesta = $objC->baja($data);: Llama al método baja() de la clase AbmCompra, pasándole los datos ($data) que incluyen el idcompra que se desea eliminar. El método baja() devuelve un valor booleano que indica si la operación de eliminación fue exitosa o no. Este valor se guarda en la variable $respuesta.
//Si la respuesta de la eliminación es false (es decir, si no se pudo eliminar la compra), se asigna un mensaje de error a la variable $mensaje.

// Preparación de la respuesta JSON
//Se crea un arreglo $retorno que se enviará como respuesta JSON.
//respuesta: Almacena el resultado de la operación (en este caso, el valor de $respuesta, que será true si la eliminación fue exitosa o false si no lo fue).
//Si hubo un error (isset($mensaje)), se agrega un mensaje de error al arreglo bajo la clave errorMsg.

//Envio de la respuesta
//echo json_encode($retorno);: Convierte el arreglo $retorno en una cadena JSON y la imprime, que será enviada como respuesta al cliente (generalmente una solicitud Ajax). Esto permite al cliente manejar la respuesta de manera adecuada.


//Flujo de funcionamiento
//El script recibe datos (por ejemplo, el idcompra a eliminar) mediante una solicitud HTTP.
//Si se proporciona un idcompra, se intenta eliminar esa compra utilizando el método baja() de la clase AbmCompra.
//Si la eliminación tiene éxito, la respuesta es un objeto JSON con { "respuesta": true }.
//Si ocurre un error, la respuesta es un objeto JSON con { "respuesta": false, "errorMsg": "La accion ELIMINACION No pudo concretarse" }.

//Posibles situaciones
//Éxito: Si la compra se elimina correctamente, el cliente recibirá { "respuesta": true }.
//Error: Si no se puede eliminar la compra, el cliente recibirá { "respuesta": false, "errorMsg": "La accion ELIMINACION No pudo concretarse" }.
?>