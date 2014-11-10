<?php
//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "LISTA DE TALONARIOS";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(6,8,'COMPROBANTE');
$pdf->SetX(65);
$pdf->Cell(10,8,'NUMERO');
$pdf->SetX(95);
$pdf->Cell(10,8,'PRIMER Nº');
$pdf->SetX(125);
$pdf->Cell(10,8,'SIG. Nº');
$pdf->SetX(155);
$pdf->Cell(10,8,'ULTIMO Nº');
$pdf->SetX(185);
$pdf->Cell(10,8,'FECHA VENC.');



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
				$numero=$registro[1];
				$n_sucursal=$registro[2];
				$primer=$registro[5];
				$ultimo=$registro[6];
				$siguiente=$registro[7];
			    $dia = substr($registro[8], 0, 2);  // dia
				$mes = substr($registro[8], 2, 2);  // mes
				$ano = substr($registro[8], 4, 4);  // año
				$fecha=$dia."/".$mes."/".$ano;
				$comprobante=$registro[11];

				$len_numero=strlen($numero); 					// completo el numero de la sucursal con ceros
				while ($len_numero < 8){								// completo el numero de la factura con ceros
						$ceros.="0";
						$len_numero++;
				}
				$numero=$ceros.$numero;
				$ceros="";
					
				$len_num_sucursal=strlen($n_sucursal); 					// completo el numero de la sucursal con ceros
				while ($len_num_sucursal < 4){
						$ceros_2.="0";
						$len_num_sucursal++;
				}
				$n_sucursal=$ceros_2.$n_sucursal;
				$ceros_2="";
				
				$len_primer=strlen($primer); 					// completo el numero de la sucursal con ceros
				while ($len_primer < 8){								// completo el numero de la factura con ceros
						$ceros_3.="0";
						$len_primer++;
				}
				$primer=$ceros_3.$primer;
				$ceros_3="";
					
				$len_ultimo=strlen($ultimo); 					// completo el numero de la sucursal con ceros
				while ($len_ultimo < 8){
						$ceros_4.="0";
						$len_ultimo++;
				}
				$ultimo=$ceros_4.$ultimo;
				$ceros_4="";

				$len_siguiente=strlen($siguiente); 					// completo el numero de la sucursal con ceros
				while ($len_siguiente < 8){
						$ceros_5.="0";
						$len_siguiente++;
				}
				$siguiente=$ceros_5.$siguiente;
				$ceros_5="";

				

				$pdf->Cell(0,3 ,$comprobante,0,0); 				// nombre=;
				$pdf->SetX(65);
				$pdf->Cell(0,3 ,$n_sucursal.'-'.$numero,0,0); 				// nombre=;
				$pdf->SetX(95);
				$pdf->Cell(0,3 ,$primer,0,0); 				// nombre=;
				$pdf->SetX(125);
				$pdf->Cell(0,3 ,$siguiente,0,0); 				// nombre=;
				$pdf->SetX(155);
				$pdf->Cell(0,3 ,$ultimo,0,0); 				// nombre=;
				$pdf->SetX(185);
				$pdf->Cell(0,3 ,$fecha,0,1); 				// nombre=;

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