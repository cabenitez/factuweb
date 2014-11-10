<?

include('conexion.php');
$consulta = "select stock_actual, stock_max  from producto top5"; 	// consulta sql
$result = mysql_query($consulta);            						// hace la consulta
$registro = mysql_fetch_row($result);        						// toma el registro

$ydata = array();
$xdata = array();
while($registro = mysql_fetch_array($result)){ 	// obtengo los resultados 
	$stock_actual=$registro[0];		
	$cantidad=$registro[1];
	$ydata[] = $stock_actual;
	$xdata[] = $cantidad;	
}

//__________________________________________________________________________________________________________________________//
//____________NOTA: para que funcione se debe copiar todos los archivos que estan es este directorio________________________//
//__________________________________________________________________________________________________________________________//

// incluye los scripts necesarios - obligatorios
include ("class_jpgraph/jpgraph.php");
include ("class_jpgraph/jpgraph_line.php");

// crea un array de prueba * si tenemos mas de una linea no es necesario que contengan la misma cantidad de puntos
//$ydata = array(11,3,8,12,5,1,9,13,5,7,4);
//$xdata = array(1,13,8,2,15,11,1,3,15,17,2);

// Crea el grafico. estas dos llamadas son requeridas siempre - obligatorios
$graph = new Graph(700,500,"auto");     //Graph(ancho,alto,"auto");
$graph->SetScale("textlin");			// formato de linea
//$graph->SetColor( "green@0.4"); 		//color de fondo

// Configura los margenes, los titulos X e Y y las fuentes de titulo
$graph->img-> SetMargin(40,20 ,20,40); 		//margenes
$asd= "Titulssso";
$graph->title-> Set( $asd);
$graph-> title->SetFont(FF_FONT1 ,FS_BOLD);

$graph->subtitle-> Set( "Subtitulo");
$graph-> subtitle->SetFont(FF_FONT2 ,FS_BOLD);

$graph->yaxis-> title->SetFont(FF_FONT1 ,FS_BOLD);
$graph->xaxis-> title->SetFont(FF_FONT1 ,FS_BOLD);



// crea la leyenda para cada eje
$graph->xaxis-> title->Set("eje X" );
$graph->yaxis-> title->Set("eje Y" ); 

$graph->yaxis->SetColor ("red"); 		//eje "Y" pintado de rojo
$graph->yaxis->SetWeight(2);			// le da un ancho de 2px al eje "Y"
$graph->SetShadow();					// crea el efecto sombra en el grafico

// Crea la linea AZUL
$lineplot=new LinePlot($ydata);
$lineplot->SetColor("blue"); 				// color de la linea
$lineplot ->SetWeight(1);   				// pixeles de ancho


// Crea la linea roja
$lineplot2=new LinePlot($xdata);
$lineplot2->SetColor("orange");
//$lineplot2-> mark->SetType(MARK_UTRIANGLE ); // icono triangulo en cada valor
//---------------//
$lineplot2->value-> Show();  					// muestra los valores
$lineplot2->value ->SetColor("darkred");		// muestra los valores resaltado
$lineplot2 ->value->SetFont( FF_FONT1, FS_BOLD);// establece una fuente
$lineplot2 ->value->SetFormat( "$ %0.1f");		// antecede el signo $ a cada valor


// Crea la leyenda
$lineplot->SetLegend("Linea AZUL");
$lineplot2->SetLegend("linea NARANJA");

// Ajusta la posision de la leyenda
//$graph->legend->SetLayout(LEGEND_HOR);
$graph->legend->Pos(0.05,0.5,"right","center"); //( margen , altura , margen , altura)
//$graph-> legend-> SetColumns(3);









// Agrega el dibujo al grafico
$graph->Add($lineplot);
$graph->Add($lineplot2);

// Muestra el grafico
$graph->Stroke();
//$graph-> Stroke( "c:/result2002.png"); 		// Descarga la imagen en un directorio

?>