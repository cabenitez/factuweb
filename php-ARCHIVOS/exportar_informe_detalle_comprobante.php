<?

//---------------------- Titulo del listado-------------------------------------------------//
$ano = substr($fecha_buscar,0,4); 
$mes = substr($fecha_buscar,4,2);
$dia = substr($fecha_buscar,-2);
$fecha_titulo = "$dia/$mes/$ano";										// maqueta la fecha para imprimir
$titulo = "DETALLE DE COMPROBANTE $fecha_titulo";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							
	
if($fecha_buscar){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
		$consulta =" select descripcion,n_sucursal, n_factura, razon_social, sum(round(total_sin_impuesto,2)), sum(round(iva,2)),sum(round(otros_impuestos,2)),sum(round(total_general,2)), talonario, observacion, cod_talonario  FROM
						(
						select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta_no_cliente.n_factura, factura_vta_no_cliente.razon_social,

						$calculo_importe_no_cliente		
						
						(factura_vta_no_cliente.num_talonario)talonario, observacion, factura_vta_no_cliente.cod_talonario
						
						$from_no_cliente
						
						where fecha = $fecha_buscar
						
						-- and observacion <> 'ANULADO' and observacion <> 'N/C'
						
						GROUP BY factura_vta_no_cliente_detalle.iva, factura_vta_no_cliente.cod_talonario, factura_vta_no_cliente.num_talonario, factura_vta_no_cliente.n_factura
						
					UNION ALL
						select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta.n_factura, cliente.razon_social as nombre, 
							
						$calculo_importe_cliente
							
						(factura_vta.num_talonario)as talonario, observacion, factura_vta.cod_talonario
						
						$from_cliente
						
						where fecha = $fecha_buscar
						
						-- and observacion <> 'ANULADO' 
						
						GROUP BY factura_vta_detalle.iva, factura_vta.cod_talonario, factura_vta.num_talonario, factura_vta.n_factura
						
				) AS ventas_repartidor GROUP BY cod_talonario, talonario, n_factura ORDER BY descripcion,n_factura ";

		
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados

	if($nfilas > 0){
		//----------------------------------- PDF --------------------------------------------------------------------------------------------//
		//---------------------- creo los titulos de las columnas-----------------------------------//
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(6,8,'Nº TAL.');
		$pdf->SetX(18);
		$pdf->Cell(10,8,'COMPROBANTE');
		$pdf->SetX(60);
		$pdf->Cell(10,8,'CLIENTE');
		$pdf->SetX(100);
		$pdf->Cell(10,8,'OBSERVACION');
				
		$pdf->SetX(135);
		$pdf->Cell(10,8,'TOTAL SIN IMP.');
		$pdf->SetX(165);
		$pdf->Cell(10,8,'IVA');
		$pdf->SetX(175);
		$pdf->Cell(10,8,'OTROS IMP.');
		$pdf->SetX(195);
		$pdf->Cell(10,8,'TOTAL');
		//---------------------- creo la linea -----------------------------------------------------//
		$pdf->Line(7,31,205,31);																// linea
		$pdf->Ln(7);																			//Salto de línea

		$pdf->SetFont('Arial','',7);
		do{ 		// obtengo los resultados 
					$n_talonario = $registro[8];
					
					$len_n_talonario=strlen($n_talonario); 					// completo el numero de la sucursal con ceros
					$ceros_3 = '';
					while ($len_n_talonario < 4){
							$ceros_3.="0";
							$len_n_talonario++;
					}
					$n_talonario=$ceros_3.$n_talonario;
			
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
					$cod_talonario = $registro[10];
					/*
					if($observacion == 'ANULADO'){
						$razon='COMPROBANTE ANULADO';					
						$total_sin_imp=" ";
						$total_iva=" ";
						$total_otros_imp=" ";
						$total_factura=" ";
					}else{
						$razon=$registro[3];
						$total_sin_imp=$registro[4];
						$total_iva=$registro[5];
						$total_otros_imp=$registro[6];
						$total_factura=$registro[7];
					}
					*/
					
				if($observacion == 'ANULADO'){
					$razon='COMPROBANTE ANULADO';					
					$total_sin_imp=" ";
					$total_iva=" ";
					$total_otros_imp=" ";
					$total_factura=" ";
					$obs=" ";
				}else{
					if($observacion == 'N/C'){
						$razon=$registro[3];
						$total_sin_imp=-$registro[4];
						$total_iva=-$registro[5];
						$total_otros_imp=$registro[6];
						if($registro[6] > 0){
							$total_otros_imp=-$registro[6];
						}
						$total_factura=-$registro[7];
						$desc_fac = "NC ".$cod_talonario;
						$obs=" ";
					}else{
						$razon=$registro[3];
						$total_sin_imp=$registro[4];
						$total_iva=$registro[5];
						$total_otros_imp=$registro[6];
						$total_factura=$registro[7];
						$obs=$observacion; 

						$total_carga_sin_imp= $total_carga_sin_imp + $total_sin_imp;
					 	$total_carga_iva = $total_carga_iva + $total_iva;
						$total_carga_otros_imp= $total_carga_otros_imp + $total_otros_imp;
						$total_carga_factura =$total_carga_factura + $total_factura;

					}
				}	


					$pdf->Cell(1,3,$n_talonario,0,0);
					$pdf->SetX(18);
					$pdf->Cell(1,3,$desc_fac.' '.$suc.' '.$n_fact,0,0);
					$pdf->SetX(60);
					$pdf->Cell(1,3,$razon,0,0);
					$pdf->SetX(100);
					$pdf->Cell(1,3,$obs,0,0);
					$pdf->SetX(-60);
					$pdf->Cell(1,3,$total_sin_imp,0,0,'R');
					$pdf->SetX(-38);
					$pdf->Cell(1,3,$total_iva,0,0,'R');
					$pdf->SetX(-25);
					$pdf->Cell(1,3,$total_otros_imp,0,0,'R');
					$pdf->SetX(-7);
					$pdf->Cell(1,3,$total_factura,0,1,'R');
					

		}while($registro = mysql_fetch_array($result)); //end while

		//---------------------- creo el resumen de total de filas------------------------------//
		$pdf->SetFont('Arial','',10); 
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		$pdf->Ln(3);																			//Salto de línea
		$pdf->SetFont('Arial','',8); 
		$pdf->SetX(6);
		$pdf->Cell(0,3,'TOTALES',0,0);
					$total_carga_sin_imp= number_format($total_carga_sin_imp,2,'.','');
					$total_carga_iva = number_format($total_carga_iva,2,'.','');
					$total_carga_otros_imp= number_format($total_carga_otros_imp,2,'.','');
					$total_carga_factura = number_format($total_carga_factura,2,'.','');


					$pdf->SetX(-60);
					$pdf->Cell(1,3,$total_carga_sin_imp,0,0,'R');
					$pdf->SetX(-38);
					$pdf->Cell(1,3,$total_carga_iva,0,0,'R');
					$pdf->SetX(-25);
					$pdf->Cell(1,3,$total_carga_otros_imp,0,0,'R');
					$pdf->SetX(-7);
					$pdf->Cell(1,3,$total_carga_factura,0,1,'R');
	}
	
	
if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}

} // FIN DE if($fecha_buscar){

?>
