<?php
$titulo = "TP 5 - Ver Gráfico de Productos Vendidos"; // Título en la pestaña

require_once "../../Control/abmProducto.php";
require_once "../../Modelo/Conector/BaseDatos.php";
require_once "../../Modelo/producto.php";
require_once "../../configuracion.php";
require_once ('../Librerias/jpGraph/jpgraph.php');
require_once ('../Librerias/jpGraph/jpgraph_bar.php'); // La librería para gráficos de barras

$objAbmProducto = new AbmProducto(); // Instancia de la clase para manejar productos

// Obtener la cantidad de productos vendidos usando tu método modificado
$cantidadProductosVendidos = $objAbmProducto->contarProductosVendidos();

// Obtener los nombres de los productos vendidos
$labels = [];
$valores = [];

// Asegúrate de que cada producto tenga un nombre y una cantidad
foreach ($cantidadProductosVendidos as $productoId => $cantidad) {
    // Suponiendo que $productoId es el ID del producto, obtenemos el nombre
    $producto = $objAbmProducto->obtenerProductoPorId($productoId);
    $labels[] = $producto['pronombre'];  // Agregar nombre del producto
    $valores[] = $cantidad;           // Agregar la cantidad vendida
}

// Verificar que hay datos para graficar
if (empty($cantidadProductosVendidos)) {
    die("No hay datos para mostrar en el gráfico.");
}

// Configurar el gráfico de barras
$graph = new Graph(900, 600);
$graph->SetScale("textlin"); // Escala lineal para barras

// Título del gráfico
$graph->title->Set('Cantidad de Productos Vendidos');
$graph->title->SetFont(FF_VERDANA, FS_BOLD, 14);
$graph->title->SetColor('#1E90FF');
$graph->title->SetAlign('center');
$graph->title->SetMargin(15);

// Crear el gráfico de barras
$barplot = new BarPlot($valores);
$barplot->SetFillColor('lightblue'); // Color de las barras
$barplot->SetLegend("Productos Vendidos");
$barplot->SetShadow('gray', 3); // Sombra de las barras

// Agregar el gráfico de barras al gráfico principal
$graph->Add($barplot);

// Configurar las etiquetas del eje X
$graph->xaxis->SetTickLabels($labels); // Nombres de los productos en el eje X
$graph->xaxis->SetLabelAngle(50); // Inclina las etiquetas si son largas

// Ruta donde se guardará la imagen
$ruta = "g.png";

// Mostrar el gráfico
$graph->Stroke($ruta);  // Esto genera la imagen para mostrar


/*
$dir = 'grafico.png';
if (is_writable($dir)) {
    echo "El directorio es escribible.";
} else {
    echo "El directorio NO es escribible.";
}
*/
?>