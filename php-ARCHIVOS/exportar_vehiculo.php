<?php
//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "LISTA DE VEHICULOS";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(6,8,'CODIGO');
$pdf->SetX(20);
$pdf->Cell(10,8,'PATENTE');
$pdf->SetX(40);
$pdf->Cell(10,8,'ACOPLADO');
$pdf->SetX(65);
$pdf->Cell(10,8,'MARCA');
$pdf->SetX(110);
$pdf->Cell(10,8,'MODELO');
$pdf->SetX(160);
$pdf->Cell(10,8,'REPARTIDOR');


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
				$cod= $registro[0];
				$patente=$registro[1];
				$acoplado=$registro[2];
				$marca=$registro[3];
				$modelo=$registro[4];
				
				if($registro[10] != ""){
						$repartidor=$registro[6].' - '.$registro[10];   								
				}else{
						$repartidor=" ";   								
				}
				
				$pdf->Cell(0,3 ,$cod,0,0); 				
				$pdf->SetX(20);
				$pdf->Cell(0,3 ,$patente,0,0); 				
				$pdf->SetX(40);
				$pdf->Cell(0,3 ,$acoplado,0,0); 				
				$pdf->SetX(65);
				$pdf->Cell(0,3 ,$marca,0,0); 				
				$pdf->SetX(110);
				$pdf->Cell(0,3 ,$modelo,0,0); 				
				$pdf->SetX(160);
				$pdf->Cell(0,3 ,$repartidor,0,1); 				
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