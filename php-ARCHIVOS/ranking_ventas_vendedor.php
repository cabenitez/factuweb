<?
if($fecha_desde){
	// incluye los scripts necesarios - obligatorios
	include('conexion.php');
	include ("class_jpgraph/jpgraph.php");
	include ("class_jpgraph/jpgraph_line.php");

	/****************************************************************************************/
	// Crea el grafico. estas dos llamadas son requeridas siempre - obligatorios
	$graph = new Graph(1240,400);     //Graph(ancho,alto,"auto");
	$graph->SetScale("textlin");			// formato de linea
	//$graph->SetColor( "green@0.4"); 		//color de fondo
	$graph->img->SetMargin(40,40,20,10);
	
	// Configura los margenes y las fuentes de titulo y subtitulo
	$graph-> title->SetFont(FF_FONT1 ,FS_BOLD);
	$graph-> subtitle->SetFont(FF_FONT2 ,FS_BOLD);
	$graph->SetMarginColor('white');
	$graph->SetScale("textlin");
	$graph->SetFrame(true);
	//$graph->title->Set('Ranking de Ventas por Vendedor');
	
	$graph->xaxis->title->Set("Fecha");
	$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
	$graph->yaxis->title->Set("Importe");
	$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
	
	//$graph->yaxis->HideZeroLabel(); // oculta el 0 en el eje Y
	$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
	$graph->xgrid->Show();
	/****************************************************************************************/
	
	$i=0;
	$colores = array('blue','orange','navy','red','green','brown','yellow','gray');			// array de vendedores a mostrar
	$tok = strtok ($vendedores,',');	// convierte la cadena de vendedores q viene a un array separado por comas y extrae todos los codigos de los vendedores
	
	while ($tok) {
		$importe_total = 0;
		$vendedor=$tok;
		$tok = strtok (",");

		// consulta donde obtiene los valores de las ventas de cada vendedor
		$consulta ="select  vendedor,  SUM(round(total_general,2)),fecha
						FROM(
									select  cod_vendedor as vendedor,factura_vta_no_cliente.fecha as fecha,
									
									$importe_no_cliente_total_general									
									
									from factura_vta_no_cliente inner join factura_vta_no_cliente_detalle  
									on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario
									where cod_vendedor = $vendedor and fecha >= $fecha_desde and fecha <= $fecha_hasta and observacion <> 'ANULADO' and observacion <> 'N/C' 
									
									GROUP BY cod_vendedor,fecha
								UNION
									select cod_vendedor as  vendedor,factura_vta.fecha as fecha,
									
									$importe_cliente_total_general									
									
									from factura_vta inner join factura_vta_detalle  
									on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario 
									where cod_vendedor = $vendedor and fecha >= $fecha_desde and fecha <= $fecha_hasta and observacion <> 'ANULADO' and observacion <> 'N/C' 
									
									GROUP BY cod_vendedor,fecha 
						) AS carga_caja GROUP BY fecha,vendedor ORDER BY fecha";
		
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$filas = mysql_num_rows ($result);           //indica la cantidad de resultados
		if($filas > 0){
			$importe_g = array();					// array de vendedores a mostrar
			$fecha_g = array();						// array de vendedores a mostrar
			
			do{ 	// obtengo los resultados 
					$vendedor=$registro[0];		
					$importe=$registro[1];
					$fecha=$registro[2];
					$importe_total = $importe_total + $importe;
					
				    $ano=substr($fecha,0,4);
				    $mes=substr($fecha,4,2);
				    $dia=substr($fecha,-2);
				    $fecha = $dia.'-'.$mes.'-'.$ano;
					
					// cargo las matrices
					$importe_g[] = $importe;
					$fecha_g[] = $fecha;
					$graph->xaxis->SetTickLabels($fecha_g);	
			}while($registro = mysql_fetch_array($result));
	
			// Crea las lineas
			$p[$i] = new LinePlot($importe_g);
			$p[$i]->SetColor($colores[$i]);
			
			// consulta para obtener el nombre del vendedor
			$consulta_v = "SELECT nombre FROM vendedor where cod_vendedor = $vendedor"; // consulta sql 
			$result_v = mysql_query($consulta_v);            // hace la consulta
			$registro_v = mysql_fetch_row($result_v);        // toma el registro
			$nombre_vendedor=$registro_v[0];
	
			$p[$i]->SetLegend($nombre_vendedor.' - Total: $'.$importe_total);
			
			// crea los valores en cada punto
			$p[$i]->value->show();
			$p[$i]->value->SetColor($colores[$i]);
			//$p[$i]->value->SetFont(FF_FONT1,FS_BOLD);
			$p[$i]->value->SetFormat('$%0.2f');
			
			$graph->Add($p[$i]);
		}
		$i++;
				
	}		
	if($filas > 0){
		// Muestra el grafico
		$graph->legend->SetShadow('gray@0.4',5);
	
		// Ajusta la posision de la leyenda
		$graph->legend->SetPos(0.1,0.1,'right','top');
		//$graph->legend->SetLayout(LEGEND_HOR);
		//$graph->legend->Pos(0.05,0.5,"right","center"); //( margen , altura , margen , altura)
		//$graph-> legend-> SetColumns(3);
	
	
		$graph->Stroke();
		//$graph-> Stroke( "c:/result2002.png"); 		// Descarga la imagen en un directorio
	}else{
		 
		
		echo "<div class='nota'><img src='../imagenes/advertencia.gif' width='16' height='16'> ERROR: No se han encotrado Ventas para este Vendedor </div>";
	}
}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_cliente.tpl');   //define la plantilla que utilizara

	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="estadisticas";
	$plantilla = "ranking_ventas_vendedor.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
}
?>
