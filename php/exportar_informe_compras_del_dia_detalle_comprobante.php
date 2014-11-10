<?

$ano = substr($fecha_buscar,0,4); 
$mes = substr($fecha_buscar,4,2);
$dia = substr($fecha_buscar,-2);
$fecha_titulo = "$dia/$mes/$ano";										// maqueta la fecha para imprimir
//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "COMPRAS DEL DIA $fecha_titulo - DETALLE POR COMPROBANTE";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							
	
//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
include("conexion.php");

// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
$consulta =" select * from factura_compra_detalle where n_factura = $num_fac and n_sucursal = $suc";

$result = mysql_query($consulta);            // hace la consulta
$registro = mysql_fetch_row($result);        // toma el registro
$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados

$pdf->SetFont('Arial','B',8);
$pdf->Cell(1,3,'FACTURA N°: '.$suc.' '.$num_fac,0,0);

$consulta3 = "select razon_social from factura_compra inner join proveedor on factura_compra.cod_proveedor = proveedor.cod_proveedor where n_factura = $num_fac and n_sucursal = $suc"; // consulta sql
$result3 = mysql_query($consulta3);            // hace la consulta
$registro3 = mysql_fetch_row($result3);        // toma el registro
$proveedor = $registro3[0];

$pdf->SetX(60);
$pdf->Cell(1,3,'PROVEEDOR: '.$proveedor,0,1);
//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(6,8,'CODIGO');
$pdf->SetX(22);
$pdf->Cell(10,8,'DESCRIPCION');
$pdf->SetX(120);
$pdf->Cell(10,8,'CANTIDAD');
$pdf->SetX(145);
$pdf->Cell(10,8,'PRECIO UNIT.');
$pdf->SetX(170);
$pdf->Cell(10,8,'% BONIF.');
$pdf->SetX(191);
$pdf->Cell(10,8,'IMPORTE');
//---------------------- creo la linea -----------------------------------------------------//
$pdf->Line(7,34,205,34);																// linea
$pdf->Ln(7);																			//Salto de línea

$pdf->SetFont('Arial','',7);
do{ 		// obtengo los resultados 
	$cod_prod=$registro[0];		
	$cod_variedad=$registro[1];
	$cod_marca=$registro[2];		
	$cod_grupo=$registro[3];
	$cod_proveedor=$registro[6];
	$precio=$registro[7];	
	$cantidad=$registro[8];
	$bonif=$registro[9];
	$importe=$registro[10];

	$cod_producto = $cod_grupo.$cod_marca.$cod_variedad.$cod_prod;
	$consulta2 = "SELECT descripcion FROM producto where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $cod_producto"; // consulta sql
	$result2 = mysql_query($consulta2);            // hace la consulta
	$registro2 = mysql_fetch_row($result2);        // toma el registro
	$desc_producto = $registro2[0];
	
	$precio = number_format($precio,2,'.',''); 				// es para dejar 2 lugares decimales
	$importe = number_format($importe,2,'.',''); 				// es para dejar 2 lugares decimales

	$pdf->Cell(1,3,$cod_producto,0,0);
	$pdf->SetX(22);
	$pdf->Cell(1,3,$desc_producto,0,0);
	$pdf->SetX(-80);
	$pdf->Cell(1,3,$cantidad,0,0,'R');
	$pdf->SetX(-50);
	$pdf->Cell(1,3,$precio,0,0,'R');
	$pdf->SetX(-30);
	$pdf->Cell(1,3,$bonif,0,0,'R');
	$pdf->SetX(-7);
	$pdf->Cell(1,3,$importe,0,1,'R');

	$cant_bulto = $cant_bulto + $cantidad;		 // total de bultos
	$total_importe = $total_importe + $importe; // es para dejar 2 lugares decimales
	$total_importe = number_format($total_importe,2,'.',''); // es para dejar 2 lugares decimales
	
}while($registro = mysql_fetch_array($result)); //end while

//---------------------- creo el resumen de total de filas------------------------------//
$pdf->SetFont('Arial','',10); 
$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
$pdf->Ln(3);																			//Salto de línea
$pdf->SetFont('Arial','',8); 
$pdf->SetX(6);
$pdf->Cell(0,3,'TOTALES',0,0);
$pdf->SetX(-80);
$pdf->Cell(1,3,$cant_bulto,0,0,'R');
$pdf->SetX(-7);
$pdf->Cell(1,3,$total_importe,0,0,'R');

//------------CREA LA FILA DE TOTALES-------------------//
$consulta2 = "SELECT * FROM factura_compra where n_factura = $num_fac and n_sucursal = $suc"; // consulta sql
$result2 = mysql_query($consulta2);            // hace la consulta
$registro2 = mysql_fetch_row($result2);        // toma el registro
											
$subtotal = number_format($registro2[4],2,'.','');
$imp_interno_alicuota = $registro2[5];
$imp_interno_monto = number_format($registro2[6],2,'.',''); 
$iva_alicuota = $registro2[7];
$iva_monto = number_format($registro2[8],2,'.',''); 
$perc_iva_alicuota = $registro2[9];
$perc_iva_monto = number_format($registro2[10],2,'.','');
$pib_alicuota = $registro2[11];
$pib_monto = number_format($registro2[12],2,'.','');
$otros_alicuota = $registro2[13];
$otros_monto = number_format($registro2[14],2,'.',''); 
$total = number_format($registro2[15],2,'.',''); 

//---------------------- creo el resumen de total de filas------------------------------//
$pdf->Ln(5);																			//Salto de línea

$pdf->SetX(150);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1,3,'SUBTOTAL:',0,0);
$pdf->SetX(-7);
$pdf->Cell(1,3,$subtotal,0,1,'R');

$pdf->SetX(150);
$pdf->SetFont('Arial','',8);
$pdf->Cell(1,3,'IVA:',0,0);
$pdf->SetX(-7);
$pdf->Cell(1,3,$iva_monto,0,1,'R');

$pdf->SetFont('Arial','',8); 
$pdf->SetX(150);
$pdf->Cell(1,3,'PERC. IVA:',0,0);
$pdf->SetX(-7);
$pdf->Cell(1,3,$perc_iva_monto,0,1,'R');

$pdf->SetFont('Arial','',8); 
$pdf->SetX(150);
$pdf->Cell(1,3,'PERC. ING. BRUTOS:',0,0);
$pdf->SetX(-7);
$pdf->Cell(1,3,$pib_monto,0,1,'R');

$pdf->SetFont('Arial','',8); 
$pdf->SetX(150);
$pdf->Cell(1,3,'IMP. INTERNO:',0,0);
$pdf->SetX(-7);
$pdf->Cell(1,3,$imp_interno_monto,0,1,'R');

$pdf->SetFont('Arial','B',8); 
$pdf->SetX(150);
$pdf->Cell(1,3,'TOTAL COMPROBANTE:',0,0);
$pdf->SetX(-7);
$pdf->Cell(1,3,$total,0,1,'R');


if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}


?>
