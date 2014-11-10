<?
	$vendedor = $_POST['vendedor'];
	$fecha_desde = $_POST['fecha_desde'];
	$fecha_hasta = $_POST['fecha_hasta'];
	
	include("conexion.php");
	$consulta = "SELECT * FROM regular_comision"; 					// consulta sql
	$result = mysql_query($consulta);            					// hace la consulta
	$registro = mysql_fetch_row($result);        					// toma el registro
	$nfilas = mysql_num_rows ($result);          					//indica la cantidad de resultados
	if ($nfilas > 0){     						 					// si existen paises
		$descuento = $registro[0]; 									// toma la variable de la url q vino de ajax.js
		$minimo = $registro[1]; 									// toma la variable de la url q vino de ajax.js
	}else{
		$descuento = 0; 											// toma la variable de la url q vino de ajax.js
		$minimo = 0; 												// toma la variable de la url q vino de ajax.js
	}
//================================================================================================================================================//
//================================================ ARTICULOS VENDIDOS SIN BONIFICACION ===========================================================//	
//================================================================================================================================================//
	
$consulta = "select DISTINCT (cod), descripcion, SUM(cant), precio, round((SUM(cant)* precio),2)as importe, bonificacion, (porc_vta)as comision_zona, comision_art, clie  FROM (
						select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, fecha, precio, bonificacion, zona.porc_vta, factura_vta.cod_vendedor, producto.porc_vta as comision_art, concat(factura_vta.cod_talonario, '-', factura_vta.num_talonario, '-', factura_vta.n_factura, '-',cliente.cod_cliente) as clie
						from zona inner join (cliente inner join (factura_vta inner join (factura_vta_detalle inner join producto 
							on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
							on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario)
							on factura_vta.cod_cliente = cliente.cod_cliente)
							on cliente.cod_zona = zona.cod_zona
						where factura_vta.fecha >= $fecha_desde  and factura_vta.fecha <= $fecha_hasta and factura_vta.cod_vendedor = $vendedor and factura_vta.observacion <> 'ANULADO' and factura_vta.observacion <> 'N/C' and factura_vta_detalle.bonificacion = 0 
						GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod),precio,bonificacion 
						UNION ALL
						select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, fecha, precio, bonificacion, zona.porc_vta, factura_vta_no_cliente.cod_vendedor, producto.porc_vta as comision_art, concat(factura_vta_no_cliente.cod_talonario, '-', factura_vta_no_cliente.num_talonario, '-', factura_vta_no_cliente.n_factura, '-', razon_social) as clie
						from zona inner join (factura_vta_no_cliente inner join (factura_vta_no_cliente_detalle inner join producto 
							on concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca, factura_vta_no_cliente_detalle.cod_variedad, factura_vta_no_cliente_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
							on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario)
							on factura_vta_no_cliente.cod_zona = zona.cod_zona
					
						where fecha >= $fecha_desde  and fecha <= $fecha_hasta and cod_vendedor = $vendedor and observacion <> 'ANULADO' 
						and observacion <> 'N/C' and  
						factura_vta_no_cliente_detalle.bonificacion = 0 
						GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod),precio,bonificacion 
				)AS comision_vendedor GROUP BY cod,precio,bonificacion ORDER BY  SUM(cod)"; // consulta sql 
					
$result = mysql_query($consulta);            // hace la consulta
$registro = mysql_fetch_row($result);        // toma el registro
$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados

if($nfilas > 0){
		//$nfilas = 0;
		$consulta_com = "SELECT * FROM comision_vendedor WHERE cod_vendedor = $vendedor AND fecha_desde >= $fecha_desde AND fecha_hasta <= $fecha_hasta ";
		$result_com = mysql_query($consulta_com);            // hace la consulta
		$nfilas_com = mysql_num_rows ($result_com);          //indica la cantidad de resultados
		$registro_com = mysql_fetch_row($result_com);        // toma el registro
		if ($nfilas_com == 0){     						 // si existe el usuario inicia la sesion
		 	$estado = "PENDIENTE DE LIQUIDACION";
		}else{
			$fecha_liq = $registro_com[3]; 									// toma la variable de la url q vino de ajax.js
			$ano_liq = substr($fecha_liq,0,4); 
			$mes_liq = substr($fecha_liq,4,2);
			$dia_liq = substr($fecha_liq,-2);
			$fecha_liq = "$dia_liq/$mes_liq/$ano_liq";										// maqueta la fecha para imprimir
			
			$estado = "LIQUIDADO EL DIA $fecha_liq";
		}
	
		$consulta_v = "SELECT nombre FROM vendedor where cod_vendedor = $vendedor"; 											// consulta sql
		$result_v = mysql_query($consulta_v);            								// hace la consulta
		$registro_v = mysql_fetch_row($result_v);        						// toma el registro
		$nombre = $registro_v[0]; 									// toma la variable de la url q vino de ajax.js
		echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
			echo "<tr >";
				echo "<td><div id='nombre_vendedor' align='left' class='seccion'><b><u>VENDEDOR:</u> $nombre</b></div><input type='hidden' name='nombre' id='nombre'  value='$nombre' >			</td>";
				echo "<td><div id='estado_div' align='left' class='seccion'><b><u>ESTADO:</u> $estado</b></div><input type='hidden' name='estado' id='estado'  value='$nombre' >			</td>";
	
			echo "</tr>";
		echo "</table>";
		echo "<br>";
		
		//---------------------abre la tabla--------------------------------------------------------------------------------------//
		echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
			echo"<tr class='totales'>";			
				echo"<td colspan='2' align='left'>&nbsp;&nbsp;ARTICULOS VENDIDOS SIN BONIFICACION</td>";
			echo"</tr>";
	
			echo "<tr class='top'>";
				echo "<td width='10%' ><div align='center' class='seccion'>Codigo</div></td>";
				echo "<td width='23%' ><div align='center' class='seccion'>Descripci&oacute;n</div></td>";
				echo "<td width='7%'  ><div align='center' class='seccion'>Cantidad</div></td>";
				echo "<td width='10%' ><div align='center' class='seccion'>Precio Vta.</div></td>";
				echo "<td width='10%' ><div align='center' class='seccion'>Importe</div></td>";
				echo "<td width='10%' ><div align='center' class='seccion'>% Bonificaci&oacute;n</div></td>";
				echo "<td width='10%' ><div align='center' class='seccion'>Comisi&oacute;n Zona</div></td>";
				echo "<td width='10%' ><div align='center' class='seccion'>Comisi&oacute;n Art&iacute;culo</div></td>";
				echo "<td width='10%' ><div align='center' class='seccion'>Importe Comisi&oacute;n</div></td>";
			echo "</tr>";
			$clase="class='filas'"; 							//defino la clase para las filas
	
			do{ 	// obtengo los resultados 
					$codigo = $registro[0];
					$desc = $registro[1];	
					$cantidad = $registro[2];
					$precio=$registro[3];
					$importe=$registro[4];
					
					$total_importe = $total_importe+$importe;
					$total_importe =number_format($total_importe,2,'.','');
					
					$bonif =$registro[5];
					$com_zona=$registro[6];
					$com_art=$registro[7];
					$clie=$registro[8];
					
					$comision = ($com_zona + $com_art) - (  (($com_zona + $com_art) *($bonif * $descuento))/100) ; // obtengo la comision regulada 
					$total_fila = ((( $importe - ($importe*$bonif)/100) * $comision)/100);
					
					$total_comision = $total_comision+$total_fila;
					$total_comision =number_format($total_comision,2,'.','');
					
					echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
						echo "<td rowspan='$cant' $clase align='center'>";
								echo $codigo;     
						echo"</td>";
						echo "<td rowspan='$cant' $clase align='left'>";
								echo $desc;//." / ".$clie;
						echo"</td>";
						echo "<td rowspan='$cant' $clase align='right'>";
								echo $cantidad.$espacio_izq;     
						echo"</td>";
						echo "<td rowspan='$cant' $clase align='right'>";
								echo number_format($precio,2,'.','').$espacio_izq;     
						echo"</td>";
						echo "<td rowspan='$cant' $clase align='right'>";
								echo number_format($importe,2,'.','').$espacio_izq;    
						echo"</td>";
						echo "<td rowspan='$cant' $clase align='right'>";
								echo $bonif.$espacio_izq;   
						echo"</td>";
						echo "<td rowspan='$cant' $clase align='right'>";
								echo number_format($com_zona,2,'.','').$espacio_izq;
						echo"</td>";
						echo "<td rowspan='$cant' $clase align='right'>";
								echo number_format($com_art,2,'.','').$espacio_izq;
						echo"</td>";
						echo "<td rowspan='$cant' $clase align='right'>";
								echo number_format($total_fila,2,'.','').$espacio_izq;   
						echo"</td>";
	
					echo"</tr>";
			}while($registro = mysql_fetch_array($result)); //end while
			
			echo"<tr bgcolor='#E0E0E0' >";			
				echo"<td colspan='4' align='left'>&nbsp;&nbsp;TOTALES	</td>";
				echo"<td align='right'>$total_importe$espacio_izq  		</td>";
				echo"<td colspan='3' align='center'> 					</td>";
				echo"<td align='right'>$total_comision$espacio_izq 		</td>";
			echo"</tr>";
	
		echo "</table>";   
		//---------------------cierra tabla--------------------------------------------------------------------------------------//
}	
	//================================================================================================================================================//
	//================================================ ARTICULOS VENDIDOS CON BONIFIACION ============================================================//	
	//================================================================================================================================================//
		
	$consulta = "select DISTINCT (cod), descripcion, SUM(cant), precio, (SUM(cant)* precio)as importe, bonificacion, (porc_vta)as comision_zona, comision_art  FROM (
							select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad)                            as cant, fecha, precio, bonificacion, zona.porc_vta, factura_vta.cod_vendedor, producto.porc_vta as comision_art
							from zona inner join (cliente inner join (factura_vta inner join (factura_vta_detalle inner join producto 
								on concat(factura_vta_detalle.cod_grupo, factura_vta_detalle.cod_marca, factura_vta_detalle.cod_variedad, factura_vta_detalle.cod_prod) 		                                = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
								on factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario)
								on factura_vta.cod_cliente = cliente.cod_cliente)
								on cliente.cod_zona = zona.cod_zona
							where factura_vta.fecha >= $fecha_desde  and factura_vta.fecha <= $fecha_hasta and factura_vta.cod_vendedor = $vendedor and factura_vta.observacion <> 'ANULADO' and observacion <> 'N/C' and factura_vta_detalle.bonificacion > 0 
							GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod),precio,bonificacion 
							UNION ALL
							select DISTINCT (concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod))as cod, descripcion,SUM(cantidad) as cant, fecha, precio, bonificacion, zona.porc_vta, factura_vta_no_cliente.cod_vendedor, producto.porc_vta as comision_art  
							from zona inner join (factura_vta_no_cliente inner join (factura_vta_no_cliente_detalle inner join producto 
								on concat(factura_vta_no_cliente_detalle.cod_grupo, factura_vta_no_cliente_detalle.cod_marca, factura_vta_no_cliente_detalle.cod_variedad, factura_vta_no_cliente_detalle.cod_prod) = concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod)) 
								on factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario)
								on factura_vta_no_cliente.cod_zona = zona.cod_zona
						
							where fecha >= $fecha_desde  and fecha <= $fecha_hasta and cod_vendedor = $vendedor and observacion <> 'ANULADO' and observacion <> 'N/C' and factura_vta_no_cliente_detalle.bonificacion > 0 
							GROUP BY concat(producto.cod_grupo, producto.cod_marca, producto.cod_variedad, producto.cod_prod),precio,bonificacion
				)AS comision_vendedor GROUP BY cod,precio,bonificacion ORDER BY  SUM(cod)"; // consulta sql 
						
	$result = mysql_query($consulta);            		// hace la consulta
	$registro = mysql_fetch_row($result);        		// toma el registro
	$nfilas2 = mysql_num_rows ($result);          		//indica la cantidad de resultados

if($nfilas2 > 0){
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	//echo"<br>";
	echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
		echo"<tr class='totales'>";			
			echo"<td colspan='2' align='left'>&nbsp;&nbsp;ARTICULOS VENDIDOS CON BONIFICACION</td>";
		echo"</tr>";

		echo "<tr class='top'>";
				echo "<td width='10%' ><div align='center' class='seccion'>Codigo</div></td>";
				echo "<td width='23%' ><div align='center' class='seccion'>Descripci&oacute;n</div></td>";
				echo "<td width='7%'  ><div align='center' class='seccion'>Cantidad</div></td>";
				echo "<td width='10%' ><div align='center' class='seccion'>Precio Vta.</div></td>";
				echo "<td width='10%' ><div align='center' class='seccion'>Importe</div></td>";
				echo "<td width='10%' ><div align='center' class='seccion'>% Bonificaci&oacute;n</div></td>";
				echo "<td width='10%' ><div align='center' class='seccion'>Comisi&oacute;n Zona</div></td>";
				echo "<td width='10%' ><div align='center' class='seccion'>Comisi&oacute;n Art&iacute;culo</div></td>";
				echo "<td width='10%' ><div align='center' class='seccion'>Importe Comisi&oacute;n</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas

		do{ 	// obtengo los resultados 
				$codigo = $registro[0];
				$desc = $registro[1];	
				$cantidad = $registro[2];
				$precio=$registro[3];
				$importe=$registro[4];
				
				$total_importe2 = $total_importe2+$importe;
				$total_importe2 =number_format($total_importe2,2,'.','');
				
				$bonif =$registro[5];
				$com_zona=$registro[6];
				$com_art=$registro[7];
				
				$comision = ($com_zona + $com_art) - ((($com_zona + $com_art) *($bonif * $descuento))/100) ; // obtengo la comision regulada
				if($comision < 0){
					$comision = $minimo;
				}
				$total_fila = ((( $importe - ($importe*$bonif)/100) * $comision)/100);
				
				$total_comision2 = $total_comision2+$total_fila;
				$total_comision2 =number_format($total_comision2,2,'.','');

				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td rowspan='$cant' $clase align='center'>";
							echo $codigo;     
					echo"</td>";
					echo "<td rowspan='$cant' $clase align='left'>";
							echo $desc;     
					echo"</td>";
					echo "<td rowspan='$cant' $clase align='right'>";
							echo $cantidad.$espacio_izq;     
					echo"</td>";
					echo "<td rowspan='$cant' $clase align='right'>";
							echo number_format($precio,2,'.','').$espacio_izq;     
					echo"</td>";
					echo "<td rowspan='$cant' $clase align='right'>";
							echo number_format($importe,2,'.','').$espacio_izq;    
					echo"</td>";
					echo "<td rowspan='$cant' $clase align='right'>";
							echo $bonif.$espacio_izq;   
					echo"</td>";
					echo "<td rowspan='$cant' $clase align='right'>";
							echo number_format($com_zona,2,'.','').$espacio_izq;
					echo"</td>";
					echo "<td rowspan='$cant' $clase align='right'>";
							echo number_format($com_art,2,'.','').$espacio_izq;
					echo"</td>";
					echo "<td rowspan='$cant' $clase align='right'>";
							echo number_format($total_fila,2,'.','').$espacio_izq;   
					echo"</td>";

				echo"</tr>";
		}while($registro = mysql_fetch_array($result)); //end while
		
		echo"<tr bgcolor='#E0E0E0' >";			
			echo"<td colspan='4' align='left'>&nbsp;&nbsp;TOTALES	</td>";
			echo"<td align='right'>$total_importe2$espacio_izq  	</td>";
			echo"<td colspan='3' align='center'> 					</td>";
			echo"<td align='right'>$total_comision2$espacio_izq   	</td>";
		echo"</tr>";

	echo "</table>"; 
	//---------------------cierra tabla--------------------------------------------------------------------------------------//
}	
echo "<br>";
if($nfilas > 0 || $nfilas2 > 0){
	$total_percibir= $total_comision + $total_comision2;
	$total_importe_fact= $total_importe + $total_importe2;
		
	$total_percibir= number_format($total_percibir,2,'.','');
	$total_importe_fact= number_format($total_importe_fact,2,'.','');
	
	echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
		echo"<tr class='totales'>";			
			echo"<td width='50%' align='left'>&nbsp;&nbsp;<b>TOTALES</b></td>";
			echo"<td width='10%' align='right'><b>$total_importe_fact$espacio_izq</b></td>";
			echo"<td width='30%' align='center'></td>";
			echo"<td width='10%' align='right'><b>$total_percibir$espacio_izq</b></td>";
		echo"</tr>";
	echo "</table>"; 

	//===================== DEVOLUCIONES =======================================//	
	$consulta = "select round(sum(precio),2)as total 
				 from devolucion inner join devolucion_detalle on devolucion_detalle.n_devolucion = devolucion.n_devolucion 
				 where fecha_carga >= $fecha_desde  and fecha_carga <= $fecha_hasta and cod_vendedor = $vendedor"; // consulta sql 
						
	$result = mysql_query($consulta);            		// hace la consulta
	$registro = mysql_fetch_row($result);        		// toma el registro
	$nfilas3 = mysql_num_rows ($result);          		//indica la cantidad de resultados
	echo "<br>";
	if($nfilas3 > 0){
		$importe_devolucion = number_format($registro[0],2,'.','');
		//echo"<br>";
		echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
			echo"<tr class='totales'>";			
				echo"<td width='50%' align='left'>&nbsp;&nbsp;<b>TOTAL DEVOLUCIONES</b></td>";
				echo"<td width='10%' align='right'><b>$importe_devolucion</b></td>";
				echo"<td width='40%' align='center' colspan='2'></td>";
			echo"</tr>";
		echo "</table>"; 
	}

	
	//----------------------------CREA LAS VARIABLES PARA LA IMPRESION---------------------------//		
	echo"<input type='hidden' name='total_importe' id='total_importe' value='$total_importe'> ";
	echo"<input type='hidden' name='total_comision' id='total_comision' value='$total_comision'> ";
	echo"<input type='hidden' name='total_importe2' id='total_importe2' value='$total_importe2'> ";
	echo"<input type='hidden' name='total_comision2' id='total_comision2' value='$total_comision2'> ";

	echo"<input type='hidden' name='total_devolucion' id='total_devolucion' value='$importe_devolucion'> ";

	echo " <input type='hidden' name='total_importe_fact' id='total_importe_fact'    value=$total_importe_fact >"; 
	echo " <input type='hidden' name='total_percibir'     id='total_percibir'        value=$total_percibir >"; 

}?>