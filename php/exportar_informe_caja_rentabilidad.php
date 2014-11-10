<?

//---------------------- Titulo del listado-------------------------------------------------// 
$ano = substr($fecha_desde,0,4); 
$mes = substr($fecha_desde,4,2);
$dia = substr($fecha_desde,-2);
$fecha_desde_titulo = "$dia/$mes/$ano";										// maqueta la fecha para imprimir

$ano = substr($fecha_hasta,0,4); 
$mes = substr($fecha_hasta,4,2);
$dia = substr($fecha_hasta,-2);
$fecha_hasta_titulo = "$dia/$mes/$ano";										// maqueta la fecha para imprimir

$titulo = "INFORME CAJA / RENTABILIDAD - DESDE: ".$fecha_desde_titulo." HASTA ".$fecha_hasta_titulo;

//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
include("conexion.php");

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							
	
//----------------------------------- PDF --------------------------------------------------------------------------------------------//
//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(6,8,'CONCEPTO');
$pdf->SetX(110);
$pdf->Cell(10,8,'TOTAL SIN IMP.');
$pdf->SetX(145);
$pdf->Cell(10,8,'IVA');
$pdf->SetX(163);
$pdf->Cell(10,8,'OTROS IMP.');
$pdf->SetX(193);
$pdf->Cell(10,8,'TOTAL');
//---------------------- creo la linea -----------------------------------------------------//
$pdf->Line(7,31,205,31);																// linea
$pdf->Ln(7);																			//Salto de línea



	//---------------------------------------------------------------------------------------------//
	//--------------------------------------CAJA INICIAL-------------------------------------------//
	//---------------------------------------------------------------------------------------------//
	$consulta ="SELECT fecha, SUM(importe) FROM caja_inicial where fecha >= $fecha_desde and fecha <= $fecha_hasta GROUP BY fecha ORDER BY fecha";
	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$pdf->SetFont('Arial','',7);
	if($filas > 0){
		do{ 					// obtengo los resultados 
			$fecha_caja=$registro[0];
			$fecha_caja_ano=substr($fecha_caja,0,4);
			$fecha_caja_mes=substr($fecha_caja,4,2);
			$fecha_caja_dia=substr($fecha_caja,-2);
			$fecha_caja = "$fecha_caja_dia/$fecha_caja_mes/$fecha_caja_dia";

			$importe = number_format($registro[1],2,'.','');
			
			$pdf->Cell(1,3,'CAJA INICIAL ('.$fecha_caja.')' ,0,0);
			$pdf->SetX(-7);
			$pdf->Cell(1,3,$importe,0,1,'R');
			
			$total_caja_inicial =  $total_caja_inicial + $importe;
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 		
	}

	//---------------------------------------------------------------------------------------------//
	//--------------------------------------VENTAS-------------------------------------------------//
	//---------------------------------------------------------------------------------------------//

	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$consulta =" select  SUM(round(total_sin_impuesto,2)), SUM(round(iva,2)), SUM(round(otros_impuestos,2)), SUM(round(total_general,2))
					FROM(
								select  
								$calculo_importe_no_cliente
								(factura_vta_no_cliente.num_talonario)talonario
								$from_no_cliente
								where fecha >= $fecha_desde and fecha <= $fecha_hasta and observacion <> 'ANULADO' and observacion <> 'N/C' 
								GROUP BY factura_vta_no_cliente_detalle.iva
							UNION ALL
								select 
								$calculo_importe_cliente
								(factura_vta.num_talonario)as talonario
								$from_cliente
								where fecha >= $fecha_desde and fecha <= $fecha_hasta and observacion <> 'ANULADO' and observacion <> 'N/C' 
								GROUP BY factura_vta_detalle.iva
					) AS carga_caja";

	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$pdf->SetFont('Arial','',7);
	do{ 		// obtengo los resultados 
			$total_sin_imp=number_format($registro[0],2,'.','');
			$total_iva=number_format($registro[1],2,'.','');
			$total_otros_imp=number_format($registro[2],2,'.','');
			$total_factura=number_format($registro[3],2,'.','');

			$pdf->Cell(1,3,'VENTAS',0,0);
			
			$pdf->SetX(-80);
			$pdf->Cell(1,3,$total_sin_imp,0,0,'R');
			$pdf->SetX(-58);
			$pdf->Cell(1,3,$total_iva,0,0,'R');
			$pdf->SetX(-35);
			$pdf->Cell(1,3,$total_otros_imp,0,0,'R');
			$pdf->SetX(-7);
			$pdf->Cell(1,3,$total_factura,0,1,'R');
			
			$total_venta_sin_imp= $total_venta_sin_imp + $total_sin_imp;
			$total_venta_iva = $total_venta_iva + $total_iva;
			$total_venta_otros_imp= $total_venta_otros_imp + $total_otros_imp;
			$total_venta_factura = $total_venta_factura + $total_factura;
	}while($registro = mysql_fetch_array($result)); //end while

	//---------------------------------------------------------------------------------------------//
	//--------------------------------------COMPRAS------------------------------------------------//
	//---------------------------------------------------------------------------------------------//

	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$consulta ="select SUM(round(subtotal,2)), SUM(round(iva_monto,2)), SUM(round($factura_compra_otros_impuestos,2)), SUM(round(total,2))
				from factura_compra 
				where fecha_fact >= $fecha_desde and fecha_fact <= $fecha_hasta";

	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$pdf->SetFont('Arial','',7);
	do{ 		// obtengo los resultados 
			$total_sin_imp= number_format($registro[0],2,'.','');
			$total_iva=number_format($registro[1],2,'.','');
			$total_otros_imp=number_format($registro[2],2,'.','');
			$total_factura=number_format($registro[3],2,'.','');

			$pdf->Cell(1,3,'COMPRAS',0,0);
			
			$pdf->SetX(-80);
			$pdf->Cell(1,3,$total_sin_imp,0,0,'R');
			$pdf->SetX(-58);
			$pdf->Cell(1,3,$total_iva,0,0,'R');
			$pdf->SetX(-35);
			$pdf->Cell(1,3,$total_otros_imp,0,0,'R');
			$pdf->SetX(-7);
			$pdf->Cell(1,3,$total_factura,0,1,'R');
			
			$total_compra_sin_imp = $total_compra_sin_imp + $total_sin_imp;
			$total_compra_iva = $total_compra_iva + $total_iva;
			$total_compra_otros_imp= $total_compra_otros_imp + $total_otros_imp;
			$total_compra_factura = $total_compra_factura + $total_factura;
	}while($registro = mysql_fetch_array($result)); //end while

	//---------------------------------------------------------------------------------------------//
	//--------------------------------------GASTOS-------------------------------------------------//
	//---------------------------------------------------------------------------------------------//

	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$consulta ="SELECT SUM(round(importe,2)), SUM(round(iva,2)), SUM(round(otros_impuestos,2)), SUM(round(total,2)) FROM gastos where fecha >= $fecha_desde and fecha <= $fecha_hasta";

	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$pdf->SetFont('Arial','',7);
	do{ 		// obtengo los resultados 
			$importe=number_format($registro[0],2,'.','');
			$iva=number_format($registro[1],2,'.','');
			$otros_imp=number_format($registro[2],2,'.','');
			$total=number_format($registro[3],2,'.','');

			$pdf->Cell(1,3,'GASTOS',0,0);
			
			$pdf->SetX(-80);
			$pdf->Cell(1,3,$importe,0,0,'R');
			$pdf->SetX(-58);
			$pdf->Cell(1,3,$iva,0,0,'R');
			$pdf->SetX(-35);
			$pdf->Cell(1,3,$otros_imp,0,0,'R');
			$pdf->SetX(-7);
			$pdf->Cell(1,3,$total,0,1,'R');
			
			$total_gasto_importe = $total_gasto_importe + $importe;
			$total_gasto_iva = $total_gasto_iva + $iva;
			$total_gasto_otros_imp= $total_gasto_otros_imp + $otros_imp;
			$total_gasto_total = $total_gasto_total + $total;
	}while($registro = mysql_fetch_array($result)); //end while


//---------------------- creo el resumen de total de filas------------------------------//
$pdf->SetFont('Arial','',10); 
$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
$pdf->Ln(10);																			//Salto de línea
$pdf->SetFont('Arial','',8); 

//---------------------------------------------------------------------------------------------//
//--------------------------------------CAJA / RENTABILIDAD------------------------------------//
//---------------------------------------------------------------------------------------------//
$caja = number_format($total_caja_inicial + $total_venta_factura - $total_compra_factura - $total_gasto_total,2,'.','');
$rentabilidad = number_format($total_caja_inicial + $total_venta_sin_imp - $total_compra_sin_imp - $total_gasto_importe,2,'.','');
		
$pdf->SetX(6);
$pdf->Cell(0,3,'CAJA',0,0);
$pdf->SetX(-7);
$pdf->Cell(1,3,$caja,0,1,'R');

$pdf->Cell(0,3,'RENTABILIDAD',0,0);
$pdf->SetX(-7);
$pdf->Cell(1,3,$rentabilidad,0,1,'R');

	
if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}

?>