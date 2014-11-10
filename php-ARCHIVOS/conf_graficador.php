<?
include ("class_jpgraph/jpgraph.php");
include ("class_jpgraph/jpgraph_line.php");

// Crea el grafico. estas dos llamadas son requeridas siempre - obligatorios
$graph = new Graph(700,500,"auto");     //Graph(ancho,alto,"auto");
$graph->SetScale("textlin");			// formato de linea
//$graph->SetColor( "green@0.4"); 		//color de fondo
			
// Configura los margenes y las fuentes de titulo y subtitulo
$graph-> title->SetFont(FF_FONT1 ,FS_BOLD);
$graph-> subtitle->SetFont(FF_FONT2 ,FS_BOLD);

$graph->title-> Set( $titulo);
$graph->subtitle-> Set( $subtitulo);

// crea la leyenda para cada eje
$graph->xaxis-> title->Set($leyenda_x );
$graph->yaxis-> title->Set($leyenda_y ); 

$graph->yaxis->SetColor ($color_eje_y); 		//eje "Y" pintado de...
$graph->yaxis->SetWeight($ancho_eje_y);			// le da un ancho de px al eje "Y"

$graph->xaxis->SetColor ($color_eje_x); 		//eje "X" pintado de...
$graph->xaxis->SetWeight($ancho_eje_x);			// le da un ancho de px al eje "X"

//$graph->SetShadow();					// crea el efecto sombra en el grafico




?>