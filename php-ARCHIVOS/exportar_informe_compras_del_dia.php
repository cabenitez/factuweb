<?

//---------------------- Titulo del listado-------------------------------------------------//
$ano = substr($fecha_buscar,0,4); 
$mes = substr($fecha_buscar,4,2);
$dia = substr($fecha_buscar,-2);
$fecha_titulo = "$dia/$mes/$ano";										// maqueta la fecha para imprimir
$titulo = "COMPRAS DEL DIA $fecha_titulo";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							
	
if($fecha_buscar){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$consulta ="select cod_proveedor, SUM(round(subtotal,2)), SUM(round(iva_monto,2)), SUM(round($factura_compra_otros_impuestos,2)), SUM(round(total,2))
				from factura_compra 
				where fecha_fact = $fecha_buscar 
				group by cod_proveedor";
						
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados

	if($nfilas > 0){
		//----------------------------------- PDF --------------------------------------------------------------------------------------------//
		//---------------------- creo los titulos de las columnas-----------------------------------//
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(6,8,'PROVEEDOR');
		$pdf->SetX(100);
		$pdf->Cell(10,8,'TOTAL SIN IMPUESTOS');
		$pdf->SetX(140);
		$pdf->Cell(10,8,'IVA');
		$pdf->SetX(155);
		$pdf->Cell(10,8,'OTROS IMPUESTOS');
		$pdf->SetX(194);
		$pdf->Cell(10,8,'TOTAL');
		//---------------------- creo la linea -----------------------------------------------------//
		$pdf->Line(7,31,205,31);																// linea
		$pdf->Ln(7);																			//Salto de l�nea

		$pdf->SetFont('Arial','',7);
		do{ 		// obtengo los resultados 
					$cod_proveedor=$registro[0];
					$consulta2 = "SELECT razon_social FROM proveedor where cod_proveedor = $cod_proveedor"; // consulta sql
					$result2 = mysql_query($consulta2);            // hace la consulta
					$registro2 = mysql_fetch_row($result2);        // toma el registro
					$proveedor = $registro2[0];
						
					$total_sin_imp=$registro[1];
					$total_iva=$registro[2];
					$total_otros_imp=$registro[3];
					$total_factura=$registro[4];
					
					$pdf->Cell(1,3,$proveedor,0,0);
					$pdf->SetX(-90);
					$pdf->Cell(1,3,$total_sin_imp,0,0,'R');
					$pdf->SetX(-63);
					$pdf->Cell(1,3,$total_iva,0,0,'R');
					$pdf->SetX(-40);
					$pdf->Cell(1,3,$total_otros_imp,0,0,'R');
					$pdf->SetX(-7);
					$pdf->Cell(1,3,$total_factura,0,1,'R');

					$total_carga_sin_imp= $total_carga_sin_imp + $total_sin_imp;
					$total_carga_iva = $total_carga_iva + $total_iva;
					$total_carga_otros_imp= $total_carga_otros_imp + $total_otros_imp;
					$total_carga_factura = $total_carga_factura + $total_factura;

		}while($registro = mysql_fetch_array($result)); //end while

		//---------------------- creo el resumen de total de filas------------------------------//
		$pdf->SetFont('Arial','',10); 
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		$pdf->Ln(3);																			//Salto de l�nea
		$pdf->SetFont('Arial','',8); 
		$pdf->SetX(6);
		$pdf->Cell(0,3,'TOTALES',0,0);
					$pdf->SetX(-90);
					$pdf->Cell(1,3,number_format($total_carga_sin_imp,2,'.',''),0,0,'R');
					$pdf->SetX(-63);
					$pdf->Cell(1,3,number_format($total_carga_iva,2,'.',''),0,0,'R');
					$pdf->SetX(-40);
					$pdf->Cell(1,3,number_format($total_carga_otros_imp,2,'.',''),0,0,'R');
					$pdf->SetX(-7);
					$pdf->Cell(1,3,number_format($total_carga_factura,2,'.',''),0,1,'R');
	}
	
	
if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}

} // FIN DE if($fecha_buscar){

?>
