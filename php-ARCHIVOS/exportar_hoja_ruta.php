<?php
//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "HOJA DE RUTA";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							
//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
include("conexion.php");

$consulta2 ="select zona.nombre from zona where cod_zona = $zona";
$result2 = mysql_query($consulta2);            // hace la consulta
$reg2 = mysql_fetch_row($result2);
$nombre_zona= $reg2[0];

$pdf->SetFont('Arial','B',8);
$pdf->Cell(1,3, 'ZONA: '.$nombre_zona,0,1);

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,8,'ORDEN');
$pdf->SetX(20);
$pdf->Cell(6,8,'COD.');
$pdf->SetX(35);
$pdf->Cell(10,8,'RAZON SOCIAL');
$pdf->SetX(90);
$pdf->Cell(10,8,'DIRECCION');
$pdf->SetX(150);
$pdf->Cell(10,8,'LOCALIDAD');

//---------------------- creo la linea -----------------------------------------------------// 
$pdf->Line(7,34,205,34);																// linea
$pdf->Ln(7);																			//Salto de línea

$consulta_faltantes = $consulta." AND activo = 'S' AND orden = 0";

$consulta = $consulta." AND activo = 'S' AND orden > 0 order by orden ASC";

$consulta = ereg_replace("@@","'",$consulta);
$result = mysql_query($consulta);            // hace la consulta
$filas = mysql_num_rows($result);

$pdf->SetFont('Arial','',7);
while($registro = mysql_fetch_array($result)){ 					// obtengo los resultados 
				$codigo=$registro[0];		
				$cod_localidad=$registro[1];
				$razon=$registro[2];
				$dir=$registro[3];	
				$orden=$registro[4]; 
				$activo=$registro[5]; 
				$vendedor=$registro[6]; 
				
				$consulta_loca ="select nombre from localidad where cod_localidad = $cod_localidad";
				$result_loca = mysql_query($consulta_loca);            // hace la consulta
				$reg = mysql_fetch_row($result_loca);        	// toma el registro
				$localidad= $reg[0];
				
				$pdf->Cell(0,3 ,$orden,0,0); 	
				$pdf->SetX(20);
				$pdf->Cell(0,3 ,$codigo,0,0); 				
				$pdf->SetX(35);
				$pdf->Cell(0,3 ,$razon,0,0); 				
				$pdf->SetX(90);
				$pdf->Cell(0,3 ,$dir,0,0); 				
				$pdf->SetX(150);
				$pdf->Cell(0,3 ,$localidad,0,1); 								
}

//---------------------- creo el resumen de total de filas------------------------------//
$pdf->SetFont('Arial','',10); 
$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L'); 
$pdf->Ln(1);																			//Salto de línea
$pdf->SetFont('Arial','',8); 
$pdf->SetX(-16);
$pdf->Cell(10,10,"Total de Registros: $filas",0,1,'R');


//------- creo el resumen de total de clientes sin orden en la hoja de ruta ----//
$consulta_faltantes = ereg_replace("@@","'",$consulta_faltantes);
$result_faltantes = mysql_query($consulta_faltantes);            // hace la consulta
$filas_faltantes = mysql_num_rows($result_faltantes);
$pdf->Ln(5);																			//Salto de línea

$pdf->SetFont('Arial','',10); 
$pdf->Cell(0,0,"CLIENTES SIN ORDEN DE RECORRIDO: $filas_faltantes",0,0); 


//---------------------- creo el archivo PDF------------------------------------------------//
if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}
?>