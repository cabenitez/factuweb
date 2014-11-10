<?
$ano = substr($fecha_buscar,0,4); 
$mes = substr($fecha_buscar,4,2);
$dia = substr($fecha_buscar,-2);
$fecha_titulo = "$dia/$mes/$ano";										// maqueta la fecha para imprimir

//---------------------- Titulo del listado-------------------------------------------------//
	$titulo = "IMPUTACION DE COBRANZAS";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							
	
if($cod_tal){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$consulta ="SELECT * FROM cc_vta_detalle where num_recibo =$num_fac and cod_talonario_recibo ='$cod_tal' and num_talonario_recibo =$num_tal ";
	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	
	if($filas > 0){
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

		$pdf->SetFont('Arial','',8);
		$pdf->Cell(1,3, 'COMPROBANTE: '. $num_tal.' - ' .$desc_fac.' '.$suc.' '.$num_fac,0,1);
		//---------------------- creo los titulos de las columnas-----------------------------------//
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(6,8,'Nº TAL');
		$pdf->SetX(22);
		$pdf->Cell(10,8,'COMPROBANTE');
		$pdf->SetX(70);
		$pdf->Cell(10,8,'OBSERVACION');
		$pdf->SetX(115);
		$pdf->Cell(10,8,'IMPUTADO POR');
		$pdf->SetX(170);
		$pdf->Cell(10,8,'FECHA');
		$pdf->SetX(190);
		$pdf->Cell(10,8,'IMPORTE');
		
		
		//---------------------- creo la linea -----------------------------------------------------//
		$pdf->Line(7,34,205,34);																// linea
		$pdf->Ln(7);																			//Salto de línea
		
		$pdf->SetFont('Arial','',7);
		do{ 		// obtengo los resultados 

				$n_f=$registro[1];		
				$cod_tal_f=$registro[2];
				$num_tal_f=$registro[3];		
				$importe=$registro[7];
				$fecha_imp=$registro[8];
				$obs=$registro[9];
				$usuario_cs=$registro[10];
				
				//====================OBTENGO LA DESCRIPCION DEL RECIBO==========================//
				$consulta2 = "select * from tipo_talonario inner join talonario on tipo_talonario.cod_talonario = talonario.cod_talonario 
								where talonario.cod_talonario = '$cod_tal_f' and talonario.num_talonario = $num_tal_f"; 
				$result2 = mysql_query($consulta2);            
				$registro2 = mysql_fetch_row($result2);        
				$desc_f=$registro2[1];
				$suc_f=$registro2[5];

				
				//-------------------------//
				$len_num_tal_f=strlen($num_tal_f); 					// completo el numero de la sucursal con ceros
				$ceros_3 = '';
				while ($len_num_tal_f < 4){
						$ceros_3.="0";
						$len_num_tal_f++;
				}
				$num_tal_f=$ceros_3.$num_tal_f;
				//-------------------------//
				$len_num_sucursal_f=strlen($suc_f); 					// completo el numero de la sucursal con ceros
				$ceros_2 = '';
				while ($len_num_sucursal_f < 4){
						$ceros_2.="0";
						$len_num_sucursal_f++;
				}
				$suc_f=$ceros_2.$suc_f;
				//-------------------------//
				$len_n_f=strlen($n_f); 						// completo el numero de factura con ceros
				$ceros= '';
				while ($len_n_f < 8){								// completo el numero de la factura con ceros
						$ceros.="0";
						$len_n_f++;
				}
				$n_f=$ceros.$n_f;

			  //----------------------------------------------------------------------------------------------------------------//				  
			  $ano = substr($fecha_imp,0,4); 
			  $mes = substr($fecha_imp,4,2);
			  $dia = substr($fecha_imp,-2);
			  $fecha_imp = "$dia/$mes/$ano";										// maqueta la fecha para imprimir
			  //----------------------------------------------------------------------------------------------------------------//
					
			 $pdf->Cell(1,3,$num_tal_f,0,0);
		     
			 $pdf->SetX(22);
			 $pdf->Cell(1,3,$desc_f.' '.$suc_f.' '.$n_f,0,0);
			 
			 $pdf->SetX(70);
			 $pdf->Cell(1,3,$obs,0,0); 			 
			 
			 	$consulta22 = "SELECT nombre FROM usuario where usuario = '$usuario_cs'"; // consulta sql
				$result22 = mysql_query($consulta22);            // hace la consulta
				$registro22 = mysql_fetch_row($result22);        // toma el registro
				$usuario_cs = $registro22[0];
			 $pdf->SetX(115);
			 $pdf->Cell(1,3,$usuario_cs,0,0);

			 $pdf->SetX(170);
			 $pdf->Cell(1,3,$fecha_imp,0,0);
			 
			 $pdf->SetX(-7);
			 $pdf->Cell(1,3,number_format($importe,2,'.',''),0,1,'R');
			 
			 
				 
					
			 $total_importe= $total_importe + $importe;
					
		}while($registro = mysql_fetch_array($result)); //end while

		//---------------------- creo el resumen de total de filas------------------------------//
		$pdf->SetFont('Arial','',10); 
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		$pdf->Ln(3);																			//Salto de línea
		$pdf->SetFont('Arial','',8); 
		$pdf->SetX(6);
		$pdf->Cell(0,3,'TOTALES',0,0);
		$pdf->SetX(-7);
		$pdf->Cell(1,3, number_format($total_importe,2,'.',''),0,0,'R');
	}


if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}

} // FIN DE if($fecha_buscar){

?>
