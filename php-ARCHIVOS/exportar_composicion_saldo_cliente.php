<?

//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "COMPOSICION DE SALDOS";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							
	
//if($fecha_buscar){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// busca la zona, loc, prov y pais del cliente
	if (!empty($codigo)){
		$consulta = "SELECT * from cliente where cod_cliente = $codigo"; // consulta sql 
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        		// toma el registro
		
		$cod_zona=$registro[1];
		$cod_localidad=$registro[2];
		$cod_prov=$registro[3];
		$cod_pais=$registro[4];
		$nombre_cliente = 'CLIENTE: '.$registro[6];
	}
	if (!empty($razon)){
		$consulta = "SELECT * from cliente where razon_social like '%$razon%'"; // consulta sql 
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        		// toma el registro
		$nombre_cliente = 'CLIENTE: '.$registro[6];
	}
	//================================================//
	if (!empty($fecha_desde)){
		$ano_desde = substr($fecha_desde,0,4); 
		$mes_desde = substr($fecha_desde,4,2);
		$dia_desde = substr($fecha_desde,-2);
		$fecha_desde_titulo = "DESDE: $dia_desde/$mes_desde/$ano_desde";										// maqueta la fecha para imprimir
	}
	//================================================//
	if (!empty($fecha_hasta)){
		$ano_hasta = substr($fecha_hasta,0,4); 
		$mes_hasta = substr($fecha_hasta,4,2);
		$dia_hasta = substr($fecha_hasta,-2);
		$fecha_hasta_titulo = "HASTA: $dia_hasta/$mes_hasta/$ano_hasta";										// maqueta la fecha para imprimir
	}
	
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(1,3, $nombre_cliente.'                                   '.$fecha_desde_titulo.'                   '.$fecha_hasta_titulo,0,1);
	//$pdf->Ln(2);
	

	// busca las facturas del cliente que se pagaron a cta cte ...............................  en la tabla factura_vta
	$consulta = "SELECT factura_vta.n_factura, factura_vta.cod_talonario, factura_vta.num_talonario FROM cliente inner join (factura_vta inner join forma_pago on forma_pago.cod_fp = factura_vta.cod_fp ) 
					on factura_vta.cod_cliente = cliente.cod_cliente and factura_vta.cod_zona = cliente.cod_zona and factura_vta.cod_localidad = cliente.cod_localidad
					and factura_vta.cod_prov = cliente.cod_prov  and factura_vta.cod_pais = cliente.cod_pais
					WHERE (factura_vta.observacion <> 'ANULADO' and factura_vta.observacion <> 'N/C'"; 
						
						if (!empty($codigo)){
								$consulta .= " and factura_vta.cod_cliente = $codigo and factura_vta.cod_zona = $cod_zona and factura_vta.cod_localidad = $cod_localidad 
											   and factura_vta.cod_prov = $cod_prov  and factura_vta.cod_pais = $cod_pais "; 
						}
						if (!empty($razon)){
								$consulta .= " and cliente.razon_social like '%$razon%' "; 
						}
						if (!empty($fecha_desde)){
								$consulta .= " and factura_vta.fecha >= $fecha_desde"; 
						}
						if (!empty($fecha_hasta)){
								$consulta .= " and factura_vta.fecha <= $fecha_hasta"; 
						}	

	$consulta .=")and (forma_pago.descripcion LIKE '%CTA%' or forma_pago.descripcion like '%CUENTA%' 
					or forma_pago.descripcion LIKE '%CTE%' or forma_pago.descripcion like '%CORRIENTE%' 
					or forma_pago.observacion LIKE '%CTA%' or forma_pago.observacion like '%CUENTA%' 
					or forma_pago.observacion LIKE '%CTE%' or forma_pago.observacion like '%CORRIENTE%')"; // consulta sql 

	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados

	if($nfilas > 0){
		//----------------------------------- PDF --------------------------------------------------------------------------------------------//
		//---------------------- creo los titulos de las columnas-----------------------------------//
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(6,8,'N� TAL.');
		$pdf->SetX(18);
		$pdf->Cell(10,8,'COMPROBANTE');
		$pdf->SetX(70);
		$pdf->Cell(10,8,'CLIENTE');		
		$pdf->SetX(152);
		$pdf->Cell(10,8,'FECHA');
		$pdf->SetX(173);
		$pdf->Cell(10,8,'TOTAL');
		$pdf->SetX(193);
		$pdf->Cell(10,8,'SALDO');
		//---------------------- creo la linea -----------------------------------------------------//
		$pdf->Line(7,34,205,34);																// linea
		$pdf->Ln(7);																			//Salto de l�nea

		$pdf->SetFont('Arial','',7);

		do{
				$n_factura=$registro[0];
				$cod_talonario=$registro[1];
				$num_talonario=$registro[2];

				// de las facturas encontradas anteriormente obtengo los valores de cada una ...............................  en la tabla factura_vta
				$consulta2 = "SELECT fecha, descripcion, n_sucursal, SUM(round(total_general,2)), razon, cod_talonario, num_talonario, n_factura
							  FROM(				
									select fecha, tipo_talonario.descripcion as descripcion, talonario.n_sucursal as n_sucursal, 
									
									$importe_cliente_total_general, 
									
									concat(cliente.cod_cliente,' - ',cliente.razon_social)as razon,
								   
								    factura_vta.cod_talonario as cod_talonario, factura_vta.num_talonario as num_talonario, factura_vta.n_factura as n_factura							
								   
									$from_cliente
								   
									where 2 > 1 ";
								   
									if (!empty($codigo)){
										$consulta2 .= " and factura_vta.cod_cliente = $codigo and factura_vta.cod_zona = $cod_zona and factura_vta.cod_localidad = $cod_localidad 
														and factura_vta.cod_prov = $cod_prov  and factura_vta.cod_pais = $cod_pais "; 
									}		
									if (!empty($razon)){
										$consulta2 .= " and cliente.razon_social like '%$razon%' "; 
									}
									if (!empty($fecha_desde)){
										$consulta2 .= " and factura_vta.fecha >= $fecha_desde"; 
									}
									if (!empty($fecha_hasta)){
										$consulta2 .= " and factura_vta.fecha <= $fecha_hasta"; 
									}
									
					$consulta2 .=  " and factura_vta.observacion <> 'ANULADO' and factura_vta.observacion <> 'N/C' 
									 and factura_vta.cod_talonario='$cod_talonario' and factura_vta.num_talonario=$num_talonario 
									 and factura_vta.n_factura = $n_factura 
									 
									 GROUP BY factura_vta_detalle.iva
									 
				) AS cta_cte GROUP BY cod_talonario, num_talonario, n_factura"; // consulta sql 
				
				//echo $consulta2;
				$result2 = mysql_query($consulta2);                    // hace la consulta
				$nfilas2 = mysql_num_rows ($result2);          		   //indica la cantidad de resultados
				$registro2 = mysql_fetch_row($result2);        		   // toma el registro
		
				do{
						$fecha=$registro2[0];
						$desc_fac=$registro2[1];
						$suc=$registro2[2];
						$importe=$registro2[3];								   // obtiene el importe total de la factura
						$razon_social=$registro2[4];

						// de las facturas encontradas anteriormente veo si estan imputadas y obtengo el saldo
						$consulta3 = "select round(sum(importe),2)as importe from cc_vta_detalle where n_factura =$n_factura  and cod_talonario ='$cod_talonario'  and num_talonario =$num_talonario GROUP BY n_factura"; // consulta sql 
						$result3 = mysql_query($consulta3);            // hace la consulta
						$nfilas3 = mysql_num_rows ($result3);          //indica la cantidad de resultados
						$registro3 = mysql_fetch_row($result3);        // toma el registro
				
						$importe_pagado=$registro3[0];
						$saldo = $importe-$importe_pagado;			   // obtiene el la diferencia del total de la factura menos el total imputado
						$saldo =number_format($saldo,2,'.','');
						
						//if($saldo > 0){
								//RESULTADOS DE LA BUSQUEDA DE COMPROBANTES
								$fecha_factura_ano=substr($fecha,0,4);   
								$fecha_factura_mes=substr($fecha,4,2);
								$fecha_factura_dia=substr($fecha,-2);
								
								$fecha_factura = "$fecha_factura_dia/$fecha_factura_mes/$fecha_factura_ano";										// maqueta la fecha para imprimir
				
								$len_n_talonario=strlen($num_talonario); 					// completo el numero de la sucursal con ceros
								$ceros_3 = '';
								while ($len_n_talonario < 4){
										$ceros_3.="0";
										$len_n_talonario++;
								}
								$n_talonario=$ceros_3.$num_talonario;
						
								$len_num_sucursal=strlen($suc); 					// completo el numero de la sucursal con ceros
								$ceros_2 = '';
								while ($len_num_sucursal < 4){
										$ceros_2.="0";
										$len_num_sucursal++;
								}
								$suc=$ceros_2.$suc;
						
								
								$n_f= $n_factura;
								$len_num_factura=strlen($n_factura); 						// completo el numero de factura con ceros
								$ceros= '';
								while ($len_num_factura < 8){								// completo el numero de la factura con ceros
										$ceros.="0";
										$len_num_factura++;
								}
								$n_factura=$ceros.$n_factura;
								
								$total_factura =$total_factura + $importe;
								$cont++;

					$pdf->Cell(1,3,$n_talonario,0,0);
					$pdf->SetX(18);
					$pdf->Cell(1,3,$desc_fac.' '.$suc.' '.$n_factura,0,0); 
					$pdf->SetX(70);
					$pdf->Cell(1,3,$razon_social,0,0); 
					
					$pdf->SetX(-45);
					$pdf->Cell(1,3,$fecha_factura,0,0,'R');
					$pdf->SetX(-27);
					$pdf->Cell(1,3,$importe,0,0,'R');
					$pdf->SetX(-7);
					$pdf->Cell(1,3,$saldo,0,1,'R');
					
					$total_importe = $total_importe + $importe;
					$total_saldo= $total_saldo + $saldo;
				//}

			}while($registro2 = mysql_fetch_row($result2)); 	   // obtengo los resultados 
				
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 

		//---------------------- creo el resumen de total de filas------------------------------//
		$pdf->SetFont('Arial','',10); 
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		$pdf->Ln(3);																			//Salto de l�nea
		$pdf->SetFont('Arial','',8); 
		$pdf->SetX(6);
		$pdf->Cell(0,3,'TOTALES',0,0);
					$total_importe= number_format($total_importe,2,'.','');
					$total_saldo = number_format($total_saldo,2,'.','');

					$pdf->SetX(-27);
					$pdf->Cell(1,3,$total_importe,0,0,'R');
					$pdf->SetX(-7);
					$pdf->Cell(1,3,$total_saldo,0,1,'R');
	}
	
	
if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}


?>