<?
// 		variables = "codigo="+codigo.value+"&razon="+razon.value+"&fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta;

include("conexion.php");

	// busca la zona, loc, prov y pais del cliente
	if (!empty($codigo)){
		$consulta = "SELECT * from cliente where cod_cliente = $codigo"; // consulta sql 
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        		// toma el registro
		$nfilas1 = mysql_num_rows ($result);          		//indica la cantidad de resultados
		
		$cod_zona=$registro[1];
		$cod_localidad=$registro[2];
		$cod_prov=$registro[3];
		$cod_pais=$registro[4];
		if ($nfilas1 > 0){
		
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
								
				//$consulta;
				$result = mysql_query($consulta);            // hace la consulta
				$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
				$registro = mysql_fetch_row($result);        		// toma el registro
				if ($nfilas > 0){
					echo "<div  align='right' class='seccion'>";
						echo "<img src='../imagenes/pdf.gif' width='18' height='18' border='0' class='iconos'  title='Exportar' onClick=\"javascript:exportar_composicion_saldo_cliente('exportar_composicion_saldo_cliente.php')\" /> pdf  &nbsp;&nbsp;<img src='../imagenes/imprimir.png' width='18' height='18' title='Imprimir' class='iconos' onClick=\"javascript: imprimir_composicion_saldo_cliente('exportar_composicion_saldo_cliente.php')\" /> imprimir";
					echo "</div>";
					echo "<br>";
			
					$cont = 0;
					//---------------------abre la tabla--------------------------------------------------------------------------------------//
					echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
						echo "<tr class='top'>";
							echo "<td width='5%' ><div align='center' class='seccion'>N&deg; TAL.</div></td>";
							echo "<td width='20%' ><div align='center' class='seccion'>COMPROBANTE</div></td>";
							echo "<td width='37%' ><div align='center' class='seccion'>CLIENTE</div></td>";
							echo "<td width='7%' ><div align='center' class='seccion'>FECHA</div></td>";
							echo "<td width='7%' ><div align='center' class='seccion'>TOTAL</div></td>";
							echo "<td width='7%' ><div align='center' class='seccion'>SALDO</div></td>";
							echo "<td width='7%' ><div align='center' class='seccion'>DETALLE</div></td>";
							//echo "<td width='10%' ><div align='center' class='seccion'>IMPUTAR</div></td>";
						echo "</tr>";
						$clase="class='filas'"; 							//defino la clase para las filas
					
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
											echo "<tr  onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
												echo "<td $clase align='left'>";
														echo $espacio_izq.$n_talonario;     
												echo"</td>";
												echo "<td $clase align='left'>";
														echo $espacio_izq.$desc_fac.' '.$suc.' '.$n_factura;     
												echo"</td>";
												echo "<td $clase align='left'>";
														echo $espacio_izq.$razon_social;     
												echo"</td>";
												echo "<td $clase align='center'>";
														echo $espacio_izq.$fecha_factura;     
												echo"</td>";
												echo "<td $clase align='right'>";
														echo $importe.$espacio_izq;     
												echo"</td>";
												echo "<td $clase align='right'>";
														echo $saldo.$espacio_izq;
												echo"</td>";
												echo "<td $clase align='center'>";
														if($saldo != $importe ){
																echo "<img  class='iconos' src='../imagenes/detalle.gif' border='0' title='Ver composici&oacute;n de saldos' onClick='javascript: buscar_composicion_saldo_cliente_detalle(\"$cod_talonario\",$num_talonario,\"$n_f\",\"$desc_fac\",$suc)'>"; 
														}
												echo"</td>";
												/*
												echo "<td $clase align='center'>";
														?>
														<img src='../imagenes/seguiente.gif' width='14' height='14' class='iconos' title='Imputar pago'  onClick="imputar_pago_cta_cte(<? echo 11..$cont ?>,<? echo $saldo; ?>)">
														<?
														echo "&nbsp;&nbsp;&nbsp;"; 
														?>
														<input type='text' id='<? echo 11..$cont; ?>' name="<? echo 'cod_tal='.$cod_talonario.'&num_tal='.$num_talonario.'&n_factura='.$n_factura; ?>"  onKeyPress='return solo_entero(event)' onKeyUp="calcular_importe_a_imputar(event,<? echo 11..$cont ?>,this.value,<? echo $saldo; ?>,<? echo $cont ?>,<? echo $nfilas; ?>)" size='7' maxlength='7' class='caja'>     
														<?				
			
												echo"</td>";
												*/
											echo"</tr>";
											
			
											$total_importe = $total_importe + $importe;
											$total_saldo= $total_saldo + $saldo;
											//$total_carga_factura =$total_carga_factura + $total_factura;
			
									//}
			
							}while($registro2 = mysql_fetch_row($result2)); 	   // obtengo los resultados 
							
					}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
							echo"<tr bgcolor='#E0E0E0' >";			
								echo"<td colspan='4' align='left'>&nbsp;&nbsp;TOTALES	</td>";
								
								$total_importe= number_format($total_importe,2,'.','');
								$total_saldo = number_format($total_saldo,2,'.','');
								
								echo"<td align='right'>$total_importe$espacio_izq</td>";
								echo"<td align='right'>$total_saldo$espacio_izq</td>";
								echo"<td align='right'></td>";
								//echo"<td align='center'><div id='total_imputado'> 0.00 </div></td>";
							echo"</tr>";
					echo "</table>";   
			/*
					echo "<br>";				
					$saldo_final= number_format($total_saldo,2,'.','');
					echo 'DEBE: '.$espacio_izq.$saldo_final;      
			*/
																			
					echo "<input type='hidden' id='cant_cajas' name='cant_cajas' value= $cont>";
			
					//---------------------cierra tabla--------------------------------------------------------------------------------------//
			
				}else{
					echo "<div class='$estilo_pag_info'>NO se han encontrado Registros</div>";
				}

		
		}else{
			echo "<div class='$estilo_pag_info'>NO se han encontrado Registros</div>";
		}
	}


?>