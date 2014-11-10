<?php
//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "CARGA DEL DIA - BULTOS";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------// 
include("conf_listados.php"); 							    							
//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
include("conexion.php");

// Obtiene el detalle de todos los comprobantes Factura Vta Cliente

    $consulta ="select DISTINCT (cod), descripcion, SUM(cant), (SUM(cant)* unidad_bulto)AS total_envase ,envase, grupo, sum(pesos), medida, zona FROM ( 
					select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos, medida, factura_vta.cod_zona as zona 
					
					from factura_vta inner join (factura_vta_detalle inner join producto 
					
					on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
					
					on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario 
					
					where fecha = $fecha_actual and cod_repartidor= $repartidor and observacion <> 'ANULADO' 
				    
					and observacion <> 'N/C' and factura_vta.num_remito = 0 
					
					GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
				UNION ALL
					select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos, medida, factura_vta_no_cliente.cod_zona as zona 
					
					from factura_vta_no_cliente inner join (factura_vta_no_cliente_detalle inner join producto on concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca, factura_vta_no_cliente_detalle.cod_variedad, factura_vta_no_cliente_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
					
					on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario 
					
					where fecha = $fecha_actual and cod_repartidor= $repartidor and observacion <> 'ANULADO' 
					
				   and observacion <> 'N/C' and factura_vta_no_cliente.num_remito = 0 
				   
				   GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
			  
			  ) AS carga_articulos GROUP BY cod ORDER BY medida  DESC"; // grupo, SUM(cant)

/*
			UNION ALL
				select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos, medida, remito_vta.cod_zona as zona from remito_vta inner join (remito_vta_detalle inner join producto on concat(remito_vta_detalle.cod_grupo, remito_vta_detalle.cod_marca, remito_vta_detalle.cod_variedad, remito_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on remito_vta_detalle.num_remito = remito_vta.num_remito where fecha = $fecha_actual and cod_repartidor= $repartidor and observacion <> 'ANULADO' and observacion <> 'N/C' GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
			UNION ALL
				select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos, medida, remito_vta_no_cliente.zona as zona from remito_vta_no_cliente inner join (remito_vta_detalle_no_cliente inner join producto on concat(remito_vta_detalle_no_cliente.cod_grupo, remito_vta_detalle_no_cliente.cod_marca, remito_vta_detalle_no_cliente.cod_variedad, remito_vta_detalle_no_cliente.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on remito_vta_detalle_no_cliente.num_remito = remito_vta_no_cliente.num_remito where fecha = $fecha_actual and cod_repartidor= $repartidor and observacion <> 'ANULADO' and observacion <> 'N/C' GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 


*/

$result = mysql_query($consulta);            // hace la consulta
$registro = mysql_fetch_row($result);        // toma el registro
$filas = mysql_num_rows ($result);          //indica la cantidad de resultados

$cod_zona_carga = $registro[8];
$consulta_zona ="select * from zona where cod_zona = $cod_zona_carga";
$result_zona = mysql_query($consulta_zona);            // hace la consulta
$registro_zona = mysql_fetch_row($result_zona);        // toma el registro

$zona_carga = $cod_zona_carga.' - '.$registro_zona[4];



//---------------------- creo el numero de repatidor-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,3,'REPARTIDOR: '.$repartidor.' - '.$nombre_fletero.'                           USUARIO: '.$nombre_usuario_carga.'                           ZONA: '.$zona_carga ,0,5 );
//$pdf->Ln(7);

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',9);
$pdf->Cell(1,8,'CODIGO');
$pdf->SetX(30);
$pdf->Cell(1,8,'DESCRIPCION');
$pdf->SetX(130);
$pdf->Cell(1,8,'BULTOS');
$pdf->SetX(155);
$pdf->Cell(1,8,'ENVASES');
$pdf->SetX(186);
$pdf->Cell(1,8,'CAJONES');

//---------------------- creo la linea -----------------------------------------------------//
$pdf->Line(7,34,205,34);																// linea

$pdf->Ln(15);	
$pdf->SetFont('Arial','',10);

do{ 					// obtengo los resultados 
		$codigo = $registro[0];
		$desc = $registro[1];
		$bulto = $registro[2];
		$tiene_envase = $registro[4];
		$peso = $registro[6];
							
		if($tiene_envase == "SI"){
				$envase=$registro[3];
				$total_envase= $total_envase + $envase;
				
				$cajon = round($bulto);
				if($bulto > $cajon){
					$cajon++;
				}
				
				$total_cajon= $total_cajon + $cajon;
		}else{
				$envase=' ';
				$total_envase= $total_envase + 0;				
				$cajon = ' ';
				$total_cajon= $total_cajon + 0;
		}
		
		$total_bulto = $total_bulto + $bulto;
		$total_peso = (($total_peso + $peso)*100)/100;

		$pdf->Cell(1,4 ,$codigo,0,0); 				// Cell(ancho,alto ,texto,borde,salto de linea);
		$pdf->SetX(29);
		$pdf->Cell(1,4 ,$desc,0,0); 				
		$pdf->SetX(-70);
		$pdf->Cell(1,4 ,$bulto,0,0,'R'); 				
		$pdf->SetX(-45);
		$pdf->Cell(1,4 ,$envase,0,0,'R'); 				
		$pdf->SetX(-10);
		$pdf->Cell(1,4 ,$cajon,0,1,'R'); 								
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		$pdf->Ln(3);
}while($registro = mysql_fetch_row($result)); // obtengo los resultados 		



//========================= fila de totales ========================//
$pdf->SetFont('Arial','',11); 
$pdf->Cell(6,8,'TOTALES',0,0);
$pdf->SetX(-70);
$pdf->Cell(1,8, $total_bulto ,0,0,'R');
$pdf->SetX(-45);
$pdf->Cell(1,8, $total_envase ,0,0,'R');
$pdf->SetX(-10);
$pdf->Cell(1,8, $total_cajon ,0,1,'R');

//---------------------- creo el archivo PDF------------------------------------------------//
if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}




?>