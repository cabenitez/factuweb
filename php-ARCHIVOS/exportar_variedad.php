<?php
//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "LISTA DE VARIEDADES";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(6,8,'CODIGO');

$pdf->SetX(40);
$pdf->Cell(10,8,'VARIEDAD');

$pdf->SetX(100);
$pdf->Cell(10,8,'MARCA');

$pdf->SetX(160);
$pdf->Cell(10,8,'GRUPO');

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
				$codigo=$registro[4];
				$nombre=$registro[5];
				$cod_marca=$registro[2];
				$marca=$registro[3];
				$cod_grupo=$registro[0];
				$grupo=$registro[1];
				
				$pdf->Cell(0,3 ,$codigo,0,0); 				// nombre=;
				$pdf->SetX(40);
				$pdf->Cell(0,3 ,$nombre,0,0); 				// nombre=;
				$pdf->SetX(100);
				$pdf->Cell(0,3 ,$cod_marca.'-'.$marca,0,0); 				// nombre=;
				$pdf->SetX(160);
				$pdf->Cell(0,3 ,$cod_grupo.'-'.$grupo,0,1); 				// nombre=;
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