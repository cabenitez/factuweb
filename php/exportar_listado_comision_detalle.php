<?
//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "INFORME DETALLADO - COMISION DE VENDEDOR";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							
	
	include("conexion.php");
	$consulta = "SELECT * FROM regular_comision"; 								// consulta sql
	$result = mysql_query($consulta);            								// hace la consulta
	$registro = mysql_fetch_row($result);        								// toma el registro
	$nfilas = mysql_num_rows ($result);          								//indica la cantidad de resultados
	if ($nfilas > 0){     						 					// si existen paises
		$descuento = $registro[0]; 									// toma la variable de la url q vino de ajax.js
		$minimo = $registro[1]; 									// toma la variable de la url q vino de ajax.js
	}else{
		$descuento = 0; 											// toma la variable de la url q vino de ajax.js
		$minimo = 0; 												// toma la variable de la url q vino de ajax.js
	}
	//================================================================================================================================================//
	//================================================ ARTICULOS VENDIDOS SIN VONIFICACION ===========================================================//	
	//================================================================================================================================================//
	
	$consulta = "select DISTINCT (cod), descripcion, SUM(cant), precio, round((SUM(cant)* precio),2)as importe, bonificacion, (porc_vta)as comision_zona, comision_art  				                      FROM (
						select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as                        cant, fecha, precio, bonificacion, zona.porc_vta, factura_vta.cod_vendedor, producto.porc_vta as comision_art
						from zona inner join (cliente inner join (factura_vta inner join (factura_vta_detalle inner join producto 
							on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) =                            concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
							on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario)
							on factura_vta.cod_cliente = cliente.cod_cliente)
							on cliente.cod_zona = zona.cod_zona
						where factura_vta.fecha >= $fecha_desde  and factura_vta.fecha <= $fecha_hasta and factura_vta.cod_vendedor = $vendedor and                        factura_vta.observacion <> 'ANULADO'  and observacion <> 'N/C' and factura_vta_detalle.bonificacion = 0 
						GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod),precio,bonificacion 
						UNION ALL
						select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as                        cant, fecha, precio, bonificacion, zona.porc_vta, factura_vta_no_cliente.cod_vendedor, producto.porc_vta as comision_art  
						from zona inner join (factura_vta_no_cliente inner join (factura_vta_no_cliente_detalle inner join producto 
							on concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca, factura_vta_no_cliente_detalle.cod_variedad,                            factura_vta_no_cliente_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
							on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario)
							on factura_vta_no_cliente.cod_zona = zona.cod_zona
					
						where fecha >= $fecha_desde  and fecha <= $fecha_hasta and cod_vendedor = $vendedor and observacion <> 'ANULADO'  and observacion <> 'N/C' and                        factura_vta_no_cliente_detalle.bonificacion = 0 
						GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod),precio,bonificacion 
				)AS comision_vendedor GROUP BY cod,precio,bonificacion ORDER BY  SUM(cod)"; // consulta sql 
					
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados

	if($nfilas > 0){
		$ano_desde = substr($fecha_desde,0,4); 
		$mes_desde = substr($fecha_desde,4,2);
		$dia_desde = substr($fecha_desde,-2);
		$desde = "$dia_desde/$mes_desde/$ano_desde";										// maqueta la fecha para imprimir
		
		$ano_hasta = substr($fecha_hasta,0,4); 
		$mes_hasta = substr($fecha_hasta,4,2);
		$dia_hasta = substr($fecha_hasta,-2);
		$hasta = "$dia_hasta/$mes_hasta/$ano_hasta";										// maqueta la fecha para imprimir

		$consulta_v = "SELECT nombre FROM vendedor where cod_vendedor = $vendedor"; 											// consulta sql
		$result_v = mysql_query($consulta_v);            								// hace la consulta
		$registro_v = mysql_fetch_row($result_v);        						// toma el registro
		$nombre = $registro_v[0]; 									// toma la variable de la url q vino de ajax.js
		
		//----------------------------------- PDF --------------------------------------------------------------------------------------------//
		$pdf->Ln(7);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(6,8,'VENDEDOR: '.$vendedor.' - '.$nombre,0,0);
		$pdf->SetX(100);
		$pdf->Cell(10,8,'DESDE:   '.$desde.'   HASTA:   '.$hasta,0,1);
		
		$pdf->SetFont('Arial','UB',10);
		$pdf->Cell(6,8,'VENTAS SIN BONIFICACION',0,1);
		$pdf->SetFont('Arial','',10);

		//---------------------- creo los titulos de las columnas-----------------------------------//
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(6,8,'CODIGO');
		$pdf->SetX(20);
		$pdf->Cell(10,8,'DESCRIPCION');
		$pdf->SetX(70);
		$pdf->Cell(10,8,'CANTIDAD');
		$pdf->SetX(90);
		$pdf->Cell(10,8,'PRECIO');
		$pdf->SetX(107);
		$pdf->Cell(10,8,'IMPORTE');
		$pdf->SetX(126);
		$pdf->Cell(10,8,'BONIF.');
		$pdf->SetX(140);
		$pdf->Cell(10,8,'COM. ZONA');
		$pdf->SetX(160);
		$pdf->Cell(10,8,'COM. ARTICULO');
		$pdf->SetX(188);
		$pdf->Cell(10,8,'SUBTOTAL');
		
		//---------------------- creo la linea -----------------------------------------------------//
		$pdf->Line(7,54,205,54);																// linea
		$pdf->Ln(7);																			//Salto de línea
		
		$pdf->SetFont('Arial','',7);
		do{ 		// obtengo los resultados 
					$codigo = $registro[0];
					$desc = $registro[1];	
					$cantidad = $registro[2];
					$precio=$registro[3];
					$importe=$registro[4];
					
					$total_importe = $total_importe+$importe;
					$total_importe =number_format($total_importe,2,'.','');
					
					$bonif =$registro[5];
					$com_zona=$registro[6];
					$com_art=$registro[7];
					
					$comision = ($com_zona + $com_art) - (  (($com_zona + $com_art) *($bonif * $descuento))/100) ; // obtengo la comision regulada
					$total_fila = ((( $importe - ($importe*$bonif)/100) * $comision)/100);
					
					$total_comision = $total_comision+$total_fila;
					$total_comision =number_format($total_comision,2,'.','');
					
					$pdf->Cell(0,3,$codigo,0,0);
					$pdf->SetX(20);
					$pdf->Cell(0,3,$desc,0,0);
					$pdf->SetX(72);
					$pdf->Cell(0,3,$cantidad,0,0);
					$pdf->SetX(92);
					$pdf->Cell(0,3,number_format($precio,2,'.',''),0,0);
					$pdf->SetX(109);
					$pdf->Cell(0,3,number_format($importe,2,'.',''),0,0);
					$pdf->SetX(128);
					$pdf->Cell(0,3,$bonif,0,0);
					$pdf->SetX(142);
					$pdf->Cell(0,3,number_format($com_zona,2,'.',''),0,0);
					$pdf->SetX(162);
					$pdf->Cell(0,3,number_format($com_art,2,'.',''),0,0);
					$pdf->SetX(190);
					$pdf->Cell(0,3,number_format($total_fila,2,'.',''),0,1);

		}while($registro = mysql_fetch_array($result)); //end while

		//---------------------- creo el resumen de total de filas------------------------------//
		$pdf->SetFont('Arial','',10); 
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		$pdf->Ln(3);																			//Salto de línea
		$pdf->SetFont('Arial','',8); 
		$pdf->SetX(6);
		$pdf->Cell(0,3,'TOTALES',0,0);
		$pdf->SetX(109);
		$pdf->Cell(0,3,$total_importe,0,0);
		$pdf->SetX(190);
		$pdf->Cell(0,3,$total_comision,0,1);
	}
	
	//================================================================================================================================================//
	//================================================ ARTICULOS VENDIDOS CON VONIFIACION ============================================================//	
	//================================================================================================================================================//
		
	$consulta = "select DISTINCT (cod), descripcion, SUM(cant), precio, (SUM(cant)* precio)as importe, bonificacion, (porc_vta)as comision_zona, comision_art  FROM (
							select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad)                            as cant, fecha, precio, bonificacion, zona.porc_vta, factura_vta.cod_vendedor, producto.porc_vta as comision_art
							from zona inner join (cliente inner join (factura_vta inner join (factura_vta_detalle inner join producto 
								on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod)                                 = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
								on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario)
								on factura_vta.cod_cliente = cliente.cod_cliente)
								on cliente.cod_zona = zona.cod_zona
							where factura_vta.fecha >= $fecha_desde  and factura_vta.fecha <= $fecha_hasta and factura_vta.cod_vendedor = $vendedor and  factura_vta.observacion <> 'ANULADO'  and observacion <> 'N/C' and factura_vta_detalle.bonificacion > 0 
							GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod),precio,bonificacion 
							UNION ALL
							select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, fecha, precio, bonificacion, zona.porc_vta, factura_vta_no_cliente.cod_vendedor, producto.porc_vta as comision_art  
							from zona inner join (factura_vta_no_cliente inner join (factura_vta_no_cliente_detalle inner join producto 
								on concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca, factura_vta_no_cliente_detalle.cod_variedad, factura_vta_no_cliente_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
								on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario)
								on factura_vta_no_cliente.cod_zona = zona.cod_zona
						
							where fecha >= $fecha_desde  and fecha <= $fecha_hasta and cod_vendedor = $vendedor and observacion <> 'ANULADO'  and observacion <> 'N/C' and factura_vta_no_cliente_detalle.bonificacion > 0 
							GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod),precio,bonificacion
				)AS comision_vendedor GROUP BY cod,precio,bonificacion ORDER BY  SUM(cod)"; // consulta sql 
						
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nfilas2 = mysql_num_rows ($result);          		//indica la cantidad de resultados
	
	if($nfilas2 > 0){
		//----------------------------------- PDF --------------------------------------------------------------------------------------------//		
		$pdf->Ln(7);																			//Salto de línea
		$pdf->SetFont('Arial','UB',10);
		$pdf->Cell(6,8,'VENTAS CON BONIFICACION',0,1);
		$pdf->SetFont('Arial','',10);

		//---------------------- creo los titulos de las columnas-----------------------------------//
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(6,8,'CODIGO');
		$pdf->SetX(20);
		$pdf->Cell(10,8,'DESCRIPCION');
		$pdf->SetX(70);
		$pdf->Cell(10,8,'CANTIDAD');
		$pdf->SetX(90);
		$pdf->Cell(10,8,'PRECIO');
		$pdf->SetX(107);
		$pdf->Cell(10,8,'IMPORTE');
		$pdf->SetX(126);
		$pdf->Cell(10,8,'BONIF.');
		$pdf->SetX(140);
		$pdf->Cell(10,8,'COM. ZONA');
		$pdf->SetX(160);
		$pdf->Cell(10,8,'COM. ARTICULO');
		$pdf->SetX(188);
		$pdf->Cell(10,8,'SUBTOTAL');
		
		//---------------------- creo la linea -----------------------------------------------------//
		$pdf->SetX(6);
		$pdf->SetFont('Arial','',10); 
		$pdf->Ln(4);
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		$pdf->Ln(3);																			//Salto de línea
		$pdf->SetFont('Arial','',7); 

			do{ 	// obtengo los resultados 
					$codigo = $registro[0];
					$desc = $registro[1];	
					$cantidad = $registro[2];
					$precio=$registro[3];
					$importe=$registro[4];
					
					$total_importe2 = $total_importe2+$importe;
					$total_importe2 =number_format($total_importe2,2,'.','');
					
					$bonif =$registro[5];
					$com_zona=$registro[6];
					$com_art=$registro[7];
					
					$comision = ($com_zona + $com_art) - (  (($com_zona + $com_art) *($bonif * $descuento))/100) ; // obtengo la comision regulada
					if($comision < 0){
						$comision = $minimo;
					}

					$total_fila = ((( $importe - ($importe*$bonif)/100) * $comision)/100);
					
					$total_comision2 = $total_comision2+$total_fila;
					$total_comision2 =number_format($total_comision2,2,'.','');
	
					$pdf->Cell(0,3,$codigo,0,0);
					$pdf->SetX(20);
					$pdf->Cell(0,3,$desc,0,0);
					$pdf->SetX(72);
					$pdf->Cell(0,3,$cantidad,0,0);
					$pdf->SetX(92);
					$pdf->Cell(0,3,number_format($precio,2,'.',''),0,0);
					$pdf->SetX(109);
					$pdf->Cell(0,3,number_format($importe,2,'.',''),0,0);
					$pdf->SetX(128);
					$pdf->Cell(0,3,$bonif,0,0);
					$pdf->SetX(142);
					$pdf->Cell(0,3,number_format($com_zona,2,'.',''),0,0);
					$pdf->SetX(162);
					$pdf->Cell(0,3,number_format($com_art,2,'.',''),0,0);
					$pdf->SetX(190);
					$pdf->Cell(0,3,number_format($total_fila,2,'.',''),0,1);
			
			}while($registro = mysql_fetch_array($result)); //end while
			
			//---------------------- creo el resumen de total de filas------------------------------//
			$pdf->SetFont('Arial','',10); 
			$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
			$pdf->Ln(3);																			//Salto de línea
			$pdf->SetFont('Arial','',8); 
			$pdf->SetX(6);
			$pdf->Cell(0,3,'TOTALES',0,0);
			$pdf->SetX(109);
			$pdf->Cell(0,3,$total_importe2,0,0);
			$pdf->SetX(190);
			$pdf->Cell(0,3,$total_comision2,0,1);
	}	

	if($nfilas > 0 || $nfilas2 > 0){
		//---------------------abre la tabla--------------------------------------------------------------------------------------//
		$total_percibir= $total_comision + $total_comision2;
		$total_importe_fact= $total_importe + $total_importe2;

		$total_percibir= number_format($total_percibir,2,'.','');
		$total_importe_fact= number_format($total_importe_fact,2,'.','');

		$pdf->SetFont('Arial','UB',10);
		$pdf->Ln(5);
		$pdf->Cell(0,3,'TOTALES',0,0);
		$pdf->SetFont('Arial','B',10);
		$pdf->SetX(109);
		$pdf->Cell(0,3,$total_importe_fact,0,0);
		$pdf->SetX(190);
		$pdf->Cell(0,3,$total_percibir,0,1);

		//===================== DEVOLUCIONES =======================================//	
		$consulta = "select round(sum(precio),2)as total 
					 from devolucion inner join devolucion_detalle on devolucion_detalle.n_devolucion = devolucion.n_devolucion 
					 where fecha_carga >= $fecha_desde  and fecha_carga <= $fecha_hasta and cod_vendedor = $vendedor"; // consulta sql 
							
		$result = mysql_query($consulta);            		// hace la consulta
		$registro = mysql_fetch_row($result);        		// toma el registro
		$nfilas3 = mysql_num_rows ($result);          		//indica la cantidad de resultados

		if($nfilas3 > 0){
			$importe_devolucion = number_format($registro[0],2,'.','');

			$pdf->Ln(5);
			$pdf->SetFont('Arial','UB',10); 
			$pdf->Cell(0,3,'TOTAL DEVOLUCIONES',0,0);
			$pdf->SetFont('Arial','B',10);
			$pdf->SetX(109);
			$pdf->Cell(0,3,$importe_devolucion,0,0);
		}
	}	
	
if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}
	
?>
