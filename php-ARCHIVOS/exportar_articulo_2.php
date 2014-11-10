
<?php
//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "LISTA DE ARTICULOS";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(6,8,'CODIGO');
$pdf->SetX(15);
$pdf->Cell(10,8,'DESCRIPCION');
$pdf->SetX(55);
$pdf->Cell(10,8,'PRECIO COSTO');
$pdf->SetX(88);
$pdf->Cell(10,8,'ZONA');
$pdf->SetX(120);
$pdf->Cell(10,8,'LOCALIDAD');
$pdf->SetX(140);
$pdf->Cell(10,8,'PROVINCIA');
$pdf->SetX(162);
$pdf->Cell(10,8,'TELEFONO');
$pdf->SetX(187);
$pdf->Cell(10,8,'VEN.');
$pdf->SetX(197);
$pdf->Cell(10,8,'REP.');

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
				$zona=$registro[1];
				$loca=$registro[2];   								
				$prov=$registro[3];
				$razon=$registro[6];				
				$tel=$registro[7];
				$dir=$registro[10];
				$ven=$registro[17];
				$rep=$registro[18];
								
				$consulta2= "select zona.nombre, localidad.nombre, provincia.nombre  from provincia inner join (localidad inner join zona on zona.cod_localidad = localidad.cod_localidad)  on provincia.cod_prov = localidad.cod_prov where provincia.cod_prov = $prov and localidad.cod_localidad = $loca and zona.cod_zona = $zona";
 				$result2 = mysql_query($consulta2);            // hace la consulta
				$reg = mysql_fetch_row($result2);        // toma el registro
				$zona=$reg[0];
				$loca= $reg[1];
				$prov=$reg[2];		

				$pdf->Cell(0,3 ,$cod,0,0); 				
				$pdf->SetX(15);
				$pdf->Cell(0,3 ,$razon,0,0); 				
				$pdf->SetX(55);
				$pdf->Cell(0,3 ,$dir,0,0); 				
				$pdf->SetX(88);
				$pdf->Cell(0,3 ,$zona,0,0); 				
				$pdf->SetX(120);
				$pdf->Cell(0,3 ,$loca,0,0); 				
				$pdf->SetX(140);
				$pdf->Cell(0,3 ,$prov,0,0); 				
				$pdf->SetX(162);
				$pdf->Cell(0,3 ,$tel,0,0);
				$pdf->SetX(189);
				$pdf->Cell(0,3 ,$ven,0,0); 				
				$pdf->SetX(199);
				$pdf->Cell(0,3 ,$rep,0,1); 				
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