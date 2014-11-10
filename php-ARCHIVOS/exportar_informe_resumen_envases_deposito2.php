<?
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$consulta1 ="SELECT codigo, cantidad FROM
						(
						SELECT 
						concat(cod_grupo,cod_marca,cod_variedad,cod_prod) AS codigo, cantidad 
						FROM factura_vta_no_cliente INNER JOIN factura_vta_no_cliente_detalle  
						ON factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario 
						
						WHERE factura_vta_no_cliente.cod_talonario = '$cod_tal'
						AND  factura_vta_no_cliente.num_talonario = $num_tal
						AND  factura_vta_no_cliente.n_factura = $num_fact
					UNION
						SELECT 
						concat(cod_grupo,cod_marca,cod_variedad,cod_prod)AS codigo, cantidad
						FROM factura_vta INNER JOIN factura_vta_detalle 
						ON factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario 
						
						WHERE factura_vta.cod_talonario = '$cod_tal'
						AND factura_vta.num_talonario = $num_tal
						AND factura_vta.n_factura = $num_fact
				) AS detalle_factura ";
	
	$result1 = mysql_query($consulta1);            // hace la consulta
	$registro1 = mysql_fetch_row($result1);        // toma el registro
	$nfilas1 = mysql_num_rows ($result1);          //indica la cantidad de resultados

	if($nfilas1 > 0){
		//----------------------------------- PDF --------------------------------------------------------------------------------------------//
		//-------------------------//
		$len_n_talonario=strlen($num_tal); 					// completo el numero de la sucursal con ceros
		$ceros_3 = '';
		while ($len_n_talonario < 4){
				$ceros_3.="0";
				$len_n_talonario++;
		}
		$num_tal=$ceros_3.$num_tal;
		//-------------------------//
		$len_num_sucursal=strlen($suc); 					// completo el numero de la sucursal con ceros
		$ceros_2 = '';
		while ($len_num_sucursal < 4){
				$ceros_2.="0";
				$len_num_sucursal++;
		}
		$suc=$ceros_2.$suc;
		//-------------------------//
		$len_num_factura=strlen($num_fac); 						// completo el numero de factura con ceros
		$ceros= '';
		while ($len_num_factura < 8){								// completo el numero de la factura con ceros
				$ceros.="0";
				$len_num_factura++;
		}
		$num_fac=$ceros.$num_fac;

		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(0,0, $num_tal.' - ' .$desc_fac.' '.$suc.' '.$num_fac.'                              CLIENTE: '.$razon.'                              REPARTIDOR: '.$observacion ,0,1);
		$pdf->Ln(5);
		//---------------------- creo los titulos de las columnas-----------------------------------//
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(0,0,'CODIGO');
		$pdf->SetX(22);
		$pdf->Cell(0,0,'DESCRIPCION');
		$pdf->SetX(118);
		$pdf->Cell(0,0,'BULTOS');
		$pdf->SetX(137);
		$pdf->Cell(0,0,'ENVASES');
		$pdf->SetX(158);
		$pdf->Cell(0,0,'CAJONES');
		//---------------------- creo la linea -----------------------------------------------------//
		$pdf->SetFont('Arial','',10); 
		$pdf->SetX(6);
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		$pdf->Ln(2);																			//Salto de línea
		
		$pdf->SetFont('Arial','',7);
		do{ 		// obtengo los resultados					
					$codigo=$registro1[0];		
					$cantidad=$registro1[1];
					
					$consulta2 = "SELECT descripcion, peso, envase, unidad_bulto FROM producto where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $codigo"; // % DE IVA
					$result2 = mysql_query($consulta2);            
					$registro2 = mysql_fetch_row($result2);        
					$descripcion=$registro2[0];
					$peso=$registro2[1];
					$envase=$registro2[2];
					$unidad_bulto=$registro2[3];
							

					$envases= 0;
					if($envase == "SI"){
						$envases= $cantidad * $unidad_bulto;
						
						$cajon = round($cantidad);
						if($cantidad > $cajon){
								$cajon++;
						}
						
						$pdf->Cell(1,3,$codigo,0,0);
						$pdf->SetX(22);
						$pdf->Cell(1,3,$descripcion,0,0);
						$pdf->SetX(-87);
						$pdf->Cell(1,3,$cantidad,0,0);
						$pdf->SetX(-63);
						$pdf->Cell(1,3,$envases,0,0,'R');
						$pdf->SetX(-43);
						$pdf->Cell(1,3,$cajon,0,1,'R');
						
						$total_cantidad= $total_cantidad + $cantidad;
						$total_cajon= $total_cajon + $cajon;
						$total_envases= $total_envases+$envases;
					}
		}while($registro1 = mysql_fetch_array($result1)); //end while

		//---------------------- creo el resumen de total de filas------------------------------//
		$pdf->SetFont('Arial','',10); 
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		$pdf->Ln(3);																			//Salto de línea
		$pdf->SetFont('Arial','',8); 
		$pdf->SetX(6);
		$pdf->Cell(0,3,'TOTALES',0,0);
		$pdf->SetX(-84);
		$pdf->Cell(1,3,$total_cantidad,0,0,'R');
		$pdf->SetX(-63);
		$pdf->Cell(1,3,$total_envases,0,0,'R');
		$pdf->SetX(-43);
		$pdf->Cell(1,3,$total_cajon,0,1,'R');
		$pdf->Ln(5);
		$total_cantidad= 0;
		$total_cajon = 0;
		$total_envases = 0;
	}
?>