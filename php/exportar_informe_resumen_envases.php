<?

//---------------------- Titulo del listado-------------------------------------------------//
$ano = substr($fecha_buscar,0,4); 
$mes = substr($fecha_buscar,4,2);
$dia = substr($fecha_buscar,-2);
$fecha_titulo = "$dia/$mes/$ano";										// maqueta la fecha para imprimir
$titulo = "RESUMEN DE ENVASES - $fecha_titulo";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							
	
if($fecha_buscar){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$consulta ="SELECT distinct(cod_repartidor), nombre from(
				  select cod_repartidor, nombre from producto inner join (factura_vta_detalle inner join (factura_vta  inner join fletero on factura_vta.cod_repartidor = fletero.cod_flero) on factura_vta_detalle.n_factura =  factura_vta.n_factura) on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)  where fecha = $fecha_buscar and producto.envase = 'SI'
				  UNION 
				  select cod_repartidor, nombre from producto inner join ( factura_vta_no_cliente_detalle inner join (factura_vta_no_cliente inner join fletero on factura_vta_no_cliente.cod_repartidor = fletero.cod_flero      ) on factura_vta_no_cliente_detalle.n_factura =  factura_vta_no_cliente.n_factura) on concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca, factura_vta_no_cliente_detalle.cod_variedad, factura_vta_no_cliente_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)  where fecha = $fecha_buscar and producto.envase = 'SI'
				  UNION
				  select cod_repartidor, nombre from producto inner join ( remito_vta_detalle  inner join (remito_vta inner join fletero on remito_vta.cod_repartidor = fletero.cod_flero   ) on remito_vta_detalle.num_remito =  remito_vta.num_remito) on concat(remito_vta_detalle.cod_grupo, remito_vta_detalle.cod_marca, remito_vta_detalle.cod_variedad, remito_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)  where fecha = $fecha_buscar and producto.envase = 'SI'
				  UNION 
				  select cod_repartidor, nombre from producto inner join ( remito_vta_detalle_no_cliente  inner join (remito_vta_no_cliente inner join fletero on remito_vta_no_cliente.cod_repartidor = fletero.cod_flero   ) on remito_vta_detalle_no_cliente.num_remito =  remito_vta_no_cliente.num_remito) on concat(remito_vta_detalle_no_cliente.cod_grupo, remito_vta_detalle_no_cliente.cod_marca, remito_vta_detalle_no_cliente.cod_variedad, remito_vta_detalle_no_cliente.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)  where fecha = $fecha_buscar and producto.envase = 'SI'
				) as repartidores order by cod_repartidor";
	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados

	if($nfilas > 0){
		//----------------------------------- PDF --------------------------------------------------------------------------------------------//
					do{ 					
					$repartidor = $registro[0];
					$nombre_repartidor = $registro[1];
					
					
					//---------------------- Obtiene el detalle de todos los comprobantes Factura Vta-----------------------------------------------//
					$consulta2 ="select DISTINCT (cod), descripcion, SUM(cant), (SUM(cant)* unidad_bulto)AS total_envase ,envase, grupo, sum(pesos) FROM (
								select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos from factura_vta inner join (factura_vta_detalle inner join producto on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario where fecha = $fecha_buscar and cod_repartidor= $repartidor and observacion <> 'ANULADO'  and observacion <> 'N/C' GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)  
								UNION ALL
								select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos from factura_vta_no_cliente inner join (factura_vta_no_cliente_detalle inner join producto on concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca, factura_vta_no_cliente_detalle.cod_variedad, factura_vta_no_cliente_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario where fecha = $fecha_buscar and cod_repartidor= $repartidor and observacion <> 'ANULADO'  and observacion <> 'N/C' GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
								UNION ALL
								select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos from remito_vta inner join (remito_vta_detalle inner join producto on concat(remito_vta_detalle.cod_grupo, remito_vta_detalle.cod_marca, remito_vta_detalle.cod_variedad, remito_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on remito_vta_detalle.num_remito = remito_vta.num_remito where fecha = $fecha_buscar and cod_repartidor= $repartidor and observacion <> 'ANULADO'  and observacion <> 'N/C' GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
								UNION ALL
								select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos from remito_vta_no_cliente inner join (remito_vta_detalle_no_cliente inner join producto on concat(remito_vta_detalle_no_cliente.cod_grupo, remito_vta_detalle_no_cliente.cod_marca, remito_vta_detalle_no_cliente.cod_variedad, remito_vta_detalle_no_cliente.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on remito_vta_detalle_no_cliente.num_remito = remito_vta_no_cliente.num_remito where fecha = $fecha_buscar and cod_repartidor= $repartidor and observacion <> 'ANULADO'  and observacion <> 'N/C' GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
								) AS carga_articulos GROUP BY cod ORDER BY grupo, SUM(cant) DESC";
					
					$result2 = mysql_query($consulta2);            // hace la consulta
					$registro2 = mysql_fetch_row($result2);        // toma el registro
					$filas2 = mysql_num_rows ($result2);          //indica la cantidad de resultados

					//---------------------- creo los titulos de las columnas-----------------------------------//
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(0,0,'REPARTIDOR: '.$repartidor.' - '.$nombre_repartidor,0,1);
					$pdf->Ln(4);
					
					//---------------------- creo los titulos de las columnas-----------------------------------//
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(0,0,'CODIGO');
					$pdf->SetX(20);
					$pdf->Cell(0,0,'DESCRIPCION');
					$pdf->SetX(130);
					$pdf->Cell(0,0,'ENVASES');
					$pdf->SetX(160);
					$pdf->Cell(0,0,'CAJONES',0,1);
					//---------------------- creo la linea -----------------------------------------------------//
					$pdf->SetFont('Arial','',10); 
					$pdf->SetX(6);
					$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
					$pdf->Ln(2);																			//Salto de línea


					$pdf->SetFont('Arial','',7);
		
					do{ 					// obtengo los resultados 
								$codigo = $registro2[0];
								$desc = $registro2[1];
								$bulto = $registro2[2];
								$tiene_envase = $registro2[4];
								$peso = $registro2[6];

								if($tiene_envase == "SI"){
										$envase=$registro2[3];
										$total_envase2= $total_envase2 + $envase;
										
										$cajon = round($bulto);
										if($bulto > $cajon){
											$cajon++;
										}
										$total_cajon2= $total_cajon2 + $cajon;
										
										$pdf->Cell(1,3,$codigo,0,0);
										$pdf->SetX(20);
										$pdf->Cell(1,3,$desc,0,0);
										$pdf->SetX(-70);
										$pdf->Cell(1,3,$envase,0,0,'R');
										$pdf->SetX(-40);
										$pdf->Cell(1,3,$cajon,0,1,'R');
								}
						}while($registro2 = mysql_fetch_row($result2)); // obtengo los resultados 
						$pdf->SetFont('Arial','',10); 
						$pdf->SetX(6);
						$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
						$pdf->Ln(2);																			//Salto de línea

						$pdf->SetFont('Arial','',7);
						$pdf->SetX(6);
						$pdf->Cell(0,3,'TOTALES',0,0);
						$pdf->SetX(-70);
						$pdf->Cell(1,3,$total_envase2,0,0,'R');
						$pdf->SetX(-40);
						$pdf->Cell(1,3,$total_cajon2,0,1,'R');
						$pdf->Ln(5);
						$total_envase_informe= $total_envase_informe+$total_envase2; 
						$total_cajon_informe= $total_cajon_informe+$total_cajon2;
						
						$total_envase2 = 0;
						$total_cajon2 = 0;    
								
		}while($registro = mysql_fetch_array($result)); //end while

		//---------------------- creo el resumen de total de filas------------------------------//
		$pdf->SetFont('Arial','',10); 
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		$pdf->Ln(3);																			//Salto de línea
		$pdf->SetFont('Arial','',8); 
		$pdf->SetX(6);
		$pdf->Cell(0,3,'TOTALES GENERALES',0,0);
					$pdf->SetX(-70);
					$pdf->Cell(1,3,$total_envase_informe,0,0,'R');
					$pdf->SetX(-40);
					$pdf->Cell(1,3,$total_cajon_informe,0,1,'R');
	}

    // ======================== CREA EL DETALLE DE VENTAS POR DEPOSITO =================================================//
	$pdf->AddPage();																		// agrega una pagina
	$pdf->SetFont('Arial','UB',10); 
	$pdf->SetX(6);
	$pdf->Cell(0,10,'DETALLE ENVASES POR DEPOSITO',0,1,'C');
		
	$consulta_dep = "select cod_flero from fletero where nombre like '%DEPOS%'";
	$result_dep = mysql_query($consulta_dep);            
	$registro_dep = mysql_fetch_row($result_dep);        
	$filas_dep = mysql_num_rows ($result_dep);          //indica la cantidad de resultados
	if($filas_dep > 0){
		do{
			$repartidor=$registro_dep[0];
			include("exportar_informe_resumen_envases_deposito.php");
		}while($registro_dep = mysql_fetch_row($result_dep)); // obtengo los resultados 		
	}

	
	
	
	
if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}

} // FIN DE if($fecha_buscar){

?>
