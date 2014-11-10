<?
$ano = substr($fecha_buscar,0,4); 
$mes = substr($fecha_buscar,4,2);
$dia = substr($fecha_buscar,-2);
$fecha_titulo = "$dia/$mes/$ano";										// maqueta la fecha para imprimir

//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "RECIBOS INGRESADOS";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							
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



	
	
	// busca las facturas del cliente que se pagaron a cta cte ...............................  en la tabla factura_vta
	$consulta = "SELECT distinct cc_vta.num_recibo, cc_vta.cod_talonario, cc_vta.num_talonario, cc_vta.cod_cliente,  cc_vta.importe, cc_vta.cod_vendedor, cc_vta.fecha, cc_vta.observacion, cc_vta.usuario,concat(cliente.cod_cliente,' - ',cliente.razon_social)  
			  	 FROM cliente inner join (recibos_por_cliente inner join cc_vta 
					on cc_vta.cod_talonario = recibos_por_cliente.cod_talonario and cc_vta.num_talonario = recibos_por_cliente.num_talonario) 
					on recibos_por_cliente.cod_cliente = cliente.cod_cliente and cc_vta.cod_cliente = cliente.cod_cliente and recibos_por_cliente.cod_zona = cliente.cod_zona 
					and recibos_por_cliente.cod_localidad = cliente.cod_localidad and recibos_por_cliente.cod_prov = cliente.cod_prov 
					and recibos_por_cliente.cod_pais = cliente.cod_pais  WHERE 2 > 1"; 
						
						if (!empty($codigo)){
							$consulta .= " and cc_vta.cod_cliente = $codigo and cc_vta.cod_zona = $cod_zona and cc_vta.cod_localidad = $cod_localidad 
											   and cc_vta.cod_prov = $cod_prov  and cc_vta.cod_pais = $cod_pais "; 
						}
						
						if (!empty($razon)){
								$consulta .= " and cliente.razon_social like '%$razon%' "; 
						}

						if (!empty($fecha_desde)){
								$consulta .= " and cc_vta.fecha >= $fecha_desde"; 
						}
						
						if (!empty($fecha_hasta)){
								$consulta .= " and cc_vta.fecha <= $fecha_hasta"; 
						}
	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	
	if($filas > 0){

		//----------------------------------- PDF -----------------------------------------------------------------------//
		//---------------------- creo los titulos de las columnas-----------------------------------//
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(6,8,'Nº TAL');
		$pdf->SetX(18);
		$pdf->Cell(10,8,'COMPROBANTE');
		$pdf->SetX(72);
		$pdf->Cell(10,8,'CLIENTE');
		//$pdf->SetX(105);
		//$pdf->Cell(10,8,'OBSERVACION');
		$pdf->SetX(120);
		$pdf->Cell(10,8,'VENDEDOR');
		$pdf->SetX(172);
		$pdf->Cell(10,8,'FECHA');		
		$pdf->SetX(190);
		$pdf->Cell(10,8,'IMPORTE');
		//---------------------- creo la linea -----------------------------------------------------//
		$pdf->Line(7,34,205,34);																// linea
		$pdf->Ln(7);																			//Salto de línea
		
		
		
		
		$pdf->SetFont('Arial','',7);
		do{ 		// obtengo los resultados 

				 $n_recibo=$registro[0];		
				 $cod_tal_recibo=$registro[1];
				 $num_tal_recibo=$registro[2];		
				 $importe=$registro[4];
				 $cod_vendedor=$registro[5];
				 $fecha_imp=$registro[6];
				 $obs=$registro[7];
				 $usuario_cs=$registro[8];
				 $razon_social=$registro[9];
				
				 //-----------------------//
				 $n_recibo_sin_ceros = $n_recibo;
				 $num_tal_recibo_sin_ceros = $num_tal_recibo;
				 //-----------------------//
						
				 //====================OBTENGO EL NOMBRE DEL VENDEDOR ==========================//
				 $consulta2 = "select * from vendedor where cod_vendedor = $cod_vendedor"; 
				 $result2 = mysql_query($consulta2);            
				 $registro2 = mysql_fetch_row($result2);        
				 $nombre_vendedor=$registro2[2];
						
		
				 //====================OBTENGO LA DESCRIPCION DEL RECIBO==========================//
				 $consulta2 = "select * from tipo_talonario inner join talonario on tipo_talonario.cod_talonario = talonario.cod_talonario 
									where talonario.cod_talonario = '$cod_tal_recibo' and talonario.num_talonario = $num_tal_recibo"; 
				 $result2 = mysql_query($consulta2);            
				 $registro2 = mysql_fetch_row($result2);        
				 $desc_recibo=$registro2[1];
				 $suc_recibo=$registro2[5];
		
				 //====================VERIFICO SI SE HAN REALIZADO IMPUTACIONES ================//
				 $nfilas3 = 0;
				 $consulta3 = "select * from cc_vta_detalle where num_recibo = $n_recibo and cod_talonario_recibo ='$cod_tal_recibo' and num_talonario_recibo = $num_tal_recibo"; // consulta sql 
				 $result3 = mysql_query($consulta3);            // hace la consulta
				 $nfilas3 = mysql_num_rows ($result3);          //indica la cantidad de resultados
				 //$registro3 = mysql_fetch_row($result3);        // toma el registro
		
						
				 //-------------------------//
				 $len_num_tal_recibo=strlen($num_tal_recibo); 					// completo el numero de la sucursal con ceros
				 $ceros_3 = '';
				 while ($len_num_tal_recibo < 4){
					$ceros_3.="0";
					$len_num_tal_recibo++;
				 }
				 $num_tal_recibo=$ceros_3.$num_tal_recibo;
				 //-------------------------//
				 $len_num_sucursal_recibo=strlen($suc_recibo); 					// completo el numero de la sucursal con ceros
				 $ceros_2 = '';
				 while ($len_num_sucursal_recibo < 4){
						$ceros_2.="0";
						$len_num_sucursal_recibo++;
				 }
				 $suc_recibo=$ceros_2.$suc_recibo;
				 //-------------------------//
				 $len_n_recibo=strlen($n_recibo); 						// completo el numero de factura con ceros
				 $ceros= '';
				 while ($len_n_recibo < 8){								// completo el numero de la factura con ceros
						$ceros.="0";
						$len_n_recibo++;
				 }
				 $n_recibo=$ceros.$n_recibo;
		
				 //----------------------------------------------------------------------------------------------------------------//				  
				 $ano = substr($fecha_imp,0,4); 
				 $mes = substr($fecha_imp,4,2);
				 $dia = substr($fecha_imp,-2);
				 $fecha_imp = "$dia/$mes/$ano";										// maqueta la fecha para imprimir
				 //----------------------------------------------------------------------------------------------------------------//
					

				 $pdf->Cell(1,3,$num_tal_recibo,0,0);
				 $pdf->SetX(18);
				 $pdf->Cell(1,3,$desc_recibo.' '.$suc_recibo.' '.$n_recibo,0,0);
				 $pdf->SetX(72);
				 $pdf->Cell(10,3,$razon_social,0,0);
				 
				 $pdf->SetX(120);
				 $pdf->Cell(10,3,$cod_vendedor.' - '.$nombre_vendedor,0,0);
				 //$pdf->SetX(109);
				 //$pdf->Cell(10,3,$obs,0,0);

				 //	$consulta22 = "SELECT nombre FROM usuario where usuario = '$usuario_cs'"; // consulta sql
				 //	$result22 = mysql_query($consulta22);            // hace la consulta
				 //	$registro22 = mysql_fetch_row($result22);        // toma el registro
				 //	$usuario_cs = $registro22[0];
				 //$pdf->SetX(120);
				 //$pdf->Cell(10,3,$usuario_cs,0,0);
				 
				 $pdf->SetX(172);
				 $pdf->Cell(1,3,$fecha_imp,0,0);
				 $pdf->SetX(-8);
				 $pdf->Cell(1,3,number_format($importe,2,'.',''),0,1,'R');
				/* 
				 $pdf->SetX(-8);
 							$consulta22 = "SELECT nombre FROM usuario where usuario = '$usuario_cs'"; // consulta sql
							$result22 = mysql_query($consulta22);            // hace la consulta
							$registro22 = mysql_fetch_row($result22);        // toma el registro
							$usuario_cs = $registro22[0];
				 $pdf->Cell(1,3,$usuario_cs,0,1,'R');
				*/	
					$total_importe_recibo = $total_importe_recibo + $importe;
					
		}while($registro = mysql_fetch_array($result)); //end while

		//---------------------- creo el resumen de total de filas------------------------------//
		$pdf->SetFont('Arial','',10); 
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		$pdf->Ln(3);																			//Salto de línea
		$pdf->SetFont('Arial','',8); 
		$pdf->SetX(6);
		$pdf->Cell(0,3,'TOTALES',0,0);
		$pdf->SetX(-8);
		$pdf->Cell(1,3, number_format($total_importe_recibo,2,'.',''),0,0,'R');
	}


if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}


?>
