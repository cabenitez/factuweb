<?php
//USAR EN LISTADO DE ARTICULOS


//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "STOCK ACTUAL";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(6,8,'CODIGO');
$pdf->SetX(20);
$pdf->Cell(10,8,'DESCRIPCION');
$pdf->SetX(80);
$pdf->Cell(10,8,'STOCK');

$pdf->SetX(111);
$pdf->Cell(6,8,'CODIGO');
$pdf->SetX(125);
$pdf->Cell(10,8,'DESCRIPCION');
$pdf->SetX(193);
$pdf->Cell(10,8,'STOCK');

//$pdf->Cell(10,8,'STOCK');

//---------------------- creo la linea -----------------------------------------------------//
$pdf->Line(7,31,205,31);																// linea
$pdf->Ln(7);																			//Salto de línea

//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
include("conexion.php");

$consulta = ereg_replace("@@","'",$consulta);
$result = mysql_query($consulta);            // hace la consulta
$filas = mysql_num_rows($result);

$pdf->SetFont('Arial','',7);
$i=0;
while($registro = mysql_fetch_array($result)){ 					// obtengo los resultados 
				$codigo=$registro[0];
				$cod_variedad = $registro[1];				
				$cod_marca = $registro[2];				
				$cod_grupo = $registro[3];
				$desc=$registro[4];
				$stock=$registro[5];
				$stock_min=$registro[6];
				$stock_max=$registro[7];
				$cod_proveedor=$registro[8];

				$pdf->Cell(1,3 ,$cod_grupo.$cod_marca.$cod_variedad.$codigo,0,0); 				
				
				$pdf->SetX(20);
				$pdf->Cell(1,3 ,$desc,0,0); 				
				
				$pdf->SetX(-120);
				$pdf->Cell(1,3 ,$stock,0,0,'R');
				$i++;
				//================================================================================================//
				//=====================MUEVO EL PUNTERO DE LA CONSULTA===========================================//
				if($i < $filas){
						$registro = mysql_fetch_array($result);
						
						$codigo=$registro[0];
						$cod_variedad = $registro[1];				
						$cod_marca = $registro[2];				
						$cod_grupo = $registro[3];
						$desc=$registro[4];
						$stock=$registro[5];
						$stock_min=$registro[6];
						$stock_max=$registro[7];
						$cod_proveedor=$registro[8];
				
						$pdf->SetX(112);
						$pdf->Cell(1,3 ,$cod_grupo.$cod_marca.$cod_variedad.$codigo,0,0); 				
						
						$pdf->SetX(125);
						$pdf->Cell(1,3 ,$desc,0,0); 				
								
						$pdf->SetX(-7);
						$pdf->Cell(1,3 ,$stock,0,1,'R');
						$i++;
				}else{
						$pdf->Cell(1,3 ,' ',0,1,'R');
				}	
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