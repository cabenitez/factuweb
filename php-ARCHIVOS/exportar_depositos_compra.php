<?php
//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "LISTA DE DEPOSITOS";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(6,8,'FECHA - HORA');
$pdf->SetX(40);
$pdf->Cell(10,8,'BANCO');
$pdf->SetX(70);
$pdf->Cell(10,8,'Nº TRANSACCION');
$pdf->SetX(100);
$pdf->Cell(10,8,'Nº CUENTA');
$pdf->SetX(120);
$pdf->Cell(10,8,'TITULAR');
$pdf->SetX(140);
$pdf->Cell(10,8,'IMPORTE');
$pdf->SetX(160);
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
				$id=$registro[0];		
				$fecha_deposito=$registro[1];
			    $fecha_deposito_dia=substr($fecha_deposito,-2);
				$fecha_deposito_mes=substr($fecha_deposito,4,2);
				$fecha_deposito_ano=substr($fecha_deposito,0,4);
				$fecha_deposito= $fecha_deposito_dia.'/'.$fecha_deposito_mes.'/'.$fecha_deposito_ano;
				$hora=strtoupper($registro[2]);
				
				$banco=strtoupper($registro[3]);
				$trans=strtoupper($registro[4]);
				$cta=strtoupper($registro[5]);
				$titular=strtoupper($registro[6]);
				$importe=$registro[7];
				$obs=strtoupper($registro[8]);

				
				$pdf->Cell(0,3 ,$fecha.' - '.$hora,0,0); 		
				$pdf->SetX(40);
				$pdf->Cell(0,3 ,$banco,0,0); 				
				$pdf->SetX(70);
				$pdf->Cell(0,3 ,$trans,0,0); 				
				$pdf->SetX(100);
				$pdf->Cell(0,3 ,$cta,0,0); 				
				$pdf->SetX(120);
				$pdf->Cell(0,3 ,$titular,0,0); 				
				$pdf->SetX(153);
				$pdf->Cell(1,3,number_format($importe,2,'.',''),0,0,'R');
				$pdf->SetX(160);
				$pdf->Cell(0,3 ,$obs,0,1); 				
				$pdf->SetX(6);
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