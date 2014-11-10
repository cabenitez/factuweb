<?
if($cant_ano){
	// incluye los scripts necesarios - obligatorios
	include('conexion.php');
	include('convertir_mes.php');
	include ("class_jpgraph/jpgraph.php");
	include ("class_jpgraph/jpgraph_bar.php"); 
	include ("class_jpgraph/jpgraph_line.php");

	$mes = array();						// array de cantidades a mostrar
	$importe = array();						// array de cantidades a mostrar
	$i = 0;
	$tok = strtok ($anos,',');	// convierte la cadena de vendedores q viene a un array separado por comas y extrae todos los codigos de los vendedores
	while ($tok) {
		$i++;
		$anos=$tok;
		$tok = strtok (",");

		// consulta donde obtiene los valores de las ventas de cada vendedor
		$consulta ="select mes, sum(round(total_general,2))as total
						FROM(
									select 	substr(fecha,5,2) as mes, $importe_no_cliente_total_general
									
									from factura_vta_no_cliente inner join factura_vta_no_cliente_detalle  
									on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario
									where substr(fecha,1,4)= $anos and observacion <> 'ANULADO' and observacion <> 'N/C' 
									
									GROUP BY factura_vta_no_cliente_detalle.iva, substr(fecha,5,2)
								UNION
									select 	substr(fecha,5,2) as mes, $importe_cliente_total_general
									
									from factura_vta inner join factura_vta_detalle  
									on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario 
									where substr(fecha,1,4)= $anos and observacion <> 'ANULADO' and observacion <> 'N/C' 
									
									GROUP BY factura_vta_detalle.iva, substr(fecha,5,2)
						) AS carga_caja group by mes";		
						
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$filas = mysql_num_rows ($result);           //indica la cantidad de resultados
		if($filas > 0){
			do{ 	// obtengo los resultados 
					$mes_r=$registro[0];
					$importe_r=$registro[1];
					$importe_total = $importe_total + $importe_r;
					
					// cargo las matrices
					$mes[] = convertir_mes($mes_r);		// llama a la funcion para mostrar los meses
					$importe[] = $importe_r;
			}while($registro = mysql_fetch_array($result));
	
			/****************************************************************************************/
			// Crea el grafico. estas dos llamadas son requeridas siempre - obligatorios
			if($filas > 2){
				$alto = 55 * $filas;
				$largo = 95 * $filas;
			}else{
				$alto = 200;
				$largo = 200;
			}

			$graph = new Graph($largo,$alto);	
			$graph->SetScale("textlin");
			$graph->SetMarginColor('white');
			$graph->img->SetMargin(60,20,20,70);
			
			// linea alrededor del grafico
			$graph->SetBox(); 
			
			// sin marco
			$graph->SetFrame(false);
			
			// crea la solapa del titulo
			$graph->tabtitle->Set('Año '.$anos);
			
			$graph->tabtitle->SetFont(FF_ARIAL,FS_NORMAL,10);
			
			// crea los ejes X eY
			$graph->ygrid->SetFill(true,'#DDDDDD@0.5','#BBBBBB@0.5');
			$graph->ygrid->SetLineStyle('dashed');
			$graph->ygrid->SetColor('gray');
			$graph->xgrid->Show();
			$graph->xgrid->SetLineStyle('dashed');
			$graph->xgrid->SetColor('gray');
			
			// Crea las estiquetas del mes
			$graph->xaxis->SetTickLabels($mes);
			$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,10);
			$graph->xaxis->SetLabelAngle(45);
			
			// Crea las barras
			$bplot = new BarPlot($importe);
			$bplot->SetWidth(0.6);
			$fcol='#440000';
			$tcol='#FF9090';
			$bplot->SetFillGradient($fcol,$tcol,GRAD_LEFT_REFLECTION);
			
			// muestra los valores en cada columna
			$bplot->value->Show();

			// borde en cada columna
			$bplot->SetWeight(0);
			$graph->Add($bplot);
			$graph->Stroke();
			
			/****************************************************************************************/
		}
	}

		
}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_cliente.tpl');   //define la plantilla que utilizara

	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="estadisticas";
	$plantilla = "ranking_ventas_anuales.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
}
?>
