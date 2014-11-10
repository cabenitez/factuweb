<?

//---------------------- Titulo del listado-------------------------------------------------//
$ano = substr($fecha_buscar,0,4); 
$mes = substr($fecha_buscar,4,2);
$dia = substr($fecha_buscar,-2);
$fecha_titulo = "$dia/$mes/$ano";										// maqueta la fecha para imprimir
$titulo = "COMPRAS DEL DIA $fecha_titulo - DETALLE POR PROVEEDOR";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							
	
if($fecha_buscar){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	 $consulta ="select cod_proveedor, SUM(round(subtotal,2)), SUM(round(iva_monto,2)), SUM(round($factura_compra_otros_impuestos,2)), SUM(round(total,2)), n_factura, n_sucursal, fecha_reg, observacion, usuario, id_deposito
				from factura_compra 
				where fecha_fact = $fecha_buscar and cod_proveedor = $cod_proveedor 
				group by n_factura, n_sucursal";

	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados

	if($nfilas > 0){
		//----------------------------------- PDF --------------------------------------------------------------------------------------------//
		$cod_proveedor=$registro[0];
		$consulta2 = "SELECT razon_social FROM proveedor where cod_proveedor = $cod_proveedor"; // consulta sql
		$result2 = mysql_query($consulta2);            // hace la consulta
		$registro2 = mysql_fetch_row($result2);        // toma el registro
		$proveedor = $registro2[0];
		
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(1,3, $proveedor,0,1);
		//---------------------- creo los titulos de las columnas-----------------------------------//
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(6,8,'COMPROBANTE');
		$pdf->SetX(35);
		$pdf->Cell(10,8,'FECHA REG.');
		$pdf->SetX(70);
		$pdf->Cell(10,8,'USUARIO');
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
		$pdf->Line(7,34,205,34);																// linea
		$pdf->Ln(7);																			//Salto de línea

		$pdf->SetFont('Arial','',7);
		do{ 		// obtengo los resultados 
					$total_sin_imp=$registro[1];
					$total_iva=$registro[2];
					$total_otros_imp=$registro[3];
					$total_factura=$registro[4];
					$n_fact=$registro[5];
					$suc=$registro[6];
					$fecha_reg=$registro[7];
					$fecha_reg = substr($fecha_reg,6,2)."/".substr($fecha_reg,4,2)."/".substr($fecha_reg,0,4);
					
					$observacion=$registro[8];
					$usuario=$registro[9];
					$id_deposito=$registro[10];
					
					$total_carga_sin_imp= $total_carga_sin_imp + $total_sin_imp;
					$total_carga_iva = $total_carga_iva + $total_iva;
					$total_carga_otros_imp= $total_carga_otros_imp + $total_otros_imp;
					$total_carga_factura =$total_carga_factura + $total_factura;
										
					$pdf->Cell(1,3,$suc.' '.$n_fact,0,0);
					$pdf->SetX(35);
					$pdf->Cell(1,3,$fecha_reg,0,0);
					$pdf->SetX(70);
					$pdf->Cell(1,3,$usuario,0,0);
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
					$pdf->SetX(-60);
					$pdf->Cell(1,3,number_format($total_carga_sin_imp,2,'.',''),0,0,'R');
					$pdf->SetX(-38);
					$pdf->Cell(1,3,number_format($total_carga_iva,2,'.',''),0,0,'R');
					$pdf->SetX(-25);
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
