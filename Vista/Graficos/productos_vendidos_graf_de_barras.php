<?php
$titulo = "TP 5 - Ver Gráfico de Productos Vendidos"; //Titulo en la pestaña

require_once "../../Control/abmProducto.php";
require_once "../../Modelo/Conector/BaseDatos.php";
require_once "../../Modelo/producto.php";
require_once "../../configuracion.php";
require_once ('../Librerias/jpGraph/jpgraph.php');
require_once ('../Librerias/jpGraph/jpgraph_bar.php'); //La libreria para gráficos de barras

$objAbmProducto = new AbmProducto(); //Instancia de la clase para manejar productos

//Obtener la cantidad de productos vendidos
$cantidadProductosVendidos = $objAbmProducto->contarProductosVendidos();

//Obtener los nombres de los productos vendidos
$labels = [];
$valores = [];

//Para esto debo asegurarme de que cada producto tenga un nombre y una cantidad
foreach ($cantidadProductosVendidos as $productoId => $cantidad) {
    //Con $productoId obtengo el nombre
    $producto = $objAbmProducto->obtenerProductoPorId($productoId);
    $labels[] = $producto['pronombre'];  //Agregar nombre del producto
    $valores[] = $cantidad;           //Agregar la cantidad vendida
}

//Verificar que hay datos para graficar
if (empty($cantidadProductosVendidos)) {
    die("No hay datos para mostrar en el gráfico.");
}

//Configurar el grafico de barras
$graph = new Graph(900, 600);
$graph->SetScale("textlin"); //Escala lineal para barras

//Titulo del gráfico
$graph->title->Set('Cantidad de Productos Vendidos');
$graph->title->SetFont(FF_VERDANA, FS_BOLD, 14);
$graph->title->SetColor('#1E90FF');
$graph->title->SetAlign('center');
$graph->title->SetMargin(15);

//Crear el grafico de barras
$barplot = new BarPlot($valores);
$barplot->SetFillColor('lightblue'); //Color de las barras
$barplot->SetLegend("Productos Vendidos");
$barplot->SetShadow('gray', 3); //Sombra de las barras

//Agregar el grafico de barras al grafico principal
$graph->Add($barplot);

//Configurar las etiquetas del eje X
$graph->xaxis->SetTickLabels($labels); //Nombres de los productos en el eje X
$graph->xaxis->SetLabelAngle(50); //Inclina las etiquetas si son largas

//Ruta donde se guardará la imagen
$ruta = "grafico.png";

//Eliminar el archivo si ya existe
if (file_exists($ruta)) {
    unlink($ruta);
}

//Mostrar el grafico
$graph->Stroke($ruta);  //Esto genera la imagen para mostrar

//Mensaje de verificacion
/*if (file_exists($ruta)) {
    echo "El gráfico se ha generado y guardado como 'grafico.png'.";
} else {
    echo "Hubo un problema al generar el gráfico.";
}*/

/*
$dir = 'grafico.png';
if (is_writable($dir)) {
    echo "El directorio es escribible.";
} else {
    echo "El directorio NO es escribible.";
}
*/
?>
