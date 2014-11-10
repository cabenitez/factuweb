<?php
//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "CAJA INICIAL";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(6,8,'FECHA');

$pdf->SetX(30);
$pdf->Cell(6,8,'IMPORTE');

$pdf->SetX(60);
$pdf->Cell(10,8,'OBSERVACION');

//---------------------- creo la linea -----------------------------------------------------//
$pdf->Line(7,31,205,31);																// linea
$pdf->Ln(7);																			//Salto de línea

//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
include("conexion.php");

$consulta = ereg_replace("@@","'",$consulta);
$result = mysql_query($consulta);            // hace la consulta
$filas = mysql_num_rows($result);

$pdf->SetFont('Arial','',7);
while($registro = mysql_fetch_array($result)){ 					// obtengo los resultados 
	$fecha_caja=$registro[0];
	$fecha_caja_ano=substr($fecha_caja,0,4);
	$fecha_caja_mes=substr($fecha_caja,4,2);
	$fecha_caja_dia=substr($fecha_caja,-2);
	$fecha_caja = "$fecha_caja_dia/$fecha_caja_mes/$fecha_caja_dia";

	$importe = number_format($registro[1],2,'.','');
	$obs=$registro[2];
				
	$pdf->Cell(0,3 ,$fecha_caja,0,0); 				
	$pdf->SetX(30);
	$pdf->Cell(0,3 ,$importe,0,0); 				
	$pdf->SetX(60);
	$pdf->Cell(0,3 ,$obs,0,1); 				
				
				
}

//---------------------- creo el resumen de total de filas------------------------------//
$pdf->SetFont('Arial','',10); 
$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
$pdf->Ln(1);																			//Salto de línea
$pdf->SetFont('Arial','',8); 
$pdf->SetX(-16);
$pdf->Cell(10,10,"Total de Registros: $filas",0,1,'R');

//---------------------- creo el archivo PDF------------------------------------------------//
if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}




?>