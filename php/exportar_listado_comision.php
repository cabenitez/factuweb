<?php
//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "INFORME - COMISION DE VENDEDOR";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							

$ano_desde = substr($desde,0,4); 
$mes_desde = substr($desde,4,2);
$dia_desde = substr($desde,-2);
$desde = "$dia_desde/$mes_desde/$ano_desde";										// maqueta la fecha para imprimir

$ano_hasta = substr($hasta,0,4); 
$mes_hasta = substr($hasta,4,2);
$dia_hasta = substr($hasta,-2);
$hasta = "$dia_hasta/$mes_hasta/$ano_hasta";										// maqueta la fecha para imprimir

$pdf->Ln(7);
$pdf->SetFont('Arial','',10);
$pdf->Cell(6,8,'VENDEDOR: '.$cod.' - '.$nombre,0,0);
$pdf->SetX(100);
$pdf->Cell(10,8,'DESDE:   '.$desde.'   HASTA:   '.$hasta,0,1);

$pdf->SetFont('Arial','UB',10);
$pdf->Cell(6,8,'VENTAS SIN BONIFICACION',0,1);
$pdf->SetFont('Arial','',10);
$pdf->SetX(15);
$pdf->Cell(10,8,'IMPORTE VENTA: '.number_format($t_i,2,'.',''),0,1);
$pdf->SetX(15);
$pdf->Cell(10,8,'TOTAL COMISION: '.number_format($t_c,2,'.',''),0,1);

$pdf->SetFont('Arial','UB',10);
$pdf->Cell(6,8,'VENTAS CON BONIFICACION',0,1);
$pdf->SetFont('Arial','',10);
$pdf->SetX(15);
$pdf->Cell(10,8,'IMPORTE VENTA: '.number_format($t_i2,2,'.',''),0,1);
$pdf->SetX(15);
$pdf->Cell(10,8,'TOTAL COMISION: '.number_format($t_c2,2,'.',''),0,1);

$pdf->SetFont('Arial','UB',10);
$pdf->Cell(6,8,'TOTALES',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->SetX(15);
$pdf->Cell(10,8,'IMPORTE VENTA: '.number_format($fa,2,'.',''),0,1);
$pdf->SetX(15);
$pdf->Cell(10,8,'IMPORTE COMISION: '.number_format($per,2,'.',''),0,1);
$pdf->SetX(15);
$pdf->Cell(10,8,'IMPORTE DEVOLUCIONES: '.number_format($t_d,2,'.',''),0,1);



if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}
?>