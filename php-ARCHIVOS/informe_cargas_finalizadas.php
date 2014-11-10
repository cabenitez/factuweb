<?
	include("conexion.php");

$fecha_buscar = $_POST['fecha_buscar'];

if($fecha_buscar){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$consulta ="select  repartidor, SUM(round(total_sin_impuesto,2)), SUM(round(iva,2)), SUM(round(otros_impuestos,2)), SUM(round(total_general,2))
				FROM(
							select  cod_repartidor as repartidor,
							
							$calculo_importe_no_cliente

							(factura_vta_no_cliente.num_talonario)talonario
							
							$from_no_cliente
							
							where fecha = $fecha_buscar and observacion <> 'ANULADO' and observacion <> 'N/C' and factura_vta_no_cliente.num_remito = 0 
							
							GROUP BY factura_vta_no_cliente_detalle.iva
							
						UNION
							select cod_repartidor as  repartidor,
							
							$calculo_importe_cliente

							(factura_vta.num_talonario)as talonario
							
							$from_cliente
							
							where fecha = $fecha_buscar and observacion <> 'ANULADO' and observacion <> 'N/C' and factura_vta.num_remito = 0 
							
							GROUP BY factura_vta_detalle.iva
							
				) AS carga_caja GROUP BY repartidor ORDER BY repartidor";

	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	if($filas > 0){
			echo "<div  align='right' class='seccion'>";
				echo "<img src='../imagenes/pdf.gif' width='18' height='18' border='0' class='iconos'  title='Exportar' onClick=\"javascript: exportar_listado_venta_del_dia('exportar_informe_cargas_finalizadas.php')\" /> pdf  &nbsp;&nbsp;<img src='../imagenes/imprimir.png' width='18' height='18' title='Imprimir' class='iconos' onClick=\"javascript: imprimir_listado_venta_del_dia('exportar_informe_cargas_finalizadas.php')\" /> imprimir";
			echo "</div>";
			echo "<br>";
			//---------------------abre la tabla--------------------------------------------------------------------------------------//
			echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
				echo "<tr class='top'>";
					echo "<td width='40%' ><div align='center' class='seccion'>REPARTIDOR</div></td>";
					echo "<td width='22%' ><div align='center' class='seccion'>ESTADO</div></td>";
					echo "<td width='10%' ><div align='center' class='seccion'>TOTAL SIN IMP.</div></td>";
					echo "<td width='7%' ><div align='center' class='seccion'>IVA</div></td>";
					echo "<td width='7%' ><div align='center' class='seccion'>OTROS IMP.</div></td>";
					echo "<td width='7%' ><div align='center' class='seccion'>TOTAL</div></td>";
					echo "<td width='7%' ><div align='center' class='seccion'>DETALLE</div></td>";
				echo "</tr>";
				$clase="class='filas'"; 							//defino la clase para las filas
				do{ 					// obtengo los resultados 
						$repartidor=$registro[0];
						$consulta2 = "SELECT nombre FROM fletero where cod_flero = $repartidor"; // consulta sql
						$result2 = mysql_query($consulta2);            // hace la consulta
						$registro2 = mysql_fetch_row($result2);        // toma el registro
						$nombre_fletero = $registro2[0];
		
						
						$total_sin_imp=$registro[1];
						$total_iva=$registro[2];
						$total_otros_imp=$registro[3];
						$total_factura=$registro[4];
						
						echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
							echo "<td $clase align='left'>";
									echo $espacio_izq.$repartidor.' - '.$nombre_fletero;     
							echo"</td>";
							echo "<td $clase align='left'>";
									$consulta2 = "SELECT hora, usuario FROM cargas where cod_flero = $repartidor and fecha = $fecha_buscar"; // consulta sql
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
										echo $espacio_izq."FINALIZADA POR: $usuario_c  -  $hora_c";
									}else{
										echo $espacio_izq."PENDIENTE";
									}
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
									echo "<img  class='iconos' src='../imagenes/detalle.gif' border='0' title='Ver detalle' onClick='javascript: buscar_carga_dia_detalle($repartidor)'>"; 
							echo"</td>";
		
							$total_carga_sin_imp= $total_carga_sin_imp + $total_sin_imp;
							$total_carga_iva = $total_carga_iva + $total_iva;
							$total_carga_otros_imp= $total_carga_otros_imp + $total_otros_imp;
							$total_carga_factura = $total_carga_factura + $total_factura;
							
						echo"</tr>";
				}while($registro = mysql_fetch_row($result)); // obtengo los resultados 		
				
						echo"<tr bgcolor='#E0E0E0' >";			
							echo"<td align='left' colspan = 2 >&nbsp;&nbsp;TOTALES	</td>";
							
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
	}else{
		echo "NO se han encontrado Repartos para este d&iacute;a";
	}	
}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	$smarty->assign('dia',date("d",time()));  //asigna una cadena a la variable "nombre"
	$smarty->assign('mes',date("m",time()));  //asigna una cadena a la variable "nombre"
	$smarty->assign('ano',date("Y",time()));  //asigna una cadena a la variable "nombre"
	$smarty->display('informe_cargas_finalizadas.tpl');   //define la plantilla que utilizara  
}
?>
