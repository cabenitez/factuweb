<?php

//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "LISTA DE CLIENTES";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(6,8,'COD.');
$pdf->SetX(15);
$pdf->Cell(10,8,'RAZON SOCIAL');
$pdf->SetX(63);
$pdf->Cell(10,8,'DIRECCION');
$pdf->SetX(105);
$pdf->Cell(10,8,'CUIT');
$pdf->SetX(125);
$pdf->Cell(10,8,'ZONA');
$pdf->SetX(146);
$pdf->Cell(10,8,'LOCAL.');
$pdf->SetX(158);
$pdf->Cell(10,8,'PROV.');
$pdf->SetX(169);
$pdf->Cell(10,8,'TELEFONO');
$pdf->SetX(189);
$pdf->Cell(10,8,'VEN.');
$pdf->SetX(197);
$pdf->Cell(10,8,'REP.');

//---------------------- creo la linea -----------------------------------------------------//
$pdf->Line(7,31,205,31);																// linea
$pdf->Ln(7);																			//Salto de línea

//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//


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
				
				$cuit=$registro[11];
				if($cuit != ''){
					$cuit1=substr($cuit,0,2);
					$cuit2=substr($cuit,2,-1);
					$cuit3=substr($cuit,-1);
					$cuit= $cuit1.'-'.$cuit2.'-'.$cuit3;
				}
				
				$consulta2 ="select zona.nombre from zona where cod_zona = $zona";
				$result2 = mysql_query($consulta2);            // hace la consulta
				$reg2 = mysql_fetch_row($result2);
				$zona= $reg2[0];
				
				/*
				$consulta3 ="select localidad.nombre from localidad where cod_localidad = $loca";
				$result3 = mysql_query($consulta3);            // hace la consulta
				$reg3 = mysql_fetch_row($result3);        	// toma el registro
				$loca= $reg3[0];

				$consulta4 ="select provincia.nombre from provincia where cod_prov = $prov";
				$result4 = mysql_query($consulta4);            // hace la consulta
				$reg4 = mysql_fetch_row($result4);        	// toma el registro
				$prov= $reg4[0];
				*/		

				$pdf->Cell(0,3 ,$cod,0,0); 				
				$pdf->SetX(15);
				$pdf->Cell(0,3 ,$razon,0,0); 				
				$pdf->SetX(63);
				$pdf->Cell(0,3 ,$dir,0,0); 				
				$pdf->SetX(105);
				$pdf->Cell(0,3 ,$cuit,0,0); 				
				$pdf->SetX(148);
				$pdf->Cell(0,3 ,$loca,0,0); 				
				$pdf->SetX(125);
				$pdf->Cell(0,3 ,$zona,0,0); 				
				$pdf->SetX(160);
				$pdf->Cell(0,3 ,$prov,0,0); 				
				$pdf->SetX(169);
				$pdf->Cell(0,3 ,$tel,0,0);
				$pdf->SetX(191);
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


//================== REFERENCIAS================//

// PROVINCIAS // 
$pdf->SetFont('Arial','',8); 
$pdf->Cell(10,10,"PROVINCIAS:",0,1);

$consulta = ' select distinct(provincia.cod_prov), provincia.nombre from provincia inner join (localidad inner join (zona inner join cliente on cliente.cod_zona = zona.cod_zona) on zona.cod_localidad = localidad.cod_localidad) on localidad.cod_prov = provincia.cod_prov';
$result = mysql_query($consulta);            // hace la consulta

$pdf->SetFont('Arial','',8);
while($registro = mysql_fetch_array($result)){ 					// obtengo los resultados 
	$cod= $registro[0];
	$nombre=$registro[1];
	$pdf->Cell(0,3 ,$cod,0,0); 				
	$pdf->SetX(15);
	$pdf->Cell(0,3 ,$nombre,0,1); 				
}

$pdf->Ln(6);

// LOCALIDADES // 
$pdf->SetFont('Arial','',8); 
$pdf->Cell(10,10,"LOCALIDADES:",0,1);

$consulta = 'select distinct(localidad.cod_localidad), localidad.nombre from localidad inner join cliente on localidad.cod_localidad = cliente.cod_localidad order by localidad.cod_localidad';
$result = mysql_query($consulta);            // hace la consulta

$pdf->SetFont('Arial','',8);
while($registro = mysql_fetch_array($result)){ 					// obtengo los resultados 
	$cod= $registro[0];
	$nombre=$registro[1];
	$pdf->Cell(0,3 ,$cod,0,0); 				
	$pdf->SetX(15);
	$pdf->Cell(0,3 ,$nombre,0,1); 				
}

//---------------------- creo el archivo PDF------------------------------------------------//
if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}
?>
