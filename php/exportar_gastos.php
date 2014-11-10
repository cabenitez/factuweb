<?php
//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "LISTA DE GASTOS";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(6,8,'FECHA - HORA');
$pdf->SetX(40);
$pdf->Cell(10,8,'DESCRIPCION');
$pdf->SetX(100);
$pdf->Cell(10,8,'IMPORTE');
$pdf->SetX(120);
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
				$fecha_gasto=$registro[1];
			    $fecha_gasto_dia=substr($fecha_gasto,-2);
				$fecha_gasto_mes=substr($fecha_gasto,4,2);
				$fecha_gasto_ano=substr($fecha_gasto,0,4);
				$fecha_gasto = $fecha_gasto_dia.'-'.$fecha_gasto_mes.'-'.$fecha_gasto_ano;
				$hora=$registro[2];
				$desc=strtoupper($registro[3]);
				$importe=$registro[4];
				$obs=strtoupper($registro[5]);

				
				$pdf->Cell(0,3 ,$fecha_gasto.' - '.$hora,0,0); 		
				$pdf->SetX(40);
				$pdf->Cell(0,3 ,$desc,0,0); 				
				$pdf->SetX(112);
				$pdf->Cell(1,3,number_format($importe,2,'.',''),0,0,'R');
				$pdf->SetX(120);
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