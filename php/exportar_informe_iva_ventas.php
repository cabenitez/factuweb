<?

//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "SUBDIARIO DE IVA VENTAS";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados_iva_ventas.php"); 							    							
	
if($fecha_desde){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente 
	$pag_consulta ="select descripcion,n_sucursal, n_factura, razon_social, sum(round(total_sin_impuesto,2)) as neto_gravado, tasa_iva, sum(round(iva,2)) as importe_iva, sum(round(otros_impuestos,2)) as otros_imp, sum(round(total_general,2)) as total_general, observacion,fecha,cond_iva,cuit, cod_talonario FROM	(
							select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta_no_cliente.n_factura, factura_vta_no_cliente.razon_social,
								$importe_no_cliente_total_sin_impuesto, factura_vta_no_cliente_detalle.iva as tasa_iva, $importe_no_cliente_iva, $importe_no_cliente_otros_impuestos, $importe_no_cliente_total_general,
								observacion, fecha,cond_iva,factura_vta_no_cliente.cuit, factura_vta_no_cliente.cod_talonario
						
								$from_no_cliente
								
								where fecha >= $fecha_desde and fecha <= $fecha_hasta and factura_vta_no_cliente.cod_talonario <> 'X'";

								if ($nombre_prov != 'TODOS'){
									$pag_consulta .=" and factura_vta_no_cliente.provincia = '$nombre_prov'";
								}
								$pag_consulta .=" GROUP BY factura_vta_no_cliente_detalle.iva, factura_vta_no_cliente.cod_talonario, factura_vta_no_cliente.num_talonario, factura_vta_no_cliente.n_factura";																
	$pag_consulta .=" UNION
							select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta.n_factura, cliente.razon_social, 
								$importe_cliente_total_sin_impuesto, factura_vta_detalle.iva as tasa_iva, $importe_cliente_iva, $importe_cliente_otros_impuestos, $importe_cliente_total_general , 
								observacion, fecha,cliente.cod_iva as cond_iva,cliente.cuit, factura_vta.cod_talonario
							
								$from_cliente
										
								where fecha >= $fecha_desde and fecha <= $fecha_hasta  and factura_vta.cod_talonario  <> 'X'";
								
								if ($cod_prov != 'TODOS'){
									$pag_consulta .=" and factura_vta.cod_prov = $cod_prov";
								}
								$pag_consulta .=" GROUP BY factura_vta_detalle.iva, factura_vta.cod_talonario, factura_vta.num_talonario, factura_vta.n_factura";								
								
	$pag_consulta .=") AS ventas_repartidor GROUP BY cod_talonario,n_factura ORDER BY fecha,cod_talonario,n_factura,descripcion;";

						
	$result = mysql_query($pag_consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados

	if($nfilas > 0){
		//----------------------------------- PDF --------------------------------------------------------------------------------------------//
		$ano_desde_mostrar = substr($fecha_desde,0,4); 
		$mes_desde_mostrar = substr($fecha_desde,4,2);
		$dia_desde_mostrar = substr($fecha_desde,-2);
		$fecha_desde_mostrar = "$dia_desde_mostrar/$mes_desde_mostrar/$ano_desde_mostrar";	// maqueta la fecha para imprimir

		$ano_hasta_mostrar = substr($fecha_hasta,0,4); 
		$mes_hasta_mostrar = substr($fecha_hasta,4,2);
		$dia_hasta_mostrar = substr($fecha_hasta,-2);
		$fecha_hasta_mostrar = "$dia_hasta_mostrar/$mes_hasta_mostrar/$ano_hasta_mostrar";	// maqueta la fecha para imprimir
		
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(1,3, 'DESDE '.$fecha_desde_mostrar.' HASTA '.$fecha_hasta_mostrar ,0,1);

		//---------------------- creo los titulos de las columnas-----------------------------------//
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(6,8,'COMPROBANTE');
		$pdf->SetX(34);
		$pdf->Cell(10,8,'CLIENTE');
		$pdf->SetX(78);
		$pdf->Cell(10,8,'CAT');
		$pdf->SetX(99);
		$pdf->Cell(10,8,'CUIT');
		$pdf->SetX(120);
		$pdf->Cell(10,8,'NETO GRAV.');
		$pdf->SetX(140);
		$pdf->Cell(10,8,'IVA');
		$pdf->SetX(148);
		$pdf->Cell(10,8,'IMPORTE');
		$pdf->SetX(165);
		$pdf->Cell(10,8,'OTROS IMP.');
		$pdf->SetX(184);
		$pdf->Cell(10,8,'TOTAL COMP.');

		//---------------------- creo la linea -----------------------------------------------------//
		$pdf->Line(7,34,205,34);																// linea
		$pdf->Ln(7);																			//Salto de línea
		
		$ano = substr($registro[10],0,4); 
		$mes = substr($registro[10],4,2);
		$dia = substr($registro[10],-2);
		
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(1,3,"FECHA: $dia/$mes/$ano",0,1);
		
		$lineas = 0;		
		$fecha_anterior = '';
		do{ 					// obtengo los resultados 
				$lineas++;
				//$pdf->Cell(1,3,$lineas,0,0,'R');
				
				$desc_fac = $registro[0];
				$suc = $registro[1];
				$len_num_sucursal=strlen($suc); 					// completo el numero de la sucursal con ceros
				$ceros_2 = '';
				while ($len_num_sucursal < 4){
						$ceros_2.="0";
						$len_num_sucursal++;
				}
				$suc=$ceros_2.$suc;
		
				$n_fact = $registro[2];
				$n_factura=$n_fact;
				
				$len_num_factura=strlen($n_fact); 						// completo el numero de factura con ceros
				$ceros= '';
				while ($len_num_factura < 8){								// completo el numero de la factura con ceros
						$ceros.="0";
						$len_num_factura++;
				}
				$n_fact=$ceros.$n_fact;
				
				$observacion = $registro[9];
				$cod_talonario = $registro[13];
				
				if($observacion == 'ANULADO'){
					$razon='COMPROBANTE ANULADO';					
					$total_sin_imp=" ";
					$tasa_iva= " ";
					$total_iva=" ";
					$total_otros_imp=" ";
					$total_factura=" ";
					$cond_iva=" ";
					$cuit=" ";
				}else{
					if($observacion == 'N/C'){
						$razon=$registro[3];
						$total_sin_imp=-$registro[4];
						$tasa_iva=$registro[5];
						$total_iva=-$registro[6];
						$total_factura=-$registro[8];
						$desc_fac = "NC ".$cod_talonario;
						
						$total_otros_imp=$registro[7];
						if($registro[7] > 0){
							$total_otros_imp=-$registro[7];
						}
					}else{
						$razon=$registro[3];
						$total_sin_imp=$registro[4];
						$tasa_iva=$registro[5];
						$total_iva=$registro[6];
						$total_otros_imp=$registro[7];
						$total_factura=$registro[8];
					}

					
					//$razon=$registro[3];
					//$total_sin_imp=$registro[4];
					//$tasa_iva=$registro[5];
					//$total_iva=$registro[6];
					//$total_otros_imp=$registro[7];
					//$total_factura=$registro[8];
					
					
					
					
					$fecha=$registro[10];
					  $ano = substr($fecha,0,4); 
					  $mes = substr($fecha,4,2);
					  $dia = substr($fecha,-2);
					$fecha_mostrar = "$dia/$mes/$ano";										// maqueta la fecha para imprimir

					$cond_iva=$registro[11];
						$consulta_iva = "select * from iva where cod_iva = $cond_iva"; // consulta sql 
						$result_iva = mysql_query($consulta_iva);            // hace la consulta
						$registro_iva = mysql_fetch_row($result_iva);        // toma el registro
						$cond_iva=$registro_iva[2];

					$cuit=$registro[12];
					if($cuit != "undefined"){
						if($cuit != ""){
							$cuit1=substr($cuit,0,2);
							$cuit2=substr($cuit,2,-1);
							$cuit3=substr($cuit,-1);
							$cuit = "$cuit1-$cuit2-$cuit3"; 								// maqueta el cuit para imprimir
						}
					}else{
						$cuit = "";
					}	

				}
				if($fecha_anterior == ''){			// ENTRA UNA SOLA VEZ
						if( $pdf->PageNo() == 1){
										if(  $lineas == 40 ){
													$pdf->SetX(6);
													$pdf->Cell(0,3,'TRANSPORTE ',0,0);
													$pdf->SetX(-75);
													$pdf->Cell(1,3,$total_carga_sin_imp,0,0,'R');
													$pdf->SetX(-50);
													$pdf->Cell(1,3,$total_carga_iva,0,0,'R');
													$pdf->SetX(-35);
													$pdf->Cell(1,3,$total_carga_otros_imp,0,0,'R');
													$pdf->SetX(-7);
													$pdf->Cell(1,3,$total_carga_factura,0,1,'R');
													//$pdf->Cell(1,3,'',0,1);
													
													//===============================================================================================================================
													$n++;
													$pdf->Hoja($n);
													$pdf->Titulo($titulo);
													
													$pdf->SetFont('Arial','B',8);
													$pdf->Cell(1,3, 'DESDE '.$fecha_desde_mostrar.' HASTA '.$fecha_hasta_mostrar ,0,1);
											
													//---------------------- creo los titulos de las columnas-----------------------------------//
													$pdf->SetFont('Arial','',8);
													$pdf->Cell(6,8,'COMPROBANTE');
													$pdf->SetX(34);
													$pdf->Cell(10,8,'CLIENTE');
													$pdf->SetX(78);
													$pdf->Cell(10,8,'CAT');
													$pdf->SetX(99);
													$pdf->Cell(10,8,'CUIT');
													$pdf->SetX(120);
													$pdf->Cell(10,8,'NETO GRAV.');
													$pdf->SetX(140);
													$pdf->Cell(10,8,'IVA');
													$pdf->SetX(148);
													$pdf->Cell(10,8,'IMPORTE');
													$pdf->SetX(165);
													$pdf->Cell(10,8,'OTROS IMP.');
													$pdf->SetX(184);
													$pdf->Cell(10,8,'TOTAL COMP.');
											
													//---------------------- creo la linea -----------------------------------------------------//
													$pdf->Line(7,34,205,34);																// linea
													$pdf->Ln(7);																			//Salto de línea
													
													$ano = substr($registro[10],0,4); 
													$mes = substr($registro[10],4,2);
													$dia = substr($registro[10],-2);
													
													$pdf->SetFont('Arial','',7);
													//$pdf->Cell(1,3,"FECHA: $dia/$mes/$ano",0,1);
													
													$lineas = 0;		
				
													//================================================================================================================================
													
													$pdf->SetX(6);
													$pdf->Cell(0,3,'TRANSPORTE ',0,0);
													$pdf->SetX(-75);
													$pdf->Cell(1,3,$total_carga_sin_imp,0,0,'R');
													$pdf->SetX(-50);
													$pdf->Cell(1,3,$total_carga_iva,0,0,'R');
													$pdf->SetX(-35);
													$pdf->Cell(1,3,$total_carga_otros_imp,0,0,'R');
													$pdf->SetX(-7);
													$pdf->Cell(1,3,$total_carga_factura,0,1,'R');
													//$pdf->Cell(1,3,'',0,1);
										}
						}else{
										if(  $lineas == 39){
													$pdf->SetX(6);
													$pdf->Cell(0,3,'TRANSPORTE ',0,0);
													$pdf->SetX(-75);
													$pdf->Cell(1,3,$total_carga_sin_imp,0,0,'R');
													$pdf->SetX(-50);
													$pdf->Cell(1,3,$total_carga_iva,0,0,'R');
													$pdf->SetX(-35);
													$pdf->Cell(1,3,$total_carga_otros_imp,0,0,'R');
													$pdf->SetX(-7);
													$pdf->Cell(1,3,$total_carga_factura,0,1,'R');
													//$pdf->Cell(1,3,'',0,1);
													
													//===============================================================================================================================
													$n++;
													$pdf->Hoja($n);
													$pdf->Titulo($titulo);
													
													$pdf->SetFont('Arial','B',8);
													$pdf->Cell(1,3, 'DESDE '.$fecha_desde_mostrar.' HASTA '.$fecha_hasta_mostrar ,0,1);
											
													//---------------------- creo los titulos de las columnas-----------------------------------//
													$pdf->SetFont('Arial','',8);
													$pdf->Cell(6,8,'COMPROBANTE');
													$pdf->SetX(34);
													$pdf->Cell(10,8,'CLIENTE');
													$pdf->SetX(78);
													$pdf->Cell(10,8,'CAT');
													$pdf->SetX(99);
													$pdf->Cell(10,8,'CUIT');
													$pdf->SetX(120);
													$pdf->Cell(10,8,'NETO GRAV.');
													$pdf->SetX(140);
													$pdf->Cell(10,8,'IVA');
													$pdf->SetX(148);
													$pdf->Cell(10,8,'IMPORTE');
													$pdf->SetX(165);
													$pdf->Cell(10,8,'OTROS IMP.');
													$pdf->SetX(184);
													$pdf->Cell(10,8,'TOTAL COMP.');
											
													//---------------------- creo la linea -----------------------------------------------------//
													$pdf->Line(7,34,205,34);																// linea
													$pdf->Ln(7);																			//Salto de línea
													
													$ano = substr($registro[10],0,4); 
													$mes = substr($registro[10],4,2);
													$dia = substr($registro[10],-2);
													
													$pdf->SetFont('Arial','',7);
													//$pdf->Cell(1,3,"FECHA: $dia/$mes/$ano",0,1);
													
													$lineas = 0;		
				
													//================================================================================================================================
													
													$pdf->SetX(6);
													$pdf->Cell(0,3,'TRANSPORTE ',0,0);
													$pdf->SetX(-75);
													$pdf->Cell(1,3,$total_carga_sin_imp,0,0,'R');
													$pdf->SetX(-50);
													$pdf->Cell(1,3,$total_carga_iva,0,0,'R');
													$pdf->SetX(-35);
													$pdf->Cell(1,3,$total_carga_otros_imp,0,0,'R');
													$pdf->SetX(-7);
													$pdf->Cell(1,3,$total_carga_factura,0,1,'R');
													//$pdf->Cell(1,3,'',0,1);
										}
						}

						$fecha_anterior = $fecha;
						$pdf->SetX(6);
						$pdf->Cell(1,3,$desc_fac.' '.$suc.' '.$n_fact,0,0);
						$pdf->SetX(34);
						$pdf->Cell(1,3,$razon,0,0);
						$pdf->SetX(78);
						$pdf->Cell(1,3,$cond_iva ,0,0);
						$pdf->SetX(99);
						$pdf->Cell(1,3,$cuit,0,0);
						$pdf->SetX(-75);
						$pdf->Cell(1,3,$total_sin_imp,0,0,'R');
						$pdf->SetX(-68);
						$pdf->Cell(1,3,$tasa_iva,0,0);
						$pdf->SetX(-50);
						$pdf->Cell(1,3,$total_iva,0,0,'R');
						$pdf->SetX(-35);
						$pdf->Cell(1,3,$total_otros_imp,0,0,'R');
						$pdf->SetX(-7);
						$pdf->Cell(1,3,$total_factura,0,1,'R');
						$pdf->Cell(1,3,'',0,1);
								
						//$total_carga_sin_imp= $total_carga_sin_imp + $total_sin_imp;
						//$total_carga_iva = $total_carga_iva + $total_iva;
						//$total_carga_otros_imp= $total_carga_otros_imp + $total_otros_imp;
						//$total_carga_factura = $total_carga_factura + $total_factura;

				}else{
						if( $pdf->PageNo() == 1){
										if(  $lineas == 40 ){
													$pdf->SetX(6);
													$pdf->Cell(0,3,'TRANSPORTE ',0,0);
													$pdf->SetX(-75);
													$pdf->Cell(1,3,$total_carga_sin_imp,0,0,'R');
													$pdf->SetX(-50);
													$pdf->Cell(1,3,$total_carga_iva,0,0,'R');
													$pdf->SetX(-35);
													$pdf->Cell(1,3,$total_carga_otros_imp,0,0,'R');
													$pdf->SetX(-7);
													$pdf->Cell(1,3,$total_carga_factura,0,1,'R');
													//$pdf->Cell(1,3,'',0,1);
													
													//===============================================================================================================================
													$n++;
													$pdf->Hoja($n);
													$pdf->Titulo($titulo);
													
													$pdf->SetFont('Arial','B',8);
													$pdf->Cell(1,3, 'DESDE '.$fecha_desde_mostrar.' HASTA '.$fecha_hasta_mostrar ,0,1);
											
													//---------------------- creo los titulos de las columnas-----------------------------------//
													$pdf->SetFont('Arial','',8);
													$pdf->Cell(6,8,'COMPROBANTE');
													$pdf->SetX(34);
													$pdf->Cell(10,8,'CLIENTE');
													$pdf->SetX(78);
													$pdf->Cell(10,8,'CAT');
													$pdf->SetX(99);
													$pdf->Cell(10,8,'CUIT');
													$pdf->SetX(120);
													$pdf->Cell(10,8,'NETO GRAV.');
													$pdf->SetX(140);
													$pdf->Cell(10,8,'IVA');
													$pdf->SetX(148);
													$pdf->Cell(10,8,'IMPORTE');
													$pdf->SetX(165);
													$pdf->Cell(10,8,'OTROS IMP.');
													$pdf->SetX(184);
													$pdf->Cell(10,8,'TOTAL COMP.');
											
													//---------------------- creo la linea -----------------------------------------------------//
													$pdf->Line(7,34,205,34);																// linea
													$pdf->Ln(7);																			//Salto de línea
													
													$ano = substr($registro[10],0,4); 
													$mes = substr($registro[10],4,2);
													$dia = substr($registro[10],-2);
													
													$pdf->SetFont('Arial','',7);
													//$pdf->Cell(1,3,"FECHA: $dia/$mes/$ano",0,1);
													
													$lineas = 0;		
				
													//================================================================================================================================
													
													$pdf->SetX(6);
													$pdf->Cell(0,3,'TRANSPORTE ',0,0);
													$pdf->SetX(-75);
													$pdf->Cell(1,3,$total_carga_sin_imp,0,0,'R');
													$pdf->SetX(-50);
													$pdf->Cell(1,3,$total_carga_iva,0,0,'R');
													$pdf->SetX(-35);
													$pdf->Cell(1,3,$total_carga_otros_imp,0,0,'R');
													$pdf->SetX(-7);
													$pdf->Cell(1,3,$total_carga_factura,0,1,'R');
													//$pdf->Cell(1,3,'',0,1);
										}
						}else{
										
										if(  $lineas == 39 ){
													$pdf->SetX(6);
													$pdf->Cell(0,3,'TRANSPORTE ',0,0);
													$pdf->SetX(-75);
													$pdf->Cell(1,3,$total_carga_sin_imp,0,0,'R');
													$pdf->SetX(-50);
													$pdf->Cell(1,3,$total_carga_iva,0,0,'R');
													$pdf->SetX(-35);
													$pdf->Cell(1,3,$total_carga_otros_imp,0,0,'R');
													$pdf->SetX(-7);
													$pdf->Cell(1,3,$total_carga_factura,0,1,'R');
													//$pdf->Cell(1,3,'',0,1);
													
													//===============================================================================================================================
													$n++;
													$pdf->Hoja($n);
													$pdf->Titulo($titulo);
													
													$pdf->SetFont('Arial','B',8);
													$pdf->Cell(1,3, 'DESDE '.$fecha_desde_mostrar.' HASTA '.$fecha_hasta_mostrar ,0,1);
											
													//---------------------- creo los titulos de las columnas-----------------------------------//
													$pdf->SetFont('Arial','',8);
													$pdf->Cell(6,8,'COMPROBANTE');
													$pdf->SetX(34);
													$pdf->Cell(10,8,'CLIENTE');
													$pdf->SetX(78);
													$pdf->Cell(10,8,'CAT');
													$pdf->SetX(99);
													$pdf->Cell(10,8,'CUIT');
													$pdf->SetX(120);
													$pdf->Cell(10,8,'NETO GRAV.');
													$pdf->SetX(140);
													$pdf->Cell(10,8,'IVA');
													$pdf->SetX(148);
													$pdf->Cell(10,8,'IMPORTE');
													$pdf->SetX(165);
													$pdf->Cell(10,8,'OTROS IMP.');
													$pdf->SetX(184);
													$pdf->Cell(10,8,'TOTAL COMP.');
											
													//---------------------- creo la linea -----------------------------------------------------//
													$pdf->Line(7,34,205,34);																// linea
													$pdf->Ln(7);																			//Salto de línea
													
													$ano = substr($registro[10],0,4); 
													$mes = substr($registro[10],4,2);
													$dia = substr($registro[10],-2);
													
													$pdf->SetFont('Arial','',7);
													//$pdf->Cell(1,3,"FECHA: $dia/$mes/$ano",0,1);
													
													$lineas = 0;		
				
													//================================================================================================================================
													
													$pdf->SetX(6);
													$pdf->Cell(0,3,'TRANSPORTE ',0,0);
													$pdf->SetX(-75);
													$pdf->Cell(1,3,$total_carga_sin_imp,0,0,'R');
													$pdf->SetX(-50);
													$pdf->Cell(1,3,$total_carga_iva,0,0,'R');
													$pdf->SetX(-35);
													$pdf->Cell(1,3,$total_carga_otros_imp,0,0,'R');
													$pdf->SetX(-7);
													$pdf->Cell(1,3,$total_carga_factura,0,1,'R');
													//$pdf->Cell(1,3,'',0,1);
										}
						}

						
						if($fecha_anterior != $fecha){
							if($lineas == 38){
								$pdf->SetX(6);
														$pdf->Cell(0,3,'TRANSPORTE ',0,0);
														$pdf->SetX(-75);
														$pdf->Cell(1,3,$total_carga_sin_imp,0,0,'R');
														$pdf->SetX(-50);
														$pdf->Cell(1,3,$total_carga_iva,0,0,'R');
														$pdf->SetX(-35);
														$pdf->Cell(1,3,$total_carga_otros_imp,0,0,'R');
														$pdf->SetX(-7);
														$pdf->Cell(1,3,$total_carga_factura,0,1,'R');
														//$pdf->Cell(1,3,'',0,1);
														
														//===============================================================================================================================
														$n++;
														$pdf->Hoja($n);
														$pdf->Titulo($titulo);
														
														$pdf->SetFont('Arial','B',8);
														$pdf->Cell(1,3, 'DESDE '.$fecha_desde_mostrar.' HASTA '.$fecha_hasta_mostrar ,0,1);
												
														//---------------------- creo los titulos de las columnas-----------------------------------//
														$pdf->SetFont('Arial','',8);
														$pdf->Cell(6,8,'COMPROBANTE');
														$pdf->SetX(34);
														$pdf->Cell(10,8,'CLIENTE');
														$pdf->SetX(78);
														$pdf->Cell(10,8,'CAT');
														$pdf->SetX(99);
														$pdf->Cell(10,8,'CUIT');
														$pdf->SetX(120);
														$pdf->Cell(10,8,'NETO GRAV.');
														$pdf->SetX(140);
														$pdf->Cell(10,8,'IVA');
														$pdf->SetX(148);
														$pdf->Cell(10,8,'IMPORTE');
														$pdf->SetX(165);
														$pdf->Cell(10,8,'OTROS IMP.');
														$pdf->SetX(184);
														$pdf->Cell(10,8,'TOTAL COMP.');
												
														//---------------------- creo la linea -----------------------------------------------------//
														$pdf->Line(7,34,205,34);																// linea
														$pdf->Ln(7);																			//Salto de línea
														
														$ano = substr($registro[10],0,4); 
														$mes = substr($registro[10],4,2);
														$dia = substr($registro[10],-2);
														
														$pdf->SetFont('Arial','',7);
														//$pdf->Cell(1,3,"FECHA: $dia/$mes/$ano",0,1);
														
														$lineas = 0;		
					
														//================================================================================================================================
														
														$pdf->SetX(6);
														$pdf->Cell(0,3,'TRANSPORTE ',0,0);
														$pdf->SetX(-75);
														$pdf->Cell(1,3,$total_carga_sin_imp,0,0,'R');
														$pdf->SetX(-50);
														$pdf->Cell(1,3,$total_carga_iva,0,0,'R');
														$pdf->SetX(-35);
														$pdf->Cell(1,3,$total_carga_otros_imp,0,0,'R');
														$pdf->SetX(-7);
														$pdf->Cell(1,3,$total_carga_factura,0,1,'R');
														//$pdf->Cell(1,3,'',0,1);
							}
							
							$fecha_anterior = $fecha;
							$pdf->SetFont('Arial','',7);
							$pdf->SetX(6);
							$pdf->Cell(1,3,"FECHA: $fecha_mostrar",0,1);
							$lineas++;
							
						}
							$pdf->SetX(6);
							$pdf->Cell(1,3,$desc_fac.' '.$suc.' '.$n_fact,0,0);
							$pdf->SetX(34);
							$pdf->Cell(1,3,$razon,0,0);
							$pdf->SetX(78);
							$pdf->Cell(1,3,$cond_iva,0,0);
							$pdf->SetX(99);
							$pdf->Cell(1,3,$cuit,0,0);
							$pdf->SetX(-75);
							$pdf->Cell(1,3,$total_sin_imp,0,0,'R');
							$pdf->SetX(-68);
							$pdf->Cell(1,3,$tasa_iva,0,0);
							$pdf->SetX(-50);
							$pdf->Cell(1,3,$total_iva,0,0,'R');
							$pdf->SetX(-35);
							$pdf->Cell(1,3,$total_otros_imp,0,0,'R');
							$pdf->SetX(-7);
							$pdf->Cell(1,3,$total_factura,0,1,'R');
							$pdf->Cell(1,3,'',0,1);
					
							//$total_carga_sin_imp = $total_carga_sin_imp + $total_sin_imp;
							//$total_carga_iva = $total_carga_iva + $total_iva;
							//$total_carga_otros_imp = $total_carga_otros_imp + $total_otros_imp;
							//$total_carga_factura = $total_carga_factura + $total_factura;
				}
					$total_carga_sin_imp= $total_carga_sin_imp + $total_sin_imp;
					$total_carga_iva = $total_carga_iva + $total_iva;
					$total_carga_otros_imp= $total_carga_otros_imp + $total_otros_imp;
					$total_carga_factura =$total_carga_factura + $total_factura;

		}while($registro = mysql_fetch_array($result)); //end while
		//---------------------- creo el resumen de total de filas------------------------------//
		
		$total_carga_sin_imp= number_format($total_carga_sin_imp,2,'.','');
		$total_carga_iva = number_format($total_carga_iva,2,'.','');
		$total_carga_otros_imp= number_format($total_carga_otros_imp,2,'.','');
		$total_carga_factura = number_format($total_carga_factura,2,'.','');
	
		$pdf->SetFont('Arial','',10); 
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		$pdf->Ln(3);																			//Salto de línea
		$pdf->SetFont('Arial','',8); 
		//$pdf->SetX(6);
		//$pdf->Cell(0,3,'TOTAL',0,0);
		$pdf->SetX(-75);
		$pdf->Cell(1,3,$total_carga_sin_imp,0,0,'R');
		$pdf->SetX(-50);
		$pdf->Cell(1,3,$total_carga_iva,0,0,'R');
		$pdf->SetX(-35);
		$pdf->Cell(1,3,$total_carga_otros_imp,0,0,'R');
		$pdf->SetX(-7);
		$pdf->Cell(1,3,$total_carga_factura,0,01,'R');

		//===========================================================================================================================================================//
		//===================== CREO LA ULTIMA HOJA DEL INFORME IVA VENTAS ==========================================================================================//
		
		$pdf->AddPage();
		$n++;
		$pdf->Hoja($n);
		$pdf->Titulo($titulo);
													
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(1,3, 'DESDE '.$fecha_desde_mostrar.' HASTA '.$fecha_hasta_mostrar ,0,1);
		$pdf->Ln(5);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(1,3, 'IVA POR CATEGORIA DE CLIENTE' ,0,1);
		$pdf->SetFont('Arial','',10); 
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		
		// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
		$consulta ="select round(sum(total_sin_impuesto),2) as neto_gravado, tasa_iva, round(sum(iva),2) as importe_iva, round(sum(otros_impuestos),2) as otros_imp,round(sum(total_general),2), cond_iva,observacion FROM(
								select factura_vta_no_cliente.n_factura, 
									$importe_no_cliente_total_sin_impuesto, factura_vta_no_cliente_detalle.iva as tasa_iva, $importe_no_cliente_iva, $importe_no_cliente_otros_impuestos, $importe_no_cliente_total_general,
																		
									factura_vta_no_cliente.cond_iva, observacion
							
									$from_no_cliente
									
									where fecha >= $fecha_desde and fecha <= $fecha_hasta and factura_vta_no_cliente.cod_talonario <> 'X' and factura_vta_no_cliente.observacion <> 'ANULADO' and factura_vta_no_cliente.observacion <> 'N/C'";
	
									if ($nombre_prov != 'TODOS'){
										$consulta .=" and factura_vta_no_cliente.provincia = '$nombre_prov'";
									}
									$consulta .=" GROUP BY factura_vta_no_cliente_detalle.iva, factura_vta_no_cliente.cod_talonario, factura_vta_no_cliente.num_talonario, factura_vta_no_cliente.n_factura";																
		$consulta .=" UNION
								select factura_vta.n_factura, 
									$importe_cliente_total_sin_impuesto, factura_vta_detalle.iva as tasa_iva, $importe_cliente_iva, $importe_cliente_otros_impuestos, $importe_cliente_total_general , 
									iva.cod_iva as cond_iva,observacion
								
									$from_cliente
											
									where fecha >= $fecha_desde and fecha <= $fecha_hasta  and factura_vta.cod_talonario  <> 'X' and factura_vta.observacion <> 'ANULADO' and factura_vta.observacion <> 'N/C'";
									
									if ($cod_prov != 'TODOS'){
										$consulta .=" and factura_vta.cod_prov = $cod_prov";
									}
									$consulta .=" GROUP BY factura_vta_detalle.iva, factura_vta.cod_talonario, factura_vta.num_talonario, factura_vta.n_factura";
																
		$consulta .=") AS ventas_repartidor GROUP BY cond_iva,tasa_iva";
		//echo $consulta;

		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro


		//---------------------- creo los titulos de las columnas-----------------------------------//
		$pdf->SetFont('Arial','',8);
		$pdf->SetX(6);
		$pdf->Cell(1,8,'CATEGORIA');
		$pdf->SetX(143);
		$pdf->Cell(1,8,'NETO GRAV.');
		$pdf->SetX(170);
		$pdf->Cell(1,8,'IVA');
		$pdf->SetX(189);
		$pdf->Cell(1,8,'IMPORTE',0,1);
		
		$pdf->SetFont('Arial','',10); 
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		$pdf->Ln(3);																			//Salto de línea
		$pdf->SetFont('Arial','',8); 

		do{
			$total_sin_imp=$registro[0];
			$tasa_iva=$registro[1];
			$total_iva=$registro[2];
			$total_otros_imp=$registro[3];
			$total_factura=$registro[4];
			$cond_iva=$registro[5];
			$obs=$registro[6];
						
			//==================================DESCUENTA LOS COMPROBANTES DE NOTA DE CREDITO===================================//
			$consulta_NC ="select round(sum(total_sin_impuesto),2) as neto_gravado, tasa_iva, round(sum(iva),2) as importe_iva, round(sum(otros_impuestos),2) as otros_imp,round(sum(total_general),2), cond_iva,observacion FROM(
									select factura_vta_no_cliente.n_factura,
										$importe_no_cliente_total_sin_impuesto, factura_vta_no_cliente_detalle.iva as tasa_iva, $importe_no_cliente_iva, $importe_no_cliente_otros_impuestos, $importe_no_cliente_total_general,
										
										factura_vta_no_cliente.cond_iva,observacion
								
										$from_no_cliente
										
										where cond_iva = $cond_iva and fecha >= $fecha_desde and fecha <= $fecha_hasta and factura_vta_no_cliente.cod_talonario <> 'X' and factura_vta_no_cliente.observacion <> 'ANULADO' and factura_vta_no_cliente.observacion = 'N/C'";
		
										if ($nombre_prov != 'TODOS'){
											$consulta_NC .=" and factura_vta_no_cliente.provincia = '$nombre_prov'";
										}
										$consulta_NC .=" GROUP BY factura_vta_no_cliente_detalle.iva, factura_vta_no_cliente.cod_talonario, factura_vta_no_cliente.num_talonario, factura_vta_no_cliente.n_factura";																
			$consulta_NC .=" UNION
									select factura_vta.n_factura, 
										$importe_cliente_total_sin_impuesto, factura_vta_detalle.iva as tasa_iva, $importe_cliente_iva, $importe_cliente_otros_impuestos, $importe_cliente_total_general , 
										iva.cod_iva as cond_iva,observacion
									
										$from_cliente
												
										where iva.cod_iva = $cond_iva and fecha >= $fecha_desde and fecha <= $fecha_hasta  and factura_vta.cod_talonario  <> 'X' and factura_vta.observacion <> 'ANULADO' and factura_vta.observacion = 'N/C'";
										
										if ($cod_prov != 'TODOS'){
											$consulta_NC .=" and factura_vta.cod_prov = $cod_prov";
										}
										$consulta_NC .=" GROUP BY factura_vta_detalle.iva, factura_vta.cod_talonario, factura_vta.num_talonario, factura_vta.n_factura";
																	
			$consulta_NC .=") AS ventas_repartidor GROUP BY cond_iva,tasa_iva";

			$result_NC = mysql_query($consulta_NC);            // hace la consulta
			$registro_NC = mysql_fetch_row($result_NC);        // toma el registro

			$total_sin_imp_NC=$registro_NC[0];
			$tasa_iva_NC=$registro_NC[1];
			$total_iva_NC=$registro_NC[2];
			$total_otros_imp_NC=$registro_NC[3];
			$total_factura_NC=$registro_NC[4];


			$consulta_iva = "select * from iva where cod_iva = $cond_iva"; // consulta sql 
			$result_iva = mysql_query($consulta_iva);            // hace la consulta
			$registro_iva = mysql_fetch_row($result_iva);        // toma el registro
			$cond_iva=$registro_iva[2];

			$pdf->SetX(7);
			$pdf->Cell(1,3,$cond_iva,0,0);
			$pdf->SetX(-50);
			$pdf->Cell(1,3,$total_sin_imp-$total_sin_imp_NC,0,0,'R');
			$pdf->SetX(-35);
			$pdf->Cell(1,3,$tasa_iva,0,0,'R');
			$pdf->SetX(-7);
			$pdf->Cell(1,3,$total_iva-$total_iva_NC,0,1,'R'); 
			$pdf->Cell(1,3,'',0,1);
			
			//$total = $total + $total_sin_imp-$total_sin_imp_NC;
			//$total_carga_iva = $total_carga_iva + $total_iva;
			//$total_carga_otros_imp = $total_carga_otros_imp + $total_otros_imp;
			//$total_carga_factura = $total_carga_factura + $total_factura;

		
		}while($registro = mysql_fetch_array($result)); //end while
			
			//$pdf->SetX(7);
			//$pdf->Cell(1,3,$total,0,0);

					
 }
	
if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}

} // FIN DE if($fecha_buscar){

?>