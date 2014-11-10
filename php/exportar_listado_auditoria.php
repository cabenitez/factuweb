<?php
//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
include("conexion.php");

//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "INFORME DE AUDITORIA - SOLICITADO POR: ".$_SESSION['nombre_usuario'];

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(6,8,'FECHA');
$pdf->SetX(32);
$pdf->Cell(10,8,'USUARIO'); 
$pdf->SetX(50);
$pdf->Cell(10,8,'TABLA');
$pdf->SetX(85);
$pdf->Cell(6,8,'CAMPO');
$pdf->SetX(110);
$pdf->Cell(10,8,'VALOR ANTERIOR');
$pdf->SetX(145);
$pdf->Cell(10,8,'VALOR NUEVO');
$pdf->SetX(193);
$pdf->Cell(10,8,'ACCION');



//---------------------- creo la linea -----------------------------------------------------//
$pdf->Line(7,31,205,31);																// linea
$pdf->Ln(7);																			//Salto de línea

$consulta = ereg_replace("@@","'",$consulta);
$result = mysql_query($consulta);            					// hace la consulta
$filas = mysql_num_rows($result);

$pdf->SetFont('Arial','',7);
$i=0;
while($registro = mysql_fetch_array($result)){ 					// obtengo los resultados 
				$tabla=$registro[0];
				$campo=$registro[1];
				$v_ant=$registro[2];
				$v_act=$registro[3];
				$fecha_hora=$registro[4];
				$usuario=$registro[5];
				$posicion_arroba = strrpos ($usuario, "@"); 		
				$usuario = substr($usuario, 0,$posicion_arroba); 		// obtiene solo la info de la impresora

				$accion=$registro[6];

				$pdf->Cell(0,3 ,$fecha_hora,0,0); 				
				$pdf->SetX(32);
				$pdf->Cell(0,3 ,$usuario,0,0); 				
				$pdf->SetX(50);
				$pdf->Cell(0,3 ,$tabla,0,0);
				$pdf->SetX(85);
				$pdf->Cell(0,3 ,$campo,0,0); 				
				$pdf->SetX(110);
				$pdf->Cell(0,3 ,$v_ant,0,0);
				$pdf->SetX(145);
				$pdf->Cell(0,3 ,$v_act,0,0); 				
				$pdf->SetX(193);
				$pdf->Cell(0,3 ,$accion,0,1);
				
				//$pdf->Cell(0,3 ,' ',0,1,'R');

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