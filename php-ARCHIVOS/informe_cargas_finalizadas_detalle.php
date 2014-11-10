<?
$fecha_buscar = $_POST['fecha_buscar'];
$repartidor = $_POST['repartidor'];

if($fecha_buscar){
	
	include("sql_inicio.php");	//obtiene el microtime() de inicio

	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------// 
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
    $consulta ="select DISTINCT (cod), descripcion, SUM(cant), (SUM(cant)* unidad_bulto)AS total_envase ,envase, grupo, sum(pesos), medida, zona FROM ( 
					select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos, medida, factura_vta.cod_zona as zona 
					
					from factura_vta inner join (factura_vta_detalle inner join producto 
					
					on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
					
					on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario 
					
					where fecha = $fecha_buscar and cod_repartidor= $repartidor and observacion <> 'ANULADO' 
				    
					and observacion <> 'N/C' and factura_vta.num_remito = 0 
					
					GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
				UNION ALL
					select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos, medida, factura_vta_no_cliente.cod_zona as zona 
					
					from factura_vta_no_cliente inner join (factura_vta_no_cliente_detalle inner join producto on concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca, factura_vta_no_cliente_detalle.cod_variedad, factura_vta_no_cliente_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
					
					on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario 
					
					where fecha = $fecha_buscar and cod_repartidor= $repartidor and observacion <> 'ANULADO' 
					
				   and observacion <> 'N/C' and factura_vta_no_cliente.num_remito = 0 
				   
				   GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
			  
			  ) AS carga_articulos GROUP BY cod ORDER BY medida  DESC"; // grupo, SUM(cant)
/*
			UNION ALL
				select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos, medida, remito_vta.cod_zona as zona from remito_vta inner join (remito_vta_detalle inner join producto on concat(remito_vta_detalle.cod_grupo, remito_vta_detalle.cod_marca, remito_vta_detalle.cod_variedad, remito_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on remito_vta_detalle.num_remito = remito_vta.num_remito where fecha = $fecha_buscar and cod_repartidor= $repartidor and observacion <> 'ANULADO' and observacion <> 'N/C' GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
			UNION ALL
				select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos, medida, remito_vta_no_cliente.zona as zona from remito_vta_no_cliente inner join (remito_vta_detalle_no_cliente inner join producto on concat(remito_vta_detalle_no_cliente.cod_grupo, remito_vta_detalle_no_cliente.cod_marca, remito_vta_detalle_no_cliente.cod_variedad, remito_vta_detalle_no_cliente.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on remito_vta_detalle_no_cliente.num_remito = remito_vta_no_cliente.num_remito where fecha = $fecha_buscar  and cod_repartidor= $repartidor and observacion <> 'ANULADO' and observacion <> 'N/C' GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 


*/
	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<br>";
	echo "<div  align='center' class='seccion'><b><u>DETALLE POR REPARTIDOR - BULTOS </u> $nombre</b></div>";

	echo "<div  align='right' class='seccion'>";
		echo "<img src='../imagenes/pdf.gif' width='18' height='18' border='0' class='iconos'  title='Exportar' onClick=\"javascript: exportar_informe_cargas_finalizadas_detalle_bultos('exportar_informe_cargas_finalizadas_detalle_bultos.php')\" /> pdf  &nbsp;&nbsp;<img src='../imagenes/imprimir.png' width='18' height='18' title='Imprimir' class='iconos' onClick=\"javascript: imprimir_informe_cargas_finalizadas_detalle_bultos('exportar_informe_cargas_finalizadas_detalle_bultos.php')\" /> imprimir";
	echo "</div>";


	echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
		$consulta2 = "SELECT nombre FROM fletero where cod_flero = $repartidor"; // consulta sql
		$result2 = mysql_query($consulta2);            // hace la consulta
		$registro2 = mysql_fetch_row($result2);        // toma el registro
		$nombre_fletero = $registro2[0];

		$consulta3 = "SELECT hora, usuario FROM cargas where cod_flero = $repartidor and fecha = $fecha_buscar"; // consulta sql
		$result3 = mysql_query($consulta3);            // hace la consulta
		$registro3 = mysql_fetch_row($result3);        // toma el registro
		$filas3 = mysql_num_rows ($result3);          //indica la cantidad de resultados
		$hora_c = $registro3[0];
		$usuario_c = $registro3[1];
		
		$consulta22 = "SELECT nombre FROM usuario where usuario = '$usuario_c'"; // consulta sql
		$result22 = mysql_query($consulta22);            // hace la consulta
		$registro22 = mysql_fetch_row($result22);        // toma el registro
		$usuario_c = $registro22[0];
						
		if($filas3 > 0){
				$estado = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ESTADO: FINALIZADA POR: $usuario_c  -  $hora_c";
		}else{
				$estado = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ESTADO: PENDIENTE";
		}


		echo"<tr class='totales'>";			
			echo"<td colspan='2' align='left'>&nbsp;&nbsp;$repartidor - $nombre_fletero  $estado";
			echo "<input name='oculto_repartidor' id='oculto_repartidor' type='hidden' value='$repartidor' ";
			echo"</td>";
		echo"</tr>";

		echo "<tr class='top'>";
        	echo "<td width='7%' ><div align='center' class='seccion'>CODIGO</div></td>";
        	echo "<td width='65%' ><div align='center' class='seccion'>DESCRIPCION</div></td>";
			echo "<td width='7%' ><div align='center' class='seccion'>BULTOS</div></td>";
			echo "<td width='7%' ><div align='center' class='seccion'>ENVASES</div></td>";
			echo "<td width='7%' ><div align='center' class='seccion'>CAJON</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas
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
				
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='left'>";
							echo $espacio_izq.$codigo;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$desc;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $bulto.$espacio_izq;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $envase.$espacio_izq;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $cajon.$espacio_izq;     
					echo"</td>";
				echo"</tr>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 		
		
				echo"<tr bgcolor='#E0E0E0' >";			
					echo"<td colspan='2' align='left'>&nbsp;&nbsp;TOTALES	</td>";
					echo"<td align='right'>$total_bulto$espacio_izq</td>";
					echo"<td align='right'>$total_envase$espacio_izq</td>";
					echo"<td align='right'>$total_cajon$espacio_izq</td>";
					//echo"<td align='center'></td>";
				echo"</tr>";
	echo "</table>";   
	//---------------------cierra tabla   BULTOS  --------------------------------------------------------------------------------------//


//*************************************************************************************************************************************************************************//
//*************************************************************************************************************************************************************************//
//*************************************************************************************************************************************************************************//


	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$consulta ="select descripcion,n_sucursal, n_factura, razon_social, sum(round(total_sin_impuesto,2)), sum(round(iva,2)), sum(round(otros_impuestos,2)), sum(round(total_general,2)), talonario , observacion, cod_talonario   
				   FROM	(
						select  tipo_talonario.descripcion, talonario.n_sucursal, factura_vta_no_cliente.n_factura, factura_vta_no_cliente.razon_social,
						
						$calculo_importe_no_cliente
						
						(factura_vta_no_cliente.num_talonario)talonario, observacion, factura_vta_no_cliente.cod_talonario
						
						$from_no_cliente
						
						where fecha = $fecha_buscar and cod_repartidor = $repartidor and observacion <> 'ANULADO' and observacion <> 'N/C' and factura_vta_no_cliente.num_remito = 0 

						GROUP BY factura_vta_no_cliente_detalle.iva, factura_vta_no_cliente.cod_talonario, factura_vta_no_cliente.num_talonario, factura_vta_no_cliente.n_factura
						
					UNION ALL
						
						select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta.n_factura, concat(cliente.razon_social, cliente.nombre) as nombre, 
						
						$calculo_importe_cliente
						
						(factura_vta.num_talonario)as talonario, observacion, factura_vta.cod_talonario
						
						$from_cliente
												
						where fecha = $fecha_buscar and cod_repartidor = $repartidor and observacion <>  'ANULADO' and observacion <> 'N/C' and factura_vta.num_remito = 0 
						
						GROUP BY factura_vta_detalle.iva, factura_vta.cod_talonario, factura_vta.num_talonario, factura_vta.n_factura
			
			) AS carga_caja GROUP BY cod_talonario, talonario, n_factura ORDER BY descripcion";



	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados

	
	include("sql_fin.php");	//obtiene el microtime() de fin, retorna: $tiempo_final

	//echo 'Tiempo de Carga: '.$tiempo_final.'<br>';

	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<br>";
	echo "<div  align='center' class='seccion'><b><u>DETALLE POR REPARTIDOR - CAJA </u> $nombre</b></div>";

	echo "<div  align='right' class='seccion'>";
		echo "<img src='../imagenes/pdf.gif' width='18' height='18' border='0' class='iconos'  title='Exportar' onClick=\"javascript: exportar_informe_cargas_finalizadas_detalle_bultos('exportar_informe_cargas_finalizadas_detalle_caja.php')\" /> pdf  &nbsp;&nbsp;<img src='../imagenes/imprimir.png' width='18' height='18' title='Imprimir' class='iconos' onClick=\"javascript: imprimir_informe_cargas_finalizadas_detalle_bultos('exportar_informe_cargas_finalizadas_detalle_caja.php')\" /> imprimir";
	echo "</div>";


	echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
		
		$consulta2 = "SELECT nombre FROM fletero where cod_flero = $repartidor"; // consulta sql
		$result2 = mysql_query($consulta2);            // hace la consulta
		$registro2 = mysql_fetch_row($result2);        // toma el registro
		$nombre_fletero = $registro2[0];

		echo"<tr class='totales'>";			
			echo"<td colspan='2' align='left'>&nbsp;&nbsp;$repartidor - $nombre_fletero";
			echo "<input name='oculto_repartidor' id='oculto_repartidor' type='hidden' value='$repartidor' ";
			echo"</td>";
		echo"</tr>";

		echo "<tr class='top'>";
        	echo "<td width='5%' ><div align='center' class='seccion'>N&deg; TAL.</div></td>";
        	echo "<td width='15%' ><div align='center' class='seccion'>COMPROBANTE</div></td>";
			echo "<td width='20%' ><div align='center' class='seccion'>CLIENTE</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>OBSERVACION</div></td>";
			echo "<td width='12%' ><div align='center' class='seccion'>TOTAL SIN IMPUESTOS</div></td>";
			echo "<td width='5%' ><div align='center' class='seccion'>IVA</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>OTROS IMPUESTOS</div></td>";
        	echo "<td width='8%' ><div align='center' class='seccion'>TOTAL</div></td>";
			echo "<td width='5%' ><div align='center' class='seccion'>DETALLE</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas
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
				$n_factura=$n_fact;
				
				$len_num_factura=strlen($n_fact); 						// completo el numero de factura con ceros
				$ceros= '';
				while ($len_num_factura < 8){								// completo el numero de la factura con ceros
						$ceros.="0";
						$len_num_factura++;
				}
				$n_fact=$ceros.$n_fact;
				
				$observacion = $registro[9];
				$cod_talonario = $registro[10];
				
				if($observacion == 'ANULADO'){
					$razon='COMPROBANTE ANULADO';					
					$total_sin_imp=" ";
					$total_iva=" ";
					$total_otros_imp=" ";
					$total_factura=" ";
					$obs=" ";
				}else{
					if($observacion == 'N/C'){
						$razon=$registro[3];
						$total_sin_imp=-$registro[4];
						$total_iva=-$registro[5];
						$total_otros_imp=$registro[6];
						if($registro[6] > 0){
							$total_otros_imp=-$registro[6];
						}
						$total_factura=-$registro[7];
						$desc_fac = "NC ".$cod_talonario;
						$obs=" ";
					}else{
						$razon=$registro[3];
						$total_sin_imp=$registro[4];
						$total_iva=$registro[5];
						$total_otros_imp=$registro[6];
						$total_factura=$registro[7];
						$obs=$observacion;
						
						$total_carga_sin_imp= $total_carga_sin_imp + $total_sin_imp;
					 	$total_carga_iva = $total_carga_iva + $total_iva;
						$total_carga_otros_imp= $total_carga_otros_imp + $total_otros_imp;
						$total_carga_factura =$total_carga_factura + $total_factura;

					}
				}				
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='left'>";
							echo $espacio_izq.$n_talonario;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$desc_fac.' '.$suc.' '.$n_fact;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$razon;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$obs;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $total_sin_imp.$espacio_izq;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $total_iva.$espacio_izq;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $total_otros_imp.$espacio_izq; 
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $total_factura.$espacio_izq; 
					echo"</td>";
					echo "<td $clase align='center'>";
							if($observacion != 'ANULADO'){
									echo "<img  class='iconos' src='../imagenes/detalle.gif' border='0' title='Ver detalle' onClick='javascript: buscar_venta_dia_detalle_comprobante(\"$cod_talonario\",\"$n_talonario\",$n_factura,\"$desc_fac\",$suc)'>"; 
							}
					echo"</td>";

	
				echo"</tr>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 		
		
				echo"<tr bgcolor='#E0E0E0' >";			
					echo"<td colspan='4' align='left'>&nbsp;&nbsp;TOTALES	</td>";
					
					$total_carga_sin_imp= number_format($total_carga_sin_imp,2,'.','');
					$total_carga_iva = number_format($total_carga_iva,2,'.','');
					$total_carga_otros_imp= number_format($total_carga_otros_imp,2,'.','');
					$total_carga_factura = number_format($total_carga_factura,2,'.','');

					echo"<td align='right'>$total_carga_sin_imp$espacio_izq</td>";
					echo"<td align='right'>$total_carga_iva$espacio_izq</td>";
					echo"<td align='right'>$total_carga_otros_imp$espacio_izq</td>";
					echo"<td align='right'>$total_carga_factura$espacio_izq</td>";
					echo"<td align='center'></td>";
				echo"</tr>";
	echo "</table>";   
	//---------------------cierra tabla   CAJA  --------------------------------------------------------------------------------------//
		
		
		
}
?>
