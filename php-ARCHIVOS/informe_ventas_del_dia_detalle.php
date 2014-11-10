<?
$fecha_buscar = $_POST['fecha_buscar'];
$repartidor = $_POST['repartidor'];

if($fecha_buscar){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$consulta =" select descripcion,n_sucursal, n_factura, razon_social, sum(round(total_sin_impuesto,2)), sum(round(iva,2)),sum(round(otros_impuestos,2)),sum(round(total_general,2)), talonario, observacion, cod_talonario  
				    FROM (
						select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta_no_cliente.n_factura, factura_vta_no_cliente.razon_social,

						$calculo_importe_no_cliente		
						
						(factura_vta_no_cliente.num_talonario)talonario, observacion, factura_vta_no_cliente.cod_talonario
						
						$from_no_cliente
						
						where fecha = $fecha_buscar and cod_repartidor = $repartidor
						 
						-- and observacion <> 'ANULADO' and observacion <> 'N/C'
						
						GROUP BY factura_vta_no_cliente_detalle.iva, factura_vta_no_cliente.cod_talonario, factura_vta_no_cliente.num_talonario, factura_vta_no_cliente.n_factura
						
					UNION ALL
						select tipo_talonario.descripcion, talonario.n_sucursal, factura_vta.n_factura, cliente.razon_social as nombre, 
							
						$calculo_importe_cliente
							
						(factura_vta.num_talonario)as talonario, observacion, factura_vta.cod_talonario
						
						$from_cliente
						
						where fecha = $fecha_buscar and cod_repartidor = $repartidor
						 
						-- and observacion <> 'ANULADO' 
						
						GROUP BY factura_vta_detalle.iva, factura_vta.cod_talonario, factura_vta.num_talonario, factura_vta.n_factura
						
				) AS ventas_repartidor GROUP BY cod_talonario, talonario, n_factura ORDER BY descripcion ";

	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<br>";
	echo "<div  align='center' class='seccion'><b><u>DETALLE POR REPARTIDOR</u> $nombre</b></div>";

	echo "<div  align='right' class='seccion'>";
		echo "<img src='../imagenes/pdf.gif' width='18' height='18' border='0' class='iconos'  title='Exportar' onClick=\"javascript: exportar_listado_venta_del_dia_detalle('exportar_informe_ventas_del_dia_detalle.php')\" /> pdf  &nbsp;&nbsp;<img src='../imagenes/imprimir.png' width='18' height='18' title='Imprimir' class='iconos' onClick=\"javascript: imprimir_listado_venta_del_dia_detalle('exportar_informe_ventas_del_dia_detalle.php')\" /> imprimir";
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
		//---------------------cierra tabla--------------------------------------------------------------------------------------//
}
?>
