<?php
//---------------------- Titulo del listado-------------------------------------------------//
$ano = substr($fecha_actual,0,4); 
$mes = substr($fecha_actual,4,2);
$dia = substr($fecha_actual,-2);
$fecha_titulo = "$dia/$mes/$ano";										// maqueta la fecha para imprimir
$titulo = "CARGA DEL DIA $fecha_titulo - CAJA";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados2.php"); 							    							

//---------------------- creo el numero de repatidor-----------------------------------//
$pdf2->SetFont('Arial','',8);
	$consulta2 = "SELECT nombre FROM fletero where cod_flero = $repartidor"; // consulta sql
	$result2 = mysql_query($consulta2);            // hace la consulta
	$registro2 = mysql_fetch_row($result2);        // toma el registro
	$nombre_fletero = $registro2[0];

	$consulta2 = "SELECT hora, usuario FROM cargas where cod_flero = $repartidor and fecha = $fecha_actual"; // consulta sql
	$result2 = mysql_query($consulta2);            // hace la consulta
	$registro2 = mysql_fetch_row($result2);        // toma el registro
	$filas2 = mysql_num_rows ($result2);          //indica la cantidad de resultados
	$hora_c = $registro2[0];
	$usuario_c = $registro2[1];

	$consulta22 = "SELECT nombre FROM usuario where usuario = '$usuario_c'"; // consulta sql
	$result22 = mysql_query($consulta22);            // hace la consulta
	$registro22 = mysql_fetch_row($result22);        // toma el registro
	$usuario_c = $registro22[0];

	if($filas2 > 0){
		$nombre_usuario_carga = $usuario_c." - ".$hora_c;
	}else{
		$nombre_usuario_carga = "PENDIENTE";
	}

$pdf2->Cell(0,3,'REPARTIDOR: '.$repartidor.' - '.$nombre_fletero.'                           FINALIZADA POR: '.$nombre_usuario_carga,0,5 );



//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf2->Ln(2);																			//Salto de línea
$pdf2->SetFont('Arial','',8);
$pdf2->SetX(135);
$pdf2->Cell(0,3,'TOTAL SIN');
$pdf2->SetX(168);
$pdf2->Cell(0,3,'OTROS',0,1);
$pdf2->Cell(0,3,'Nº TAL.');
$pdf2->SetX(17);
$pdf2->Cell(0,3,'COMPROBANTE');
$pdf2->SetX(63);
$pdf2->Cell(0,3,'CLIENTE');
$pdf2->SetX(157);
$pdf2->Cell(0,3,'IVA');
$pdf2->SetX(135);
$pdf2->Cell(0,3,'IMPUESTOS');
$pdf2->SetX(168);
$pdf2->Cell(0,3,'IMPUESTOS');
$pdf2->SetX(188);
$pdf2->Cell(0,3,'TOTAL');


//---------------------- creo la linea -----------------------------------------------------//
$pdf2->Line(7,37,205,37);																// linea
$pdf2->Ln(5);																			//Salto de línea

//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
include("conexion.php");

	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$consulta ="select descripcion,n_sucursal, n_factura, razon_social, sum(round(total_sin_impuesto,2)), sum(round(iva,2)), sum(round(otros_impuestos,2)), sum(round(total_general,2)), talonario , observacion, cod_talonario   
				   FROM	(
						select  tipo_talonario.descripcion, talonario.n_sucursal, factura_vta_no_cliente.n_factura, factura_vta_no_cliente.razon_social,
						
						$calculo_importe_no_cliente
						
						(factura_vta_no_cliente.num_talonario)talonario, observacion, factura_vta_no_cliente.cod_talonario
						
						$from_no_cliente
						
						where fecha = $fecha_actual and cod_repartidor = $repartidor and observacion <> 'ANULADO' and observacion <> 'N/C' and factura_vta_no_cliente.num_remito = 0 

						GROUP BY factura_vta_no_cliente_detalle.iva, factura_vta_no_cliente.cod_talonario, factura_vta_no_cliente.num_talonario, factura_vta_no_cliente.n_factura
						
					UNION ALL
						
						select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta.n_factura, concat(cliente.razon_social, cliente.nombre) as nombre, 
						
						$calculo_importe_cliente
						
						(factura_vta.num_talonario)as talonario, observacion, factura_vta.cod_talonario
						
						$from_cliente
												
						where fecha = $fecha_actual and cod_repartidor = $repartidor and observacion <>  'ANULADO' and observacion <> 'N/C' and factura_vta.num_remito = 0 
						
						GROUP BY factura_vta_detalle.iva, factura_vta.cod_talonario, factura_vta.num_talonario, factura_vta.n_factura
			
			) AS carga_caja GROUP BY cod_talonario, talonario, n_factura ORDER BY descripcion";


$result = mysql_query($consulta);            // hace la consulta
$registro = mysql_fetch_row($result);        // toma el registro
$filas = mysql_num_rows ($result);          //indica la cantidad de resultados

$pdf2->SetFont('Arial','',7);
do{ 					// obtengo los resultados 
		$n_talonario = $registro[8];
		
		$len_n_talonario=strlen($n_talonario); 					// completo el numero de la sucursal con ceros
		$ceros_3 = '';
		while ($len_n_talonario < 4){
				$ceros_3.="0";
				$len_n_talonario++;
	    }
	    $n_talonario=$ceros_3.$n_talonario;

		$desc_fac = $registro[0];
		$suc = $registro[1];
		$len_num_sucursal=strlen($suc); 					// completo el numero de la sucursal con ceros
		$ceros_2 = '';
		while ($len_num_sucursal < 4){
				$ceros_2.="0";
				$len_num_sucursal++;
	    }
	    $suc=$ceros_2.$suc;

		$n_fact = $registro[2];
	    $len_num_factura=strlen($n_fact); 						// completo el numero de factura con ceros
		$ceros= '';
		while ($len_num_factura < 8){								// completo el numero de la factura con ceros
				$ceros.="0";
				$len_num_factura++;
	    }
	    $n_fact=$ceros.$n_fact;
		
		$razon=$registro[3];
		$total_sin_imp=$registro[4];
		$total_iva=$registro[5];
		$total_otros_imp=$registro[6];
		$total_factura=$registro[7];
					
		$total_carga_sin_imp= $total_carga_sin_imp + $total_sin_imp;
		$total_carga_iva = $total_carga_iva + $total_iva;
		$total_carga_otros_imp= $total_carga_otros_imp + $total_otros_imp;
		
		$total_carga_factura = $total_carga_factura + $total_factura;
		$total_carga_factura = number_format($total_carga_factura,2,'.','');

		
		$pdf2->Cell(0,3 ,$n_talonario,0,0);
		$pdf2->SetX(17);
		$pdf2->Cell(0,3 ,$desc_fac.' '.$suc.' '.$n_fact ,0,0); 				
		$pdf2->SetX(63);
		$pdf2->Cell(0,3 ,$razon,0,0);
		
		$pdf2->SetX(-60);
		$pdf2->Cell(1,3 ,number_format($total_sin_imp,2,'.',''),0,0,'R'); 				
		$pdf2->SetX(-45);
		$pdf2->Cell(1,3 ,number_format($total_iva,2,'.',''),0,0,'R'); 				
		$pdf2->SetX(-30);
		$pdf2->Cell(1,3 ,number_format($total_otros_imp,2,'.',''),0,0,'R'); 				
		$pdf2->SetX(-11);
		$pdf2->Cell(1,3 ,number_format($total_factura,2,'.',''),0,1,'R');
		 								
}while($registro = mysql_fetch_row($result)); // obtengo los resultados 		


//---------------------- creo el resumen de total de filas------------------------------// 
$pdf2->SetFont('Arial','',10); 
$pdf2->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');

$pdf2->Ln(1);																			//Salto de línea

//========================= fila de totales ========================//
$pdf2->SetFont('Arial','',8); 
$pdf2->Cell(6,8,'TOTALES',0,0);
$pdf2->SetX(-60);
$pdf2->Cell(1,8, number_format($total_carga_sin_imp,2,'.','') ,0,0,'R');
$pdf2->SetX(-45);
$pdf2->Cell(1,8, number_format($total_carga_iva,2,'.','') ,0,0,'R');
$pdf2->SetX(-30);
$pdf2->Cell(1,8, number_format($total_carga_otros_imp,2,'.','') ,0,0,'R');
$pdf2->SetX(-11);
$pdf2->Cell(1,8, number_format($total_carga_factura,2,'.','') ,0,4,'R');


$pdf2->SetFont('Arial','',10); 
$pdf2->Ln(1);																			//Salto de línea
/*

//========================REMITOS======================================//
$consulta="select descripcion,n_sucursal, num_remito,razon_social  from cliente inner join (remito_vta inner join (talonario inner join tipo_talonario 
			on tipo_talonario.cod_talonario = talonario.cod_talonario)
			on talonario.cod_talonario = remito_vta.cod_talonario and talonario.num_talonario = remito_vta.num_talonario)
			on remito_vta.cod_cliente = cliente.cod_cliente where remito_vta.fecha = $fecha_actual and remito_vta.cod_repartidor = $repartidor
			UNION ALL
			select descripcion,n_sucursal, num_remito,razon_social  from remito_vta_no_cliente inner join (talonario inner join tipo_talonario 
			on tipo_talonario.cod_talonario = talonario.cod_talonario)
			on talonario.cod_talonario = remito_vta_no_cliente.cod_talonario and talonario.num_talonario = remito_vta_no_cliente.num_talonario
			where remito_vta_no_cliente.fecha = $fecha_actual and remito_vta_no_cliente.cod_repartidor = $repartidor";
			
$result = mysql_query($consulta);            // hace la consulta
$registro = mysql_fetch_row($result);        // toma el registro
$filas = mysql_num_rows ($result);          //indica la cantidad de resultados

if($filas > 0){
	$pdf2->Ln(4);
	$pdf2->SetFont('Arial','',8); 
	$pdf2->Cell(1,1,'REMITOS:',0,1); 
	$pdf2->SetFont('Arial','',10); 
	$pdf2->Cell(0,0,"_______",0,1,'L');
	$pdf2->Ln(3);
	
	$pdf2->SetFont('Arial','',7);
	do{ 					// obtengo los resultados 
			$desc = $registro[0];
			$suc = $registro[1];
			$len_num_sucursal=strlen($suc); 					// completo el numero de la sucursal con ceros
			$ceros_2 = '';
			while ($len_num_sucursal < 4){
					$ceros_2.="0";
					$len_num_sucursal++;
			}
			$suc=$ceros_2.$suc;
	
			$n_rem = $registro[2];
			$len_num_remito=strlen($n_rem); 						// completo el numero de factura con ceros
			$ceros= '';
			while ($len_num_remito < 8){								// completo el numero de la factura con ceros
					$ceros.="0";
					$len_num_remito++;
			}
			$n_rem=$ceros.$n_rem;
			
			$razon=$registro[3];
			
			$pdf2->Cell(0,3 ,$desc.' '.$suc.' '.$n_rem ,0,0); 				
			$pdf2->SetX(35);
			$pdf2->Cell(0,3 ,$razon,0,1);		 								
	}while($registro = mysql_fetch_row($result)); // obtengo los resultados 	
}


*/




// Obtiene el total de bultos y kilos
$consulta_t ="select DISTINCT (cod), descripcion, SUM(cant), (SUM(cant)* unidad_bulto)AS total_envase ,envase, grupo, sum(pesos), medida FROM (
				
				select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso * factura_vta_detalle.cantidad)as pesos, medida 
				
				from factura_vta inner join (factura_vta_detalle inner join producto on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
				
				on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario 
				
				where fecha = $fecha_actual and cod_repartidor= $repartidor and observacion <> 'ANULADO' and observacion <> 'N/C' 
				
				GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
			UNION ALL
			
				select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso * factura_vta_no_cliente_detalle.cantidad)as pesos, medida 
				
				from factura_vta_no_cliente inner join (factura_vta_no_cliente_detalle inner join producto on concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca, factura_vta_no_cliente_detalle.cod_variedad, factura_vta_no_cliente_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
				
				on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario 
				
				where fecha = $fecha_actual and cod_repartidor= $repartidor and observacion <> 'ANULADO'  and observacion <> 'N/C' 
				
				GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
			
			) AS carga_articulos GROUP BY cod ORDER BY medida  DESC"; // grupo, SUM(cant)
/*
			UNION ALL
			select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos, medida from remito_vta inner join (remito_vta_detalle inner join producto on concat(remito_vta_detalle.cod_grupo, remito_vta_detalle.cod_marca, remito_vta_detalle.cod_variedad, remito_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on remito_vta_detalle.num_remito = remito_vta.num_remito where fecha = $fecha_actual and cod_repartidor= $repartidor and observacion <> 'ANULADO'  and observacion <> 'N/C' GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
			UNION ALL
			select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos, medida from remito_vta_no_cliente inner join (remito_vta_detalle_no_cliente inner join producto on concat(remito_vta_detalle_no_cliente.cod_grupo, remito_vta_detalle_no_cliente.cod_marca, remito_vta_detalle_no_cliente.cod_variedad, remito_vta_detalle_no_cliente.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on remito_vta_detalle_no_cliente.num_remito = remito_vta_no_cliente.num_remito where fecha = $fecha_actual and cod_repartidor= $repartidor and observacion <> 'ANULADO'  and observacion <> 'N/C' GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 

*/

$result_t = mysql_query($consulta_t);            // hace la consulta
$registro_t = mysql_fetch_row($result_t);        // toma el registro

do{ 					// obtengo los resultados 
		$bulto = $registro_t[2];
		$peso = $registro_t[6];
							
		$total_bulto = $total_bulto + $bulto;
		$total_peso = $total_peso + $peso;
}while($registro_t = mysql_fetch_row($result_t)); // obtengo los resultados 		


//========================= fila de totales de bultos =====================//
$pdf2->SetFont('Arial','',10); 
$pdf2->Ln(12);																			//Salto de línea
$pdf2->SetX(6);

$pdf2->Cell(1,3,'BULTOS:',0,0,'L');
$pdf2->SetX(25);
$pdf2->Cell(1,3, $total_bulto ,0,1);

$pdf2->Cell(1,3,'KILOS:',0,0,'L');
$pdf2->SetX(25);
$pdf2->Cell(1,3, number_format($total_peso,2,'.','') ,0,1);


$pdf2->SetFont('Arial','UB',10);										//Arial subrayado negrita 10
$pdf2->Cell(0,10,'DETALLE ENVASES',0,1,'C');									//Título

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf2->SetFont('Arial','',8);
$pdf2->Cell(6,8,'CODIGO');
$pdf2->SetX(20);
$pdf2->Cell(10,8,'DESCRIPCION');
$pdf2->SetX(138);
$pdf2->Cell(10,8,'ENVASES');
$pdf2->SetX(158);
$pdf2->Cell(10,8,'CAJONES',0,1);

$pdf2->SetFont('Arial','',8); 
$pdf2->Cell(0,0,"_______________________________________________________________________________________________________________________",0,0,'L');
$pdf2->Ln(1);																			//Salto de línea


//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
include("conexion.php");

// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
$consulta ="select DISTINCT (cod), descripcion, SUM(cant), (SUM(cant)* unidad_bulto)AS total_envase ,envase, grupo, sum(pesos) FROM (
				select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso * factura_vta_detalle.cantidad)as pesos 
				
				from factura_vta inner join (factura_vta_detalle inner join producto on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
				
				on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario 
				
				where fecha = $fecha_actual and cod_repartidor= $repartidor and observacion <> 'ANULADO'  and observacion <> 'N/C' 
				
				GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
			UNION ALL
			
				select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso * factura_vta_no_cliente_detalle.cantidad)as pesos 
				
				from factura_vta_no_cliente inner join (factura_vta_no_cliente_detalle inner join producto on concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca, factura_vta_no_cliente_detalle.cod_variedad, factura_vta_no_cliente_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
				
				on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario 
				
				where fecha = $fecha_actual and cod_repartidor= $repartidor and observacion <> 'ANULADO'  and observacion <> 'N/C' 
				
				GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
				
			) AS carga_articulos GROUP BY cod ORDER BY grupo, SUM(cant) DESC";

/*
			UNION ALL
			select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos from remito_vta inner join (remito_vta_detalle inner join producto on concat(remito_vta_detalle.cod_grupo, remito_vta_detalle.cod_marca, remito_vta_detalle.cod_variedad, remito_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on remito_vta_detalle.num_remito = remito_vta.num_remito where fecha = $fecha_actual and cod_repartidor= $repartidor and observacion <> 'ANULADO'  and observacion <> 'N/C' GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
			UNION ALL
			select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos from remito_vta_no_cliente inner join (remito_vta_detalle_no_cliente inner join producto on concat(remito_vta_detalle_no_cliente.cod_grupo, remito_vta_detalle_no_cliente.cod_marca, remito_vta_detalle_no_cliente.cod_variedad, remito_vta_detalle_no_cliente.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on remito_vta_detalle_no_cliente.num_remito = remito_vta_no_cliente.num_remito where fecha = $fecha_actual and cod_repartidor= $repartidor and observacion <> 'ANULADO'  and observacion <> 'N/C' GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 

*/

$result = mysql_query($consulta);            // hace la consulta
$registro = mysql_fetch_row($result);        // toma el registro
$filas = mysql_num_rows ($result);          //indica la cantidad de resultados

$pdf2->SetFont('Arial','',8);
do{ 					// obtengo los resultados 
		$codigo = $registro[0];
		$desc = $registro[1];
		$bulto = $registro[2];
		$tiene_envase = $registro[4];
		$peso = $registro[6];
							
		if($tiene_envase == "SI"){
				$envase=$registro[3];
				$total_envase2= $total_envase2 + $envase;
				
				$cajon = round($bulto);
				if($bulto > $cajon){
					$cajon++;
				}
				$pdf2->Cell(0,6 ,$codigo,0,0); 				// Cell(ancho,alto ,texto,borde,salto de linea);
				$pdf2->SetX(20);
				$pdf2->Cell(0,6 ,$desc,0,0); 				
				$pdf2->SetX(140);
				$pdf2->Cell(1,6 ,$envase,0,0); 				
				$pdf2->SetX(160);
				$pdf2->Cell(1,6 ,$cajon,0,1); 								

				$total_cajon2= $total_cajon2 + $cajon;
		}
}while($registro = mysql_fetch_row($result)); // obtengo los resultados 		


//---------------------- creo el resumen de total de filas------------------------------// 
$pdf2->SetFont('Arial','',0); 
$pdf2->Cell(0,0,"_______________________________________________________________________________________________________________________",0,0,'L');
$pdf2->Ln(1);																			//Salto de línea

//========================= fila de totales ========================//
$pdf2->SetFont('Arial','',8); 
$pdf2->Cell(6,8,'TOTALES',0,0);
$pdf2->SetX(140);
$pdf2->Cell(1,8, $total_envase2 ,0,0);
$pdf2->SetX(160);
$pdf2->Cell(1,8, $total_cajon2 ,0,1);


//---------------------- creo el archivo PDF------------------------------------------------//
if(empty($destino)){
	$pdf2->Output();									   // muestra en pantalla 
}else{
	$pdf2->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}




?>