<?
	$fecha_desde = $_POST['fecha_desde'];
	$fecha_hasta = $_POST['fecha_hasta'];
	include("conexion.php");
	
	echo "<div  align='right' class='seccion'>";
	echo "<img src='../imagenes/pdf.gif' width='18' height='18' border='0' class='iconos'  title='Exportar' onClick=\"javascript: exportar_informe_caja_rentabilidad('exportar_informe_caja_rentabilidad.php')\" /> pdf  &nbsp;&nbsp;<img src='../imagenes/imprimir.png' width='18' height='18' title='Imprimir' class='iconos' onClick=\"javascript: imprimir_informe_caja_rentabilidad('exportar_informe_caja_rentabilidad.php')\" /> imprimir";
	echo "</div>";
	echo "<br>";
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
		echo "<tr class='top'>";
			echo "<td width='40%' ><div align='center' class='seccion'>CONCEPTO</div></td>";
			echo "<td width='15%' ><div align='center' class='seccion'>TOTAL SIN IMPUESTOS</div></td>";
			echo "<td width='5%' ><div align='center' class='seccion'>IVA</div></td>";
			echo "<td width='15%' ><div align='center' class='seccion'>OTROS IMPUESTOS</div></td>";
			echo "<td width='15%' ><div align='center' class='seccion'>TOTAL</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas

	//---------------------------------------------------------------------------------------------//
	//--------------------------------------CAJA INICIAL-------------------------------------------//
	//---------------------------------------------------------------------------------------------//
	$consulta ="SELECT fecha, SUM(importe) FROM caja_inicial where fecha >= $fecha_desde and fecha <= $fecha_hasta GROUP BY fecha ORDER BY fecha";
	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	if($filas > 0){
		do{ 					// obtengo los resultados 
				$fecha_caja=$registro[0];
			    $fecha_caja_ano=substr($fecha_caja,0,4);
			    $fecha_caja_mes=substr($fecha_caja,4,2);
			    $fecha_caja_dia=substr($fecha_caja,-2);
				$fecha_caja = "$fecha_caja_dia/$fecha_caja_mes/$fecha_caja_dia";

				$importe = number_format($registro[1],2,'.','');
			
			echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
				echo "<td $clase colspan = 4 align='left'>";
						echo $espacio_izq.'CAJA INICIAL';     
				echo"</td>";
				echo "<td $clase align='right'>";
						echo $importe.$espacio_izq;     
				echo"</td>";

				$total_caja_inicial =  $total_caja_inicial + $importe;
			echo"</tr>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 		
	}
	
	//---------------------------------------------------------------------------------------------//
	//--------------------------------------VENTAS-------------------------------------------------//
	//---------------------------------------------------------------------------------------------//
	$consulta =" select  SUM(round(total_sin_impuesto,2)), SUM(round(iva,2)), SUM(round(otros_impuestos,2)), SUM(round(total_general,2))
					FROM(
								select  
								$calculo_importe_no_cliente
								(factura_vta_no_cliente.num_talonario)talonario
								$from_no_cliente
								where fecha >= $fecha_desde and fecha <= $fecha_hasta and observacion <> 'ANULADO' and observacion <> 'N/C' 
								GROUP BY factura_vta_no_cliente_detalle.iva
							UNION ALL
								select 
								$calculo_importe_cliente
								(factura_vta.num_talonario)as talonario
								$from_cliente
								where fecha >= $fecha_desde and fecha <= $fecha_hasta and observacion <> 'ANULADO' and observacion <> 'N/C' 
								GROUP BY factura_vta_detalle.iva
					) AS carga_caja";
	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	if($filas > 0){
		do{ 					// obtengo los resultados 
			$total_sin_imp=number_format($registro[0],2,'.','');
			$total_iva=number_format($registro[1],2,'.','');
			$total_otros_imp=number_format($registro[2],2,'.','');
			$total_factura=number_format($registro[3],2,'.','');
			
			echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
				echo "<td $clase align='left'>";
						echo $espacio_izq.'VENTAS';     
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

				$total_venta_sin_imp= $total_venta_sin_imp + $total_sin_imp;
				$total_venta_iva = $total_venta_iva + $total_iva;
				$total_venta_otros_imp= $total_venta_otros_imp + $total_otros_imp;
				$total_venta_factura = $total_venta_factura + $total_factura;
			echo"</tr>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 		
	}else{
		echo "NO se han encontrado Ventas para este d&iacute;a";
	}
	
	//---------------------------------------------------------------------------------------------//
	//--------------------------------------COMPRAS------------------------------------------------//
	//---------------------------------------------------------------------------------------------//
	$consulta ="select SUM(round(subtotal,2)), SUM(round(iva_monto,2)), SUM(round($factura_compra_otros_impuestos,2)), SUM(round(total,2))
				from factura_compra 
				where fecha_fact >= $fecha_desde and fecha_fact <= $fecha_hasta";
	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	if($filas > 0){
		do{ 					// obtengo los resultados 
			$total_sin_imp= number_format($registro[0],2,'.','');
			$total_iva=number_format($registro[1],2,'.','');
			$total_otros_imp=number_format($registro[2],2,'.','');
			$total_factura=number_format($registro[3],2,'.','');
			
			echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
				echo "<td $clase align='left'>";
						echo $espacio_izq.'COMPRAS';     
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

				$total_compra_sin_imp = $total_compra_sin_imp + $total_sin_imp;
				$total_compra_iva = $total_compra_iva + $total_iva;
				$total_compra_otros_imp= $total_compra_otros_imp + $total_otros_imp;
				$total_compra_factura = $total_compra_factura + $total_factura;
				
			echo"</tr>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	}else{
		echo "NO se han encontrado Compras para este d&iacute;a";
	}	
	
	//---------------------------------------------------------------------------------------------//
	//--------------------------------------GASTOS-------------------------------------------------//
	//---------------------------------------------------------------------------------------------//
	
	$consulta ="SELECT SUM(round(importe,2)), SUM(round(iva,2)), SUM(round(otros_impuestos,2)), SUM(round(total,2)) FROM gastos where fecha >= $fecha_desde and fecha <= $fecha_hasta";
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	if($filas > 0){
		do{ 					// obtengo los resultados 
			$importe=number_format($registro[0],2,'.','');
			$iva=number_format($registro[1],2,'.','');
			$otros_imp=number_format($registro[2],2,'.','');
			$total=number_format($registro[3],2,'.','');
			
			echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
				echo "<td $clase align='left'>";
						echo $espacio_izq.'GASTOS';     
				echo"</td>";
				echo "<td $clase align='right'>";
						echo $importe.$espacio_izq;     
				echo"</td>";
				echo "<td $clase align='right'>";
						echo $iva.$espacio_izq;     
				echo"</td>";
				echo "<td $clase align='right'>";
						echo $otros_imp.$espacio_izq;     
				echo"</td>";
				echo "<td $clase align='right'>";
						echo $total.$espacio_izq;     
				echo"</td>";

				$total_gasto_importe = $total_gasto_importe + $importe;
				$total_gasto_iva = $total_gasto_iva + $iva;
				$total_gasto_otros_imp= $total_gasto_otros_imp + $otros_imp;
				$total_gasto_total = $total_gasto_total + $total;
				
			echo"</tr>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	}else{
		echo "NO se han encontrado Gastos para este d&iacute;a";
	}	

echo "</table>";   
//---------------------cierra tabla--------------------------------------------------------------------------------------//

//---------------------------------------------------------------------------------------------//
//--------------------------------------CAJA / RENTABILIDAD------------------------------------//
//---------------------------------------------------------------------------------------------//

$caja = number_format($total_caja_inicial + $total_venta_factura - $total_compra_factura - $total_gasto_total,2,'.','');
$rentabilidad = number_format($total_caja_inicial + $total_venta_sin_imp - $total_compra_sin_imp - $total_gasto_importe,2,'.','');

if($caja > 0){
	$caja .= "  <img  class='iconos' src='../imagenes/alta.gif' border='0' title='Ver detalle' onClick='javascript:  			    buscar_venta_dia_detalle($repartidor)'>"; 
}else{ 
	$caja .= "  <img  class='iconos' src='../imagenes/baja.gif' border='0' title='Ver detalle' onClick='javascript:  			    buscar_venta_dia_detalle($repartidor)'>"; 
}

if($rentabilidad > 0){
	$rentabilidad .= "  <img  class='iconos' src='../imagenes/alta.gif' border='0' title='Ver detalle' onClick='javascript:  			    buscar_venta_dia_detalle($repartidor)'>"; 
}else{ 
	$rentabilidad  .= "  <img  class='iconos' src='../imagenes/baja.gif' border='0' title='Ver detalle' onClick='javascript:  			    buscar_venta_dia_detalle($repartidor)'>"; 
}

echo"<br>";
echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
	echo "<tr class='top'>";
		echo "<td width='80%' ><div align='center' class='seccion'>CONCEPTO</div></td>";
		echo "<td width='20%' ><div align='center' class='seccion'>IMPORTE</div></td>";
	echo "</tr>";

	$clase="class='filas'"; 							//defino la clase para las filas
	echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
		echo "<td $clase align='left'>";
				echo $espacio_izq.'CAJA';     
		echo"</td>";
		echo "<td $clase align='right'>";
				echo $caja.$espacio_izq;     
		echo"</td>";
	echo"</tr>";			
	
	echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
		echo "<td $clase align='left'>";
				echo $espacio_izq.'RENTABILIDAD';     
		echo"</td>";
		echo "<td $clase align='right'>";
				echo $rentabilidad.$espacio_izq;     
		echo"</td>";
	echo"</tr>";			

echo "</table>";   
//---------------------cierra tabla--------------------------------------------------------------------------------------//
?>