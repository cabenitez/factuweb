<?php
//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "LISTA DE VENDEDORES";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(6,8,'CODIGO');
$pdf->SetX(20);
$pdf->Cell(10,8,'NOMBRE Y APELLIDO');
$pdf->SetX(65);
$pdf->Cell(10,8,'DIRECCION');
$pdf->SetX(100);
$pdf->Cell(10,8,'LOCALIDAD');
$pdf->SetX(130);
$pdf->Cell(10,8,'PROVINCIA');
$pdf->SetX(160);
$pdf->Cell(10,8,'TELEFONO');


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
				$nombre=$registro[2];
				$dir=$registro[3];
				$tel=$registro[4];
				$loca=$registro[5];
				$prov=$registro[6];
								
				$consulta2= "select localidad.nombre, provincia.nombre  from provincia inner join localidad on provincia.cod_prov = localidad.cod_prov where provincia.cod_prov = $prov and localidad.cod_localidad = $loca";
 				$result2 = mysql_query($consulta2);            // hace la consulta
				$reg = mysql_fetch_row($result2);        // toma el registro
				$loca= $reg[0];
				$prov=$reg[1];		

				$pdf->Cell(0,3 ,$cod,0,0); 				
				$pdf->SetX(20);
				$pdf->Cell(0,3 ,$nombre,0,0); 				
				$pdf->SetX(65);
				$pdf->Cell(0,3 ,$dir,0,0); 				
				$pdf->SetX(100);
				$pdf->Cell(0,3 ,$loca,0,0); 				
				$pdf->SetX(130);
				$pdf->Cell(0,3 ,$prov,0,0); 				
				$pdf->SetX(160);
				$pdf->Cell(0,3 ,$tel,0,1); 				

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