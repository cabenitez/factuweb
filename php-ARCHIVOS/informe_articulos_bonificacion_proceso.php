<?
	$razon = strtoupper($razon);
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------// 
	include("conexion.php");
	
			//----------------------------------------------------------------------------------------------------------------------//
			//										BONIFICACION = 0																//
			//----------------------------------------------------------------------------------------------------------------------//
			$consulta ="select cod, descripcion, SUM(cant), (SUM(cant)* unidad_bulto)AS total_envase ,envase, grupo, sum(pesos), medida, zona, nombre_cliente FROM ( 
						select concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos, medida, factura_vta.cod_zona as zona, concat(cliente.cod_cliente,' - ', cliente.razon_social) as nombre_cliente  
						from cliente inner join (factura_vta inner join (factura_vta_detalle inner join producto on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario) on factura_vta.cod_cliente = cliente.cod_cliente 
						where observacion <> 'ANULADO' and observacion <> 'N/C' and factura_vta_detalle.bonificacion = 0 ";
									
						if (!empty($codigo)){
									$consulta .= " and cliente.cod_cliente = $codigo "; 
						}else{
									if (!empty($razon)){
												$consulta .= " and cliente.razon_social like '%$razon%' "; 
									}
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
			$consulta .= " GROUP BY  cliente.cod_cliente, concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) ";
			
			if (empty($codigo)){
						$consulta .= " UNION ALL
									select concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos, medida, factura_vta_no_cliente.cod_zona as zona, factura_vta_no_cliente.razon_social as nombre_cliente 
									from factura_vta_no_cliente inner join (factura_vta_no_cliente_detalle inner join producto on concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca, factura_vta_no_cliente_detalle.cod_variedad, factura_vta_no_cliente_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario 
									where observacion <> 'ANULADO' and observacion <> 'N/C' and factura_vta_no_cliente_detalle.bonificacion = 0 "; 
												
												if (!empty($razon)){
														$consulta .= " and factura_vta_no_cliente.razon_social like '%$razon%' "; 
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
								$consulta .=" GROUP BY  factura_vta_no_cliente.razon_social, concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)"; 
			}
					
			$consulta .= ") AS carga_articulos GROUP BY  nombre_cliente, cod ORDER BY medida  DESC"; // grupo, SUM(cant)
		
			//echo $consulta ;
			$result = mysql_query($consulta);            // hace la consulta
			$registro = mysql_fetch_row($result);        // toma el registro
			$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
		
		if($filas > 0){
			echo "<input type='text' id='filas' name='filas' style='visibility:hidden' value=".$filas.">";
			
			//---------------------abre la tabla--------------------------------------------------------------------------------------//
			echo "<br>";
			echo "<div  align='center' class='seccion'><b><u>ARTICULOS VENDIDOS SIN BONIFICACION</u> $nombre</b></div>";
			echo "<br>";

			//echo "<div  align='right' class='seccion'>";
			//	echo "<img src='../imagenes/pdf.gif' width='18' height='18' border='0' class='iconos'  title='Exportar' onClick=\"javascript: exportar_informe_ranking_articulos_vendidos('exportar_informe_ranking_art_vendidos.php')\" /> pdf  &nbsp;&nbsp;<img src='../imagenes/imprimir.png' width='18' height='18' title='Imprimir' class='iconos' onClick=\"javascript: imprimir_informe_ranking_art_vendidos('exportar_informe_ranking_art_vendidos.php')\" /> imprimir";
			//echo "</div>";
			//echo "<br>";
			
			echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
				echo "<tr class='top'>";
					echo "<td width='7%' ><div align='center' class='seccion'>CODIGO</div></td>";
					echo "<td width='72%' ><div align='center' class='seccion'>DESCRIPCION</div></td>";
					echo "<td width='7%' ><div align='center' class='seccion'>BULTOS</div></td>";
					echo "<td width='7%' ><div align='center' class='seccion'>ENVASES</div></td>";
					echo "<td width='7%' ><div align='center' class='seccion'>CAJONES</div></td>";
				echo "</tr>";
				$clase="class='filas'"; 							//defino la clase para las filas
				
				$nombre_cliente_anterior = '';
				do{ 					// obtengo los resultados 
						$codigo_art = $registro[0];
						$desc = $registro[1];
						$bulto = $registro[2];
						$tiene_envase = $registro[4];
						$peso = $registro[6];
						$nombre_cliente = $registro[9];
											
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
						
						if($nombre_cliente_anteror = ''){
								$nombre_cliente_anterior = $nombre_cliente;
								echo"<tr bgcolor='#E0E0E0' >";			
									echo "<td colspan='3' class = 'content' align='left'>";
										echo $nombre_cliente_anterior;										// maqueta la fecha para imprimir
									echo"</td>";
								echo "<tr>";
		
								echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
									echo "<td $clase align='left'>";
											echo $espacio_izq.$codigo_art;     
									echo"</td>";
									echo "<td $clase align='left'>";
											echo $espacio_izq.$desc;     
									echo"</td>";
									echo "<td $clase align='right'>";
											echo number_format($bulto,1,'.','').$espacio_izq;     
									echo"</td>";
									echo "<td $clase align='right'>";
											echo $envase.$espacio_izq;     
									echo"</td>";
									echo "<td $clase align='right'>";
											echo $cajon.$espacio_izq;     
									echo"</td>";
								echo"</tr>";
						}else{
								if($nombre_cliente_anterior != $nombre_cliente){
									$nombre_cliente_anterior = $nombre_cliente;
									echo"<tr bgcolor='#E0E0E0' >";			
										echo "<td colspan='9' class = 'content' align='left'>";
												echo $nombre_cliente_anterior;     
										echo"</td>";
									echo "<tr>";
								}	
		
								echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
									echo "<td $clase align='left'>";
											echo $espacio_izq.$codigo_art;     
									echo"</td>";
									echo "<td $clase align='left'>";
											echo $espacio_izq.$desc;     
									echo"</td>";
									echo "<td $clase align='right'>";
											echo number_format($bulto,1,'.','').$espacio_izq;     
									echo"</td>";
									echo "<td $clase align='right'>";
											echo $envase.$espacio_izq;     
									echo"</td>";
									echo "<td $clase align='right'>";
											echo $cajon.$espacio_izq;     
									echo"</td>";
								echo"</tr>";
		
						}
						
				}while($registro = mysql_fetch_row($result)); // obtengo los resultados 	 	
						$total_bulto = number_format($total_bulto,1,'.','');
						$total_envase = number_format($total_envase,0,'.','');
						$total_cajon = number_format($total_cajon,0,'.','');
		
						echo"<tr bgcolor='#E0E0E0' >";			
							echo"<td colspan='2' align='left'>&nbsp;&nbsp;TOTALES	</td>";
							echo"<td align='right'>$total_bulto$espacio_izq</td>";
							echo"<td align='right'>$total_envase$espacio_izq</td>";
							echo"<td align='right'>$total_cajon$espacio_izq</td>";
							echo"<td align='center'></td>";
						echo"</tr>";
			echo "</table>";   
		}else{
			echo "<br>".'NO se encontraron ventas con Bonificaci&oacute;n igual a cero'."<br>";
		}

			//----------------------------------------------------------------------------------------------------------------------//
			//										BONIFICACION > 0																//
			//----------------------------------------------------------------------------------------------------------------------//
			$consulta ="select cod, descripcion, SUM(cant), (SUM(cant)* unidad_bulto)AS total_envase ,envase, grupo, sum(pesos), medida, zona, nombre_cliente, bon FROM ( 
						select concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos, medida, factura_vta.cod_zona as zona, concat(cliente.cod_cliente,' - ', cliente.razon_social) as nombre_cliente, factura_vta_detalle.bonificacion as bon  
						from cliente inner join (factura_vta inner join (factura_vta_detalle inner join producto on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario) on factura_vta.cod_cliente = cliente.cod_cliente 
						where observacion <> 'ANULADO' and observacion <> 'N/C' and factura_vta_detalle.bonificacion > 0 ";
									
						if (!empty($_POST[codigo])){
									$consulta .= " and cliente.cod_cliente = $codigo "; 
						}else{
									if (!empty($razon)){
												$consulta .= " and cliente.razon_social like '%$razon%' "; 
									}
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
			$consulta .= " GROUP BY  cliente.cod_cliente, concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) ";
			
			if (empty($_POST[codigo])){
						$consulta .= " UNION ALL
									select concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos, medida, factura_vta_no_cliente.cod_zona as zona, factura_vta_no_cliente.razon_social as nombre_cliente, factura_vta_no_cliente_detalle.bonificacion as bon 
									from factura_vta_no_cliente inner join (factura_vta_no_cliente_detalle inner join producto on concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca, factura_vta_no_cliente_detalle.cod_variedad, factura_vta_no_cliente_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario 
									where observacion <> 'ANULADO' and observacion <> 'N/C' and factura_vta_no_cliente_detalle.bonificacion > 0 "; 
												
												if (!empty($razon)){
														$consulta .= " and factura_vta_no_cliente.razon_social like '%$razon%' "; 
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
								$consulta .=" GROUP BY  factura_vta_no_cliente.razon_social, concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)"; 
			}
					
			$consulta .= ") AS carga_articulos GROUP BY  nombre_cliente, cod ORDER BY medida  DESC"; // grupo, SUM(cant)
		
			//echo $consulta ;
			$result = mysql_query($consulta);            // hace la consulta
			$registro = mysql_fetch_row($result);        // toma el registro
			$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
		
		if($filas > 0){
			echo "<input type='text' id='filas2' name='filas2' style='visibility:hidden' value=".$filas.">";
			
			$total_envase= 0;
			$total_bulto = 0;
			$total_cajon = 0;
			$total_peso = 0;
						
			//---------------------abre la tabla--------------------------------------------------------------------------------------//
			echo "<br>";
			echo "<div  align='center' class='seccion'><b><u>ARTICULOS VENDIDOS CON BONIFICACION</u> $nombre</b></div>";
			echo "<br>";
			
			echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
				echo "<tr class='top'>";
					echo "<td width='7%' ><div align='center' class='seccion'>CODIGO</div></td>";
					echo "<td width='65%' ><div align='center' class='seccion'>DESCRIPCION</div></td>";
					echo "<td width='7%' ><div align='center' class='seccion'>BULTOS</div></td>";
					echo "<td width='7%' ><div align='center' class='seccion'>ENVASES</div></td>";
					echo "<td width='7%' ><div align='center' class='seccion'>CAJONES</div></td>";
					echo "<td width='7%' ><div align='center' class='seccion'>% BONIF.</div></td>";
				echo "</tr>";
				$clase="class='filas'"; 							//defino la clase para las filas
				
				$nombre_cliente_anterior = '';
				do{ 					// obtengo los resultados 
						$codigo_art = $registro[0];
						$desc = $registro[1];
						$bulto = $registro[2];
						$tiene_envase = $registro[4];
						$peso = $registro[6];
						$nombre_cliente = $registro[9];
						$bonif = $registro[10];
						
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
						
						if($nombre_cliente_anteror = ''){
								$nombre_cliente_anterior = $nombre_cliente;
								echo"<tr bgcolor='#E0E0E0' >";			
									echo "<td colspan='3' class = 'content' align='left'>";
										echo $nombre_cliente_anterior;										// maqueta la fecha para imprimir
									echo"</td>";
								echo "<tr>";
		
								echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
									echo "<td $clase align='left'>";
											echo $espacio_izq.$codigo_art;     
									echo"</td>";
									echo "<td $clase align='left'>";
											echo $espacio_izq.$desc;     
									echo"</td>";
									echo "<td $clase align='right'>";
											echo number_format($bulto,1,'.','').$espacio_izq;     
									echo"</td>";
									echo "<td $clase align='right'>";
											echo $envase.$espacio_izq;     
									echo"</td>";
									echo "<td $clase align='right'>";
											echo $cajon.$espacio_izq;     
									echo"</td>";
									echo "<td $clase align='right'>";
											echo $bonif.$espacio_izq;     
									echo"</td>";
								echo"</tr>";
						}else{
								if($nombre_cliente_anterior != $nombre_cliente){
									$nombre_cliente_anterior = $nombre_cliente;
									echo"<tr bgcolor='#E0E0E0' >";			
										echo "<td colspan='9' class = 'content' align='left'>";
												echo $nombre_cliente_anterior;     
										echo"</td>";
									echo "<tr>";
								}	
		
								echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
									echo "<td $clase align='left'>";
											echo $espacio_izq.$codigo_art;     
									echo"</td>";
									echo "<td $clase align='left'>";
											echo $espacio_izq.$desc;     
									echo"</td>";
									echo "<td $clase align='right'>";
											echo number_format($bulto,1,'.','').$espacio_izq;     
									echo"</td>";
									echo "<td $clase align='right'>";
											echo $envase.$espacio_izq;     
									echo"</td>";
									echo "<td $clase align='right'>";
											echo $cajon.$espacio_izq;     
									echo"</td>";
									echo "<td $clase align='right'>";
											echo $bonif.$espacio_izq;     
									echo"</td>";

								echo"</tr>";
		
						}
						
				}while($registro = mysql_fetch_row($result)); // obtengo los resultados 	 	
						$total_bulto = number_format($total_bulto,1,'.','');
						$total_envase = number_format($total_envase,0,'.','');
						$total_cajon = number_format($total_cajon,0,'.','');
		
						echo"<tr bgcolor='#E0E0E0' >";			
							echo"<td colspan='2' align='left'>&nbsp;&nbsp;TOTALES	</td>";
							echo"<td align='right'>$total_bulto$espacio_izq</td>";
							echo"<td align='right'>$total_envase$espacio_izq</td>";
							echo"<td align='right'>$total_cajon$espacio_izq</td>";
							echo"<td align='center'></td>";
						echo"</tr>";
			echo "</table>";   
		}else{
			echo "<br>".'NO se encontraron ventas con Bonificaci&oacute;n mayor a cero'."<br>";
		}
?>