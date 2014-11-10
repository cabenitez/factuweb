<?php
//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "RANKING DE ARTÍCULOS VENDIDOS POR ZONA"; 
//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							


if (!empty($fecha_desde)){
	$ano = substr($fecha_desde,0,4); 
	$mes = substr($fecha_desde,4,2);
	$dia = substr($fecha_desde,-2);
	$fecha_desde_titulo = " DESDE: $dia/$mes/$ano";										// maqueta la fecha para imprimir
}

if (!empty($fecha_hasta)){
	$ano = substr($fecha_hasta,0,4); 
	$mes = substr($fecha_hasta,4,2);
	$dia = substr($fecha_hasta,-2);
	$fecha_hasta_titulo = " HASTA: $dia/$mes/$ano";										// maqueta la fecha para imprimir
}

$fecha_desde_hasta = $fecha_desde_titulo.$fecha_hasta_titulo; 

if (!empty($codigo)){
	$consulta = "SELECT nombre FROM zona where cod_zona = $codigo"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nombre_zona = $registro[0];

}

$pdf->SetFont('Arial','B',8);
$pdf->Cell(1,3, 'ZONA: '.$codigo.' - '.$nombre_zona);
$pdf->SetX(62);
$pdf->Cell(1,3, $fecha_desde_hasta,0,1);

//---------------------- creo el numero de repatidor-----------------------------------//
$pdf->SetFont('Arial','',8);
//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->Cell(6,8,'CODIGO');
$pdf->SetX(30);
$pdf->Cell(10,8,'DESCRIPCION');
$pdf->SetX(148);
$pdf->Cell(10,8,'BULTOS');
$pdf->SetX(168);
$pdf->Cell(10,8,'ENVASES');
$pdf->SetX(188);
$pdf->Cell(10,8,'CAJONES');

//---------------------- creo la linea -----------------------------------------------------//
$pdf->Line(7,34,205,34);																// linea
$pdf->Ln(7);																			//Salto de línea
$pdf->SetFont('Arial','',7);



//---------------------- INCLUYE CONEXION A BD -----------------------------------------------// 
include("conexion.php");

// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
$consulta ="select cod, descripcion, SUM(cant), (SUM(cant)* unidad_bulto)AS total_envase ,envase, grupo, sum(pesos), medida, zona, fecha FROM ( 
			
			select concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos, medida, factura_vta.cod_zona as zona, concat(cliente.cod_cliente,' - ', cliente.razon_social) as nombre_cliente  from cliente inner join (factura_vta inner join (factura_vta_detalle inner join producto on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario) on factura_vta.cod_cliente = cliente.cod_cliente 
			where observacion <> 'ANULADO' and observacion <> 'N/C'";
						
			if (!empty($codigo)){
						$consulta .= " and factura_vta.cod_zona = $codigo "; 
			}		
			if (!empty($fecha_desde)){
						$consulta .= " and fecha >= $fecha_desde"; 
			}
			if (!empty($fecha_hasta)){
						$consulta .= " and fecha <= $fecha_hasta"; 
			}
			if (!empty($cod_art)){
						$consulta .= " and concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) = $cod_art"; 
			}
			if ( $cod_grupo != 'TODOS'){
						$consulta .= " and producto.cod_grupo = $cod_grupo"; 
			}		
			if ($cod_marca != 'TODOS'){
						$consulta .= " and producto.cod_marca = $cod_marca"; 
			}		
			if ($cod_variedad != 'TODOS'){
						$consulta .= " and producto.cod_variedad = $cod_variedad"; 
			}		
$consulta .= " GROUP BY  factura_vta.fecha,concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)";  //factura_vta_no_cliente.cod_zona , concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)
$consulta .= " UNION ALL
			select concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos, medida, factura_vta_no_cliente.cod_zona as zona, factura_vta_no_cliente.razon_social as nombre_cliente from factura_vta_no_cliente inner join (factura_vta_no_cliente_detalle inner join producto on concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca, factura_vta_no_cliente_detalle.cod_variedad, factura_vta_no_cliente_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario 
			where observacion <> 'ANULADO' and observacion <> 'N/C' "; 
						
						if (!empty($codigo)){
								$consulta .= " and factura_vta_no_cliente.cod_zona = $codigo "; 
						}
						if (!empty($fecha_desde)){
								$consulta .= " and fecha >= $fecha_desde"; 
						 }		
						if (!empty($fecha_hasta)){
								$consulta .= " and fecha <= $fecha_hasta"; 
						}
						if (!empty($cod_art)){
								$consulta .= " and concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) = $cod_art"; 
						}
						if ( $cod_grupo != 'TODOS'){
								$consulta .= " and producto.cod_grupo = $cod_grupo"; 
						}		
						if ($cod_marca != 'TODOS'){
								$consulta .= " and producto.cod_marca = $cod_marca"; 
						}		
						if ($cod_variedad != 'TODOS'){
								$consulta .= " and producto.cod_variedad = $cod_variedad"; 
						}		
		$consulta .=" GROUP BY  factura_vta_no_cliente.fecha,concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)";  //factura_vta_no_cliente.cod_zona , concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)
$consulta .= ") AS carga_articulos GROUP BY  fecha,cod ORDER BY fecha,cod"; // grupo, SUM(cant)

//echo $consulta ;
$result = mysql_query($consulta);            // hace la consulta
$registro = mysql_fetch_row($result);        // toma el registro
$filas = mysql_num_rows ($result);          //indica la cantidad de resultados

function formatear_fecha($fecha){
	$ano=substr($fecha,0,4);
	$mes=substr($fecha,4,2);
	$dia=substr($fecha,-2);
	return $dia."/".$mes."/".$ano;
}



		$fecha_anterior = '';
		do{ 					// obtengo los resultados 
				$codigo = $registro[0];
				$desc = $registro[1];
				$bulto = $registro[2];
				$tiene_envase = $registro[4];
				$peso = $registro[6];
				$zona = $registro[8];
				$fecha = $registro[9];
									
				if($tiene_envase == "SI"){
						$envase=$registro[3];
						$envase = number_format($envase,0,'.','');
						$total_envase= $total_envase + $envase;
						
						$cajon = round($bulto);
						if($bulto > $cajon){
							$cajon++;
						}
						$cajon = number_format($cajon,0,'.','');
						$total_cajon= $total_cajon + $cajon;
				}else{
						$envase=' ';
						$total_envase= $total_envase + 0;				
						$cajon = ' ';
						$total_cajon= $total_cajon + 0;
				}
				
				$total_bulto = $total_bulto + $bulto;
				$total_peso = (($total_peso + $peso)*100)/100;
				
				if($fecha_anterior == ''){
						$fecha_anterior = $fecha;
						
						$pdf->SetFont('Arial','',10);
						$pdf->Cell(0,4 ,formatear_fecha($fecha_anterior),0,1);
						$pdf->SetFont('Arial','',8);
						 								
						$pdf->Cell(1,4 ,$codigo,0,0); 				// Cell(ancho,alto ,texto,borde,salto de linea);
						$pdf->SetX(29);
						$pdf->Cell(1,4 ,$desc,0,0); 				
						$pdf->SetX(-50);
						$pdf->Cell(1,4 ,$bulto,0,0,'R'); 				
						$pdf->SetX(-30);
						$pdf->Cell(1,4 ,$envase,0,0,'R'); 				
						$pdf->SetX(-11);
						$pdf->Cell(1,4 ,$cajon,0,1,'R'); 								
				}else{
						if($fecha_anterior != $fecha){
							$fecha_anterior = $fecha;
							
							$pdf->SetFont('Arial','',10);
							$pdf->Cell(0,4 ,formatear_fecha($fecha_anterior),0,1); 
							$pdf->SetFont('Arial','',8);
						}	

						$pdf->Cell(1,4 ,$codigo,0,0); 				// Cell(ancho,alto ,texto,borde,salto de linea);
						$pdf->SetX(29);
						$pdf->Cell(1,4 ,$desc,0,0); 				
						$pdf->SetX(-50);
						$pdf->Cell(1,4 ,$bulto,0,0,'R'); 				
						$pdf->SetX(-30);
						$pdf->Cell(1,4 ,$envase,0,0,'R'); 				
						$pdf->SetX(-11);
						$pdf->Cell(1,4 ,$cajon,0,1,'R'); 								

				}
				
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 		
				$total_bulto = number_format($total_bulto,1,'.','');
				$total_envase = number_format($total_envase,0,'.','');
				$total_cajon = number_format($total_cajon,0,'.','');


		//========================= fila de totales ========================//
				//---------------------- creo el resumen de total de filas------------------------------//
		$pdf->SetFont('Arial','',10); 
		$pdf->Cell(0,0,"_____________________________________________________________________________________________________",0,0,'L');
		$pdf->Ln(3);																			//Salto de línea
		$pdf->SetFont('Arial','',8); 
		$pdf->SetX(6);
		$pdf->Cell(0,3,'TOTALES',0,0);

		$pdf->SetX(-50);
		$pdf->Cell(1,3, $total_bulto ,0,0,'R');
		$pdf->SetX(-30);
		$pdf->Cell(1,3, $total_envase ,0,0,'R');
		$pdf->SetX(-11);
		$pdf->Cell(1,3, $total_cajon ,0,1,'R');

//---------------------- creo el archivo PDF------------------------------------------------//
if(empty($destino)){
	$pdf->Output();									   // muestra en pantalla 
}else{
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server
}




?>