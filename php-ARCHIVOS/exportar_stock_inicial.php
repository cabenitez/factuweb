<?php
//USAR EN LISTADO DE ARTICULOS


//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "STOCK INICIAL - LISTA DE ARTICULOS";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(6,8,'CODIGO');
$pdf->SetX(25);
$pdf->Cell(10,8,'DESCRIPCION');
$pdf->SetX(181);
$pdf->Cell(10,8,'STOCK INICIAL');

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
				$codigo=$registro[0];
				$descripcion=$registro[1];
				$stock=$registro[2];

				$pdf->Cell(0,3 ,$codigo,0,0); 				
				$pdf->SetX(25);
				$pdf->Cell(0,3 ,$descripcion,0,0); 				
				$pdf->SetX(-15);
				$pdf->Cell(1,3 ,$stock,0,1,'R'); 				
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
$cant_copias = 2;
?>