<?
$fecha_buscar = $_POST['fecha_buscar'];

if($fecha_buscar){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	// Obtiene todos los repartidores //
	$consulta ="SELECT distinct(cod_repartidor), nombre from(
				  select cod_repartidor, nombre from producto inner join (factura_vta_detalle inner join (factura_vta  inner join fletero on factura_vta.cod_repartidor = fletero.cod_flero) on factura_vta_detalle.n_factura =  factura_vta.n_factura) on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)  where fecha = $fecha_buscar and producto.envase = 'SI'
				  UNION 
				  select cod_repartidor, nombre from producto inner join ( factura_vta_no_cliente_detalle inner join (factura_vta_no_cliente inner join fletero on factura_vta_no_cliente.cod_repartidor = fletero.cod_flero      ) on factura_vta_no_cliente_detalle.n_factura =  factura_vta_no_cliente.n_factura) on concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca, factura_vta_no_cliente_detalle.cod_variedad, factura_vta_no_cliente_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)  where fecha = $fecha_buscar and producto.envase = 'SI'
				  UNION
				  select cod_repartidor, nombre from producto inner join ( remito_vta_detalle  inner join (remito_vta inner join fletero on remito_vta.cod_repartidor = fletero.cod_flero   ) on remito_vta_detalle.num_remito =  remito_vta.num_remito) on concat(remito_vta_detalle.cod_grupo, remito_vta_detalle.cod_marca, remito_vta_detalle.cod_variedad, remito_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)  where fecha = $fecha_buscar and producto.envase = 'SI'
				  UNION 
				  select cod_repartidor, nombre from producto inner join ( remito_vta_detalle_no_cliente  inner join (remito_vta_no_cliente inner join fletero on remito_vta_no_cliente.cod_repartidor = fletero.cod_flero   ) on remito_vta_detalle_no_cliente.num_remito =  remito_vta_no_cliente.num_remito) on concat(remito_vta_detalle_no_cliente.cod_grupo, remito_vta_detalle_no_cliente.cod_marca, remito_vta_detalle_no_cliente.cod_variedad, remito_vta_detalle_no_cliente.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)  where fecha = $fecha_buscar and producto.envase = 'SI'
				) as repartidores order by cod_repartidor";
	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	if($filas > 0){
			
			echo "<div  align='right' class='seccion'>";
				echo "<img src='../imagenes/pdf.gif' width='18' height='18' border='0' class='iconos'  title='Exportar' onClick=\"javascript: exportar_listado_venta_del_dia('exportar_informe_resumen_envases.php')\" /> pdf  &nbsp;&nbsp;<img src='../imagenes/imprimir.png' width='18' height='18' title='Imprimir' class='iconos' onClick=\"javascript: imprimir_listado_venta_del_dia('exportar_informe_resumen_envases.php')\" /> imprimir";
			echo "</div>";
			echo "<br>";

			do{ 					
					$repartidor = $registro[0];
					$nombre_repartidor = $registro[1];
					
					
					//---------------------- Obtiene el detalle de todos los comprobantes Factura Vta-----------------------------------------------//
					$consulta2 ="select DISTINCT (cod), descripcion, SUM(cant), (SUM(cant)* unidad_bulto)AS total_envase ,envase, grupo, sum(pesos) FROM (
								select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos from factura_vta inner join (factura_vta_detalle inner join producto on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario where fecha = $fecha_buscar and cod_repartidor= $repartidor and observacion <> 'ANULADO' GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)  
								UNION ALL
								select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos from factura_vta_no_cliente inner join (factura_vta_no_cliente_detalle inner join producto on concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca, factura_vta_no_cliente_detalle.cod_variedad, factura_vta_no_cliente_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario where fecha = $fecha_buscar and cod_repartidor= $repartidor and observacion <> 'ANULADO' GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
								UNION ALL
								select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos from remito_vta inner join (remito_vta_detalle inner join producto on concat(remito_vta_detalle.cod_grupo, remito_vta_detalle.cod_marca, remito_vta_detalle.cod_variedad, remito_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on remito_vta_detalle.num_remito = remito_vta.num_remito where fecha = $fecha_buscar and cod_repartidor= $repartidor and observacion <> 'ANULADO' GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
								UNION ALL
								select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, unidad_bulto, envase, fecha, cod_repartidor,(producto.cod_grupo)as grupo, sum(producto.peso)as pesos from remito_vta_no_cliente inner join (remito_vta_detalle_no_cliente inner join producto on concat(remito_vta_detalle_no_cliente.cod_grupo, remito_vta_detalle_no_cliente.cod_marca, remito_vta_detalle_no_cliente.cod_variedad, remito_vta_detalle_no_cliente.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) on remito_vta_detalle_no_cliente.num_remito = remito_vta_no_cliente.num_remito where fecha = $fecha_buscar and cod_repartidor= $repartidor and observacion <> 'ANULADO' GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod) 
								) AS carga_articulos GROUP BY cod ORDER BY grupo, SUM(cant) DESC";
					
					$result2 = mysql_query($consulta2);            // hace la consulta
					$registro2 = mysql_fetch_row($result2);        // toma el registro
					$filas2 = mysql_num_rows ($result2);          //indica la cantidad de resultados
		
					
					//---------------------abre la tabla--------------------------------------------------------------------------------------//
					echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";

						//------------------FILA DE NOMBRE DE REPARTIDOR-------------//
						echo "<tr class='totales'>";
							echo "<td width='20%' align='left' colspan='2'>REPARTIDOR: $repartidor - $nombre_repartidor</td>";
						echo "</tr>";

						//------------------FILA DE ENCABEZADOS-------------//
						echo "<tr class='top'>";
							echo "<td width='10%' ><div align='center' class='seccion'>CODIGO</div></td>";
							echo "<td width='70%' ><div align='center' class='seccion'>DESCRIPCION</div></td>";
							echo "<td width='10%' ><div align='center' class='seccion'>ENVASES</div></td>";
							echo "<td width='10%' ><div align='center' class='seccion'>CAJONES</div></td>";
						echo "</tr>";
						$clase="class='filas'"; 							//defino la clase para las filas
						do{ 					// obtengo los resultados 
								$codigo = $registro2[0];
								$desc = $registro2[1];
								$bulto = $registro2[2];
								$tiene_envase = $registro2[4];
								$peso = $registro2[6];

								if($tiene_envase == "SI"){
										$envase=$registro2[3];
										$total_envase2= $total_envase2 + $envase;
										
										$cajon = round($bulto);
										if($bulto > $cajon){
											$cajon++;
										}
										$total_cajon2= $total_cajon2 + $cajon;
										
										echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
											echo "<td $clase align='center'>";
													echo $codigo;     
											echo"</td>";
											echo "<td $clase align='left'>";
													echo $espacio_izq.$desc;     
											echo"</td>";
											echo "<td $clase align='center'>";
													echo $envase;     
											echo"</td>";
											echo "<td $clase align='center'>";
													echo $cajon;     
											echo"</td>";						
										echo"</tr>";
										
								}
						}while($registro2 = mysql_fetch_row($result2)); // obtengo los resultados 		
						//------------------FILA DE TOTALES-------------//
						echo "<tr bgcolor='#E0E0E0'>";
							echo "<td align='left' colspan='2'>TOTALES</td>";
							echo "<td $clase align='center'>";
									echo $total_envase2;
									$total_envase_informe= $total_envase_informe+$total_envase2;    
									$total_envase2 = 0;
							echo"</td>";
							echo "<td $clase align='center'>";
									echo $total_cajon2;
									$total_cajon_informe= $total_cajon_informe+$total_cajon2;
									$total_cajon2 = 0;    
							echo"</td>";						
						echo "</tr>";
					echo "</table>"; 
					echo "<br>";  
					//---------------------cierra tabla--------------------------------------------------------------------------------------//


			}while($registro = mysql_fetch_row($result)); // obtengo los resultados

			echo "<table width='100%'  border='0' cellspacing='1' cellpadding='0'>";
						echo "<tr bgcolor='#E0E0E0'>";
							echo "<td width='80%' align='left' colspan='2'>TOTALES GENERALES</td>";
							echo "<td width='10%' $clase align='center'>";
									echo $total_envase_informe;     
							echo"</td>";
							echo "<td width='10%' $clase align='center'>";
									echo $total_cajon_informe;     
							echo"</td>";						
						echo "</tr>";
			echo "</table>";
			
			//---------------------abre la tabla del detalle de ventas por deposito --------------------------------------------------------//
			echo "<br>";
			echo "<div  align='center' class='seccion'><b><u>DETALLE ENVASES POR DEPOSITO</u> $nombre</b></div>";
			echo "<br>";
			$consulta_dep = "select cod_flero from fletero where nombre like '%DEPOS%'";
			$result_dep = mysql_query($consulta_dep);            
			$registro_dep = mysql_fetch_row($result_dep);        
			$filas_dep = mysql_num_rows ($result_dep);          //indica la cantidad de resultados
			if($filas_dep > 0){
				do{
						$repartidor=$registro_dep[0];
						include("informe_resumen_envases_deposito.php");
						
				}while($registro_dep = mysql_fetch_row($result_dep)); // obtengo los resultados 		
			}

			
			
			
	}else{
		echo "NO se han encontrado Repartos para este d&iacute;a";
	}	
}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	$smarty->assign('dia',date("d",time()));  //asigna una cadena a la variable "nombre"
	$smarty->assign('mes',date("m",time()));  //asigna una cadena a la variable "nombre"
	$smarty->assign('ano',date("Y",time()));  //asigna una cadena a la variable "nombre"
	$smarty->display('informe_resumen_envases.tpl');   //define la plantilla que utilizara
}
?>
