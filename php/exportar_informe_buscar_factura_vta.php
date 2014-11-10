<?

//---------------------- Titulo del listado-------------------------------------------------//
$ano = substr($fecha_buscar,0,4); 
$mes = substr($fecha_buscar,4,2);
$dia = substr($fecha_buscar,-2);
$fecha_titulo = "$dia/$mes/$ano";										// maqueta la fecha para imprimir
$titulo = "DETALLE DE COMPROBANTE";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							
	
if($cod_tal){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
/*	
	$consulta ="select descripcion,n_sucursal, n_factura, razon_social, round(total_sin_impuesto,2), round(iva,2),round(otros_impuestos,2),round(total_general,2), talonario, observacion, cod_talonario, fecha, usuario  FROM
						(
						select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta_no_cliente.n_factura, factura_vta_no_cliente.razon_social,
						round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) as total_sin_impuesto , 
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2) as iva,
						
						/*
						round(imp_interno,2) as imp_int, 
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) as perc_iva,
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2) as ing_bruto,
						* /
						(round(imp_interno,2)  + 
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) as otros_impuestos,
						
			
						(round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2) +
						round(imp_interno,2)  + round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) as total_general,
						(factura_vta_no_cliente.num_talonario)talonario, observacion, factura_vta_no_cliente.cod_talonario,factura_vta_no_cliente.fecha, factura_vta_no_cliente.usuario
						
						from tipo_talonario inner join(talonario inner join (factura_vta_no_cliente inner join factura_vta_no_cliente_detalle  
						on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario)
						on factura_vta_no_cliente.cod_talonario = talonario.cod_talonario  and factura_vta_no_cliente.num_talonario = talonario.num_talonario)
						on talonario.cod_talonario = tipo_talonario.cod_talonario 
						where factura_vta_no_cliente.n_factura = $num_fac and factura_vta_no_cliente.cod_talonario = '$cod_tal' and factura_vta_no_cliente.num_talonario = $num_tal  GROUP BY factura_vta_no_cliente.n_factura 
						
					UNION
						
						select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta.n_factura, cliente.razon_social, 
						round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) as total_sin_impuesto , 
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2) as iva,
						
						/*
						round(imp_interno,2) as imp_int, 
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) as perc_iva,
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2) as ing_bruto,
						* /
						(round(imp_interno,2)  + 
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) as otros_impuestos,
						
						(round(sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100),2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*iva)/100,2) +
						round(imp_interno,2)  + round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*perc_iva)/100,2) +
						round(((sum(cantidad * precio)- sum(((cantidad * precio)* bonificacion)/100))*ing_bruto)/100,2)) as total_general,
						(factura_vta.num_talonario)as talonario, observacion, factura_vta.cod_talonario,factura_vta.fecha,  factura_vta.usuario
						
						from talonario inner join(tipo_talonario inner join(cliente inner join (factura_vta inner join factura_vta_detalle  on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario)
						on factura_vta.cod_cliente = cliente.cod_cliente) on cliente.cod_talonario = tipo_talonario.cod_talonario) on tipo_talonario.cod_talonario = talonario.cod_talonario  and talonario.num_talonario = factura_vta.num_talonario 
						where factura_vta.n_factura = $num_fac and factura_vta.cod_talonario = '$cod_tal' and factura_vta.num_talonario = $num_tal GROUP BY factura_vta.n_factura
				) AS ventas_repartidor ORDER BY descripcion,n_factura";
*/
	$consulta ="select descripcion,n_sucursal, n_factura, razon_social, round(total_sin_impuesto,2), round(iva,2),round(otros_impuestos,2),round(total_general,2), talonario, observacion, cod_talonario, fecha, usuario  FROM
						(
						select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta_no_cliente.n_factura, factura_vta_no_cliente.razon_social,
						
						$calculo_importe_no_cliente
						
						(factura_vta_no_cliente.num_talonario)talonario, observacion, factura_vta_no_cliente.cod_talonario,factura_vta_no_cliente.fecha, factura_vta_no_cliente.usuario
						
						$from_no_cliente
						
						where factura_vta_no_cliente.n_factura = $num_fac and factura_vta_no_cliente.cod_talonario = '$cod_tal' and factura_vta_no_cliente.num_talonario = $num_tal  GROUP BY factura_vta_no_cliente.n_factura 
						
					UNION
						
						select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta.n_factura, cliente.razon_social, 

						$calculo_importe_cliente
						
						(factura_vta.num_talonario)as talonario, observacion, factura_vta.cod_talonario,factura_vta.fecha,  factura_vta.usuario
						
						$from_cliente 
						
						where factura_vta.n_factura = $num_fac and factura_vta.cod_talonario = '$cod_tal' and factura_vta.num_talonario = $num_tal GROUP BY factura_vta.n_factura
				) AS ventas_repartidor ORDER BY descripcion,n_factura";
 					
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
		$pdf->SetX(115);
		$pdf->Cell(10,8,'TOTAL SIN IMPUESTOS');
		$pdf->SetX(150);
		$pdf->Cell(10,8,'IVA');
		$pdf->SetX(160);
		$pdf->Cell(10,8,'OTROS IMPUESTOS');
		$pdf->SetX(193);
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
					
					$fecha_emision = $registro[11];
					$fecha_emision_ano=substr($fecha_emision,0,4);
					$fecha_emision_mes=substr($fecha_emision,4,2);
					$fecha_emision_dia=substr($fecha_emision,-2);
					$fecha_emision = $fecha_emision_dia."/".$fecha_emision_mes."/".$fecha_emision_ano;
					
					$facturador = $registro[12];
					$consulta_facturador = "SELECT nombre FROM usuario where usuario = '$facturador'"; // consulta sql
					$result_facturador = mysql_query($consulta_facturador);            // hace la consulta
					$registro_facturador = mysql_fetch_row($result_facturador);        // toma el registro
					$facturador = $registro_facturador[0];

				if($observacion == 'ANULADO'){
					$razon='COMPROBANTE ANULADO';					
					$total_sin_imp=" ";
					$total_iva=" ";
					$total_otros_imp=" ";
					$total_factura=" ";
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

					}else{
						$razon=$registro[3];
						$total_sin_imp=$registro[4];
						$total_iva=$registro[5];
						$total_otros_imp=$registro[6];
						$total_factura=$registro[7];
					}
				}	


					$pdf->Cell(1,3,$n_talonario,0,0);
					$pdf->SetX(18);
					$pdf->Cell(1,3,$desc_fac.' '.$suc.' '.$n_fact,0,0);
					$pdf->SetX(60);
					$pdf->Cell(1,3,$razon,0,0);
					$pdf->SetX(-77);
					$pdf->Cell(1,3,$total_sin_imp,0,0,'R');
					$pdf->SetX(-53);
					$pdf->Cell(1,3,$total_iva,0,0,'R');
					$pdf->SetX(-30);
					$pdf->Cell(1,3,$total_otros_imp,0,0,'R');
					$pdf->SetX(-7);
					$pdf->Cell(1,3,$total_factura,0,1,'R');
					
		$pdf->SetFont('Arial','B',8);
		$pdf->Ln(4);
		$pdf->Cell(1,3, 'EMITIDO EL DIA: '.$fecha_emision ,0,1);
		$pdf->Ln(2);
		$pdf->Cell(1,3, 'FACTURADO POR: '.$facturador ,0,1);

		}while($registro = mysql_fetch_array($result)); //end while
	}
	
	
if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}

} // FIN DE if($fecha_buscar){

?>
