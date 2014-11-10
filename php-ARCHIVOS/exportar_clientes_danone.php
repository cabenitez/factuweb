<?php
/*
select factura_vta.cod_vendedor, vendedor.nombre ,factura_vta.cod_zona, zona.nombre ,count(distinct factura_vta.cod_cliente) 
from vendedor inner join (factura_vta inner join (cliente inner join zona on zona.cod_zona = cliente.cod_zona)on cliente.cod_cliente = factura_vta.cod_cliente) on factura_vta.cod_vendedor = vendedor.cod_vendedor
where cliente.activo = 'S' group by factura_vta.cod_vendedor, factura_vta.cod_zona

----------------------------------------------------------------------------------------------------------------
select count(distinct factura_vta.cod_cliente) 
from cliente inner join (factura_vta inner join (factura_vta_detalle inner join producto 
on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario)
on cliente.cod_cliente = factura_vta.cod_cliente
where cliente.activo = 'S' and producto.cod_proveedor = 5 and factura_vta.cod_vendedor = 1  and factura_vta.cod_zona = 5 group by factura_vta.cod_vendedor, factura_vta.cod_zona

select count(distinct factura_vta.cod_cliente) 
from cliente inner join (factura_vta inner join (factura_vta_detalle inner join producto 
on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario)
on cliente.cod_cliente = factura_vta.cod_cliente
where cliente.activo = 'S' and producto.cod_proveedor = 5 and factura_vta.cod_vendedor = 1  and factura_vta.cod_zona = 5 group by factura_vta.cod_vendedor, factura_vta.cod_zona
*/



//USAR EN LISTADO DE ARTICULOS
//---------------------- Titulo del listado-------------------------------------------------//
$titulo = "LISTA DE CLIENTES - AGUAS DANONE DE ARGENTINA S.A";

//---------------------- INCLUYE CONFIGURACION DE PDF --------------------------------------//
include("conf_listados.php"); 							    							

//---------------------- creo los titulos de las columnas-----------------------------------//
$pdf->SetFont('Arial','',8);
$pdf->Cell(6,8,'VENDEDOR');
$pdf->SetX(60);
$pdf->Cell(10,8,'ZONA');
$pdf->SetX(120);
$pdf->Cell(6,8,'TOTAL CLIENTES');
$pdf->SetX(160);
$pdf->Cell(10,8,'TOTAL DANONE');
$pdf->SetX(195);
$pdf->Cell(10,8,'%');

//$pdf->Cell(10,8,'STOCK');

//---------------------- creo la linea -----------------------------------------------------//
$pdf->Line(7,31,205,31);																// linea
$pdf->Ln(7);																			//Salto de línea

//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
include("conexion.php");

$consulta = "select factura_vta.cod_vendedor, vendedor.nombre ,factura_vta.cod_zona, zona.nombre ,count(distinct factura_vta.cod_cliente) as total
			from vendedor inner join (factura_vta inner join (cliente inner join zona on zona.cod_zona = cliente.cod_zona)on cliente.cod_cliente = factura_vta.cod_cliente) on factura_vta.cod_vendedor = vendedor.cod_vendedor
			where cliente.activo = 'S' and factura_vta.cod_vendedor < 19 group by factura_vta.cod_vendedor, factura_vta.cod_zona
			union
			select vendedor.cod_vendedor, vendedor.nombre ,zona.cod_zona, zona.nombre ,count(distinct factura_vta_no_cliente.razon_social) as total
			from vendedor inner join (factura_vta_no_cliente inner join zona on zona.cod_zona = factura_vta_no_cliente.cod_zona)on factura_vta_no_cliente.cod_vendedor = vendedor.cod_vendedor
			where factura_vta_no_cliente.cod_vendedor < 19 group by factura_vta_no_cliente.cod_vendedor, factura_vta_no_cliente.cod_zona";
 
$result = mysql_query($consulta);            					// hace la consulta
$filas = mysql_num_rows($result);

$pdf->SetFont('Arial','',7);
while($registro = mysql_fetch_array($result)){ 					// obtengo los resultados 
				$cod_vendedor = $registro[0];
				$nombre_vendedor = $registro[1];	
				$cod_zona = $registro[2];
				$nombre_zona=$registro[3];
				$cant_cliente=$registro[4];
				

				$pdf->Cell(0,3 ,$cod_vendedor.'-'.$nombre_vendedor,0,0); 				
				$pdf->SetX(60);
				$pdf->Cell(0,3 ,$cod_zona.'-'.$nombre_zona,0,0); 				
				$pdf->SetX(130);
				$pdf->Cell(0,3 ,$cant_cliente,0,0);  
				
				$consulta2 ="	select count(distinct factura_vta.cod_cliente)  
								from cliente inner join (factura_vta inner join (factura_vta_detalle inner join producto 
								on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
								on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario)
								on cliente.cod_cliente = factura_vta.cod_cliente
								where cliente.activo = 'S' and producto.cod_proveedor = 5 and factura_vta.cod_vendedor = $cod_vendedor  and factura_vta.cod_zona = $cod_zona group by factura_vta.cod_vendedor, factura_vta.cod_zona
								UNION
								select count(distinct factura_vta_no_cliente.razon_social)
								from factura_vta_no_cliente inner join (factura_vta_no_cliente_detalle inner join producto 
								on concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca, factura_vta_no_cliente_detalle.cod_variedad, factura_vta_no_cliente_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
								on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario
								where producto.cod_proveedor = 5 and factura_vta_no_cliente.cod_vendedor = $cod_vendedor  and factura_vta_no_cliente.cod_zona = $cod_zona group by factura_vta_no_cliente.cod_vendedor, factura_vta_no_cliente.cod_zona";

				$result2 = mysql_query($consulta2);            // hace la consulta
				$reg2 = mysql_fetch_row($result2);
				$cliente_danone = $reg2[0];
				
				$pdf->SetX(165);
				$pdf->Cell(0,3 ,$cliente_danone,0,0); 		 		

				$porc = ($cliente_danone * 100)/$cant_cliente; 
				$porc = round($porc); 
				
				$pdf->SetX(195);
				$pdf->Cell(0,3 ,$porc,0,1); 		 		


				/*
				
				$consulta_iva = "SELECT * FROM alicuota_iva"; 									// consulta sql
				$result_iva = mysql_query($consulta_iva);            // hace la consulta
				$reg_iva = mysql_fetch_row($result_iva);
				$iva= $reg_iva[2];

				$precio_categoria = $precio_categoria+($precio_categoria * $iva /100);
				$precio_categoria= number_format($precio_categoria,2,'.','');
					
				$pdf->Cell(0,3 ,$precio_categoria,0,0);
				$i++;
				//================================================================================================//
				//=====================MUEVO EL PUNTERO DE LA CONSULTA===========================================//
				if($i < $filas){
						$registro = mysql_fetch_array($result);
						
						$cod_grupo = $registro[12];
						$cod_marca = $registro[11];	
						$cod_variedad = $registro[10];
						$codigo=$registro[9];
						$desc=$registro[13];
						//$stock=$registro[16];
				
						$pdf->SetX(111);
						$pdf->Cell(0,3 ,$cod_grupo.$cod_marca.$cod_variedad.$codigo,0,0); 				
						$pdf->SetX(125);
						$pdf->Cell(0,3 ,$desc,0,0); 				
								
						$pdf->SetX(180);
		
						
						$consulta2 ="select categoria.descripcion, prod_por_categ.precio_vta from categoria inner join prod_por_categ on prod_por_categ.cod_categoria = categoria.cod_categoria where cod_prod = $codigo and prod_por_categ.cod_grupo = $cod_grupo and prod_por_categ.cod_marca = $cod_marca and prod_por_categ.cod_variedad = $cod_variedad ORDER BY categoria.descripcion";
						$resulta = mysql_query($consulta2);            // hace la consulta
						$reg2 = mysql_fetch_row($resulta);
						$precio_categoria= $reg2[1];
								
						$consulta_iva = "SELECT * FROM alicuota_iva"; 									// consulta sql
						$result_iva = mysql_query($consulta_iva);            // hace la consulta
						$reg_iva = mysql_fetch_row($result_iva);
						$iva= $reg_iva[2];
				
						$precio_categoria = $precio_categoria+($precio_categoria * $iva /100);
						$precio_categoria= number_format($precio_categoria,2,'.','');
									
						$pdf->Cell(0,3 ,$precio_categoria,0,1,'R');
						$i++;
				}else{
						$pdf->Cell(0,3 ,' ',0,1,'R');
				}	
			*/	
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