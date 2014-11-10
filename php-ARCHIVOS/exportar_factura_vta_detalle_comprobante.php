<?
/*
$ano = substr($fecha_buscar,0,4); 
$mes = substr($fecha_buscar,4,2);
$dia = substr($fecha_buscar,-2);
$fecha_titulo = "$dia/$mes/$ano";										// maqueta la fecha para imprimir

 $cod_tal = $_POST['cod_tal'];
 $num_tal = $_POST['num_tal'];
 $num_fac = $_POST['num_fac'];
 $desc_fac = $_POST['desc_fac'];
 $suc = $_POST['suc'];

*/
//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "DETALLE DE COMPROBANTE $fecha_titulo - DETALLE POR COMPROBANTE";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							
	
if($cod_tal){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$consulta ="SELECT * FROM
						(
						SELECT 
						iva, imp_interno, perc_iva, ing_bruto,
						concat(cod_grupo,cod_marca,cod_variedad,cod_prod) AS codigo, cantidad, precio, bonificacion, 
						round((cantidad * precio)- ((cantidad * precio * bonificacion)/100),2) AS importe_bonif,
						round(((cantidad * precio)- ((cantidad * precio * bonificacion)/100)) + ((((cantidad * precio)- ((cantidad * precio * bonificacion)/100)) * iva)/100) ,2) as importe_fila
												
						from factura_vta_no_cliente INNER JOIN factura_vta_no_cliente_detalle  
						ON factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario 
						
						WHERE factura_vta_no_cliente.cod_talonario = '$cod_tal'
						AND  factura_vta_no_cliente.num_talonario = $num_tal
						AND  factura_vta_no_cliente.n_factura = $num_fac
					UNION
						SELECT 
						iva, imp_interno, perc_iva, ing_bruto,	
						concat(cod_grupo,cod_marca,cod_variedad,cod_prod)AS codigo, cantidad, precio, bonificacion, 
						round((cantidad * precio)- ((cantidad * precio * bonificacion)/100),2) AS importe_bonif,
						round(((cantidad * precio)- ((cantidad * precio * bonificacion)/100))+ ((((cantidad * precio)- ((cantidad * precio * bonificacion)/100)) * iva)/100) ,2) as importe_fila
						
						FROM factura_vta INNER JOIN factura_vta_detalle 
						ON factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario 
						
						WHERE factura_vta.cod_talonario = '$cod_tal'
						AND factura_vta.num_talonario = $num_tal
						AND factura_vta.n_factura = $num_fac
				) AS detalle_factura ";
	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados

	if($nfilas > 0){
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
		$pdf->Cell(1,3, $num_tal.' - ' .$desc_fac.' '.$suc.' '.$num_fac,0,1);
		//---------------------- creo los titulos de las columnas-----------------------------------//
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(6,8,'CODIGO');
		$pdf->SetX(22);
		$pdf->Cell(10,8,'DESCRIPCION');
		$pdf->SetX(116);
		$pdf->Cell(10,8,'CANTIDAD');
		$pdf->SetX(135);
		$pdf->Cell(10,8,'PRECIO UNIT.');
		$pdf->SetX(158);
		$pdf->Cell(10,8,'% BONIF.');
		$pdf->SetX(175);
		$pdf->Cell(10,8,'IMPORTE');
		$pdf->SetX(193);
		$pdf->Cell(10,8,'TOTAL');
		//---------------------- creo la linea -----------------------------------------------------//
		$pdf->Line(7,34,205,34);																// linea
		$pdf->Ln(7);																			//Salto de línea
		
		$iva=$registro[0];		
		$imp_int=$registro[1];
		$perc_iva=$registro[2];		
		$ing_bruto=$registro[3];

		$pdf->SetFont('Arial','',7);
		do{ 		// obtengo los resultados 
					$codigo=$registro[4];		
					
					$consulta2 = "SELECT descripcion, peso, envase, unidad_bulto FROM producto where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $codigo"; // % DE IVA
					$result2 = mysql_query($consulta2);            
					$registro2 = mysql_fetch_row($result2);        
					$descripcion=$registro2[0];
					$peso=$registro2[1];
					$envase=$registro2[2];
					$unidad_bulto=$registro2[3];
					
					$cantidad=$registro[5];		
					$precio=$registro[6];
					$bonif=$registro[7];	
					$imp_bonif=$registro[8];
					$importe=$registro[9];
					
					$pdf->Cell(1,3,$codigo,0,0);
					$pdf->SetX(22);
					$pdf->Cell(1,3,$descripcion,0,0);
					$pdf->SetX(-87);
					$pdf->Cell(1,3,$cantidad,0,0);
					$pdf->SetX(-63);
					$pdf->Cell(1,3,number_format($precio,2,'.',''),0,0,'R');
					$pdf->SetX(-43);
					$pdf->Cell(1,3,$bonif,0,0,'R');
					$pdf->SetX(-25);
					$pdf->Cell(1,3,number_format($imp_bonif,2,'.',''),0,0,'R');
					$pdf->SetX(-7);
					$pdf->Cell(1,3,number_format($importe,2,'.',''),0,1,'R');
					
					$total_cantidad= $total_cantidad + $cantidad;
					$total_precio = $total_precio + $precio;
					$total_importe= $total_importe + $imp_bonif;
					$total_fila = $total_fila + $importe;
					$total_peso= $total_peso+($peso * $cantidad);
					
					$total_imp_bonif = $total_imp_bonif + $imp_bonif ;
											
					$total_bonif_fila =  ($total_importe*$bonif)/100;
					$total_bonif=$total_bonif + $total_bonif_fila; // es para dejar 2 lugares decimales

					if($envase == "SI"){
						$total_envases= $total_envases+($cantidad * $unidad_bulto);
					}
					
		}while($registro = mysql_fetch_array($result)); //end while

		//---------------------- creo el resumen de total de filas------------------------------//
		$pdf->SetFont('Arial','',10); 
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		$pdf->Ln(3);																			//Salto de línea
		$pdf->SetFont('Arial','',8); 
		$pdf->SetX(6);
		$pdf->Cell(0,3,'TOTALES',0,0);
		$pdf->SetX(-80);
		$pdf->Cell(1,3,$total_cantidad,0,0,'R');
		$pdf->SetX(-63);
		$pdf->Cell(1,3, number_format($total_precio,2,'.',''),0,0,'R');
		$pdf->SetX(-25);
		$pdf->Cell(1,3, number_format($total_importe,2,'.',''),0,0,'R');
		$pdf->SetX(-7);
		$pdf->Cell(1,3, number_format($total_fila,2,'.',''),0,1,'R');
	}
	//------------CREA LA FILA DE TOTALES-------------------//
	$total_bonif=number_format($total_bonif,2,'.',''); // es para dejar 2 lugares decimales

	$total_tasa_iva = ($total_importe*$iva)/100;
	$total_tasa_iva=number_format($total_tasa_iva,2,'.',''); // es para dejar 2 lugares decimales
	
	$total_monto_imp_int = number_format($imp_int,2,'.','');
	
	$total_tasa_perc_iva = ($total_importe*$perc_iva)/100;
	$total_tasa_perc_iva=number_format($total_tasa_perc_iva,2,'.',''); // es para dejar 2 lugares decimales
	
	$total_tasa_img_bruto = ($total_importe*$ing_bruto)/100;
	$total_tasa_img_bruto=number_format($total_tasa_img_bruto,2,'.',''); // es para dejar 2 lugares decimales

	//---------------------- creo el resumen de total de filas------------------------------//
	$pdf->Ln(5);																			//Salto de línea
	$pdf->SetFont('Arial','',8); 
	$pdf->SetX(100);
	$pdf->Cell(1,3,'IVA:',0,0);
	$pdf->SetX(-62);
	$pdf->Cell(1,3,$total_tasa_iva,0,0,'R');
	
	$pdf->SetX(155);
	$pdf->Cell(1,3,'TOTAL DE BULTOS:',0,0);
	$pdf->SetX(-7);
	$pdf->Cell(1,3,$total_cantidad,0,1,'R');

	$pdf->SetX(100);
	$pdf->Cell(1,3,'PERC. IVA:',0,0);
	$pdf->SetX(-62);
	$pdf->Cell(1,3,$total_tasa_perc_iva,0,0,'R');
	
	$pdf->SetX(155);
	$pdf->Cell(1,3,'TOTAL DE KILOS:',0,0);

	$pdf->SetX(-7);
	$pdf->Cell(1,3,$total_peso,0,1,'R');
	
	$pdf->SetX(100);
	$pdf->Cell(1,3,'PERC. ING. BRUTOS:',0,0);
	$pdf->SetX(-62);
	$pdf->Cell(1,3,$total_tasa_img_bruto,0,0,'R');
						
	if($total_envases == ""){
			$total_envases="-------";
	}
	$pdf->SetX(155);
	$pdf->Cell(1,3,'TOTAL DE ENVASES:',0,0);
	$pdf->SetX(-7);
	$pdf->Cell(1,3,$total_envases,0,1,'R');

	$pdf->SetX(100);
	$pdf->Cell(1,3,'IMP. INTERNO:',0,0);
	$pdf->SetX(-62);
	$pdf->Cell(1,3,$total_monto_imp_int,0,0,'R');

	$pdf->Ln(2);					
	$pdf->SetFont('Arial','B',8); 
	$pdf->SetX(155);
	$pdf->Cell(1,3,'SUBTOTAL:',0,0);
	$pdf->SetX(-7);
	$pdf->Cell(1,3,number_format($total_importe,2,'.',''),0,1,'R');
	
	$pdf->SetFont('Arial','',8); 
	$pdf->SetX(155);
	$pdf->Cell(1,3,'BONIFICACION:',0,0);
	$pdf->SetX(-7);
	$pdf->Cell(1,3,$total_bonif,0,1,'R'); 

	$pdf->SetFont('Arial','B',8); 
	$pdf->SetX(155);
	$pdf->Cell(1,3,'TOTAL COMPROBANTE:',0,0);
	$pdf->SetX(-7);
	$pdf->Cell(1,3,number_format($total_fila,2,'.',''),0,1,'R');


if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}

} // FIN DE if($fecha_buscar){

?>
