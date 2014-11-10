<?
if($fecha_desde){
	// incluye los scripts necesarios - obligatorios
	include('conexion.php');
	include ("class_jpgraph/jpgraph.php");
	include ("class_jpgraph/jpgraph_pie.php");
	include ("class_jpgraph/jpgraph_pie3d.php");

	/****************************************************************************************/
	// Crea el grafico. estas dos llamadas son requeridas siempre - obligatorios
	$graph = new PieGraph(1240,400);     	//PieGraph(ancho,alto,"auto");
	$graph->SetScale("textlin");			// formato de linea
	//$graph->SetColor( "green@0.4"); 		//color de fondo
	$graph->img->SetMargin(40,40,20,10);
	
	// Configura los margenes y las fuentes de titulo y subtitulo
	$graph-> title->SetFont(FF_FONT1 ,FS_BOLD);
	//$graph-> subtitle->SetFont(FF_FONT2 ,FS_BOLD);

	$graph->SetMarginColor('white');
	$graph->SetScale("textlin");
	$graph->SetFrame(true);
	/****************************************************************************************/

	$cantidad = array();						// array de cantidades a mostrar
	$nombre_grupo = array();						// array de cantidades a mostrar

	$tok = strtok ($grupos,',');	// convierte la cadena de vendedores q viene a un array separado por comas y extrae todos los codigos de los vendedores
	
	while ($tok) {
		$cant_total = 0;
		$grupo=$tok;
		$tok = strtok (",");

		// consulta donde obtiene los valores de las ventas de cada vendedor
		$consulta ="select  cod_grupo,sum(cantidad)
						FROM(
									select  cod_grupo,sum(cantidad)as cantidad
									from factura_vta_no_cliente inner join factura_vta_no_cliente_detalle  
									on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario
									where cod_grupo = $grupo and fecha >= $fecha_desde and fecha <= $fecha_hasta and observacion <> 'ANULADO' and observacion <> 'N/C' GROUP BY cod_grupo
								UNION
									select  cod_grupo,sum(cantidad)									
									from factura_vta inner join factura_vta_detalle  
									on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario 
									where cod_grupo = $grupo and fecha >= $fecha_desde and fecha <= $fecha_hasta and observacion <> 'ANULADO' and observacion <> 'N/C' GROUP BY cod_grupo 
						) AS carga_caja GROUP BY cod_grupo ORDER BY cod_grupo";		
						
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$filas = mysql_num_rows ($result);           //indica la cantidad de resultados
		if($filas > 0){
			do{ 	// obtengo los resultados 
					$cod_grupo=$registro[0];		
					$cant=$registro[1];
					$cant_total = $cant_total + $cant;
					
					// consulta para obtener el nombre del grupo
					$consulta_g = "SELECT descripcion FROM grupo where cod_grupo = $cod_grupo"; // consulta sql 
					$result_g = mysql_query($consulta_g);            // hace la consulta
					$registro_g = mysql_fetch_row($result_g);        // toma el registro
					$nombre_g=$registro_g[0];

					// cargo las matrices
					$cantidad[] = $cant;
					$nombre_grupo[] = $nombre_g.' - Total Unid: '.$cant_total;
					//$graph->xaxis->SetTickLabels($fecha_g);	
			}while($registro = mysql_fetch_array($result));
	
		}
	}		
	
	// Crea la torta
	$p1 = new PiePlot3D($cantidad);
	$p1->SetSize(0.5);
	$p1->SetCenter(0.5);
	$p1->SetLegends($nombre_grupo);

	// Ajusta la posision de la leyenda
	$graph->legend->SetPos(0.1,0.1,'right','top');
	$graph->Add($p1);
	$graph->Stroke();
	//$graph-> Stroke( "c:/result2002.png"); 		// Descarga la imagen en un directorio
			
}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_cliente.tpl');   //define la plantilla que utilizara

	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="estadisticas";
	$plantilla = "ranking_articulos_mas_vendidos.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
}
?>
