<?
$fecha_buscar = $_POST['fecha_buscar'];

if($fecha_buscar){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	 $consulta ="select cod_proveedor, SUM(round(subtotal,2)), SUM(round(iva_monto,2)), SUM(round($factura_compra_otros_impuestos,2)), SUM(round(total,2))
				from factura_compra 
				where fecha_fact = $fecha_buscar 
				group by cod_proveedor";
	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	if($filas > 0){
			echo "<div  align='right' class='seccion'>";
				echo "<img src='../imagenes/pdf.gif' width='18' height='18' border='0' class='iconos'  title='Exportar' onClick=\"javascript: exportar_listado_compra_del_dia('exportar_informe_compras_del_dia.php')\" /> pdf  &nbsp;&nbsp;<img src='../imagenes/imprimir.png' width='18' height='18' title='Imprimir' class='iconos' onClick=\"javascript: imprimir_listado_compra_del_dia('exportar_informe_compras_del_dia.php')\" /> imprimir";
			echo "</div>";
			echo "<br>";
			//---------------------abre la tabla--------------------------------------------------------------------------------------//
			echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
				echo "<tr class='top'>";
					echo "<td width='40%' ><div align='center' class='seccion'>PROVEEDOR</div></td>";
					echo "<td width='15%' ><div align='center' class='seccion'>TOTAL SIN IMPUESTOS</div></td>";
					echo "<td width='5%' ><div align='center' class='seccion'>IVA</div></td>";
					echo "<td width='15%' ><div align='center' class='seccion'>OTROS IMPUESTOS</div></td>";
					echo "<td width='15%' ><div align='center' class='seccion'>TOTAL</div></td>";
					echo "<td width='5%' ><div align='center' class='seccion'>DETALLE</div></td>";
				echo "</tr>";
				$clase="class='filas'"; 							//defino la clase para las filas
				do{ 					// obtengo los resultados 
						$cod_proveedor=$registro[0];
						$consulta2 = "SELECT razon_social FROM proveedor where cod_proveedor = $cod_proveedor"; // consulta sql
						$result2 = mysql_query($consulta2);            // hace la consulta
						$registro2 = mysql_fetch_row($result2);        // toma el registro
						$proveedor = $registro2[0];

						$total_sin_imp=$registro[1];
						$total_iva=$registro[2];
						$total_otros_imp=$registro[3];
						$total_factura=$registro[4];
						
						echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
							echo "<td $clase align='left'>";
									echo $espacio_izq.$proveedor;     
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
									echo "<img  class='iconos' src='../imagenes/detalle.gif' border='0' title='Ver detalle' onClick='javascript:buscar_compra_dia_detalle($cod_proveedor)'>"; 
							echo"</td>";
		
							$total_carga_sin_imp= $total_carga_sin_imp + $total_sin_imp;
							$total_carga_iva = $total_carga_iva + $total_iva;
							$total_carga_otros_imp= $total_carga_otros_imp + $total_otros_imp;
							$total_carga_factura = $total_carga_factura + $total_factura;
							
						echo"</tr>";
				}while($registro = mysql_fetch_row($result)); // obtengo los resultados 		
				
						echo"<tr bgcolor='#E0E0E0' >";			
							echo"<td align='left'>&nbsp;&nbsp;TOTALES	</td>";
							
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
		echo "NO se han encontrado Compras para este d&iacute;a";
	}	
}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	$smarty->assign('dia',date("d",time()));  //asigna una cadena a la variable "nombre"
	$smarty->assign('mes',date("m",time()));  //asigna una cadena a la variable "nombre"
	$smarty->assign('ano',date("Y",time()));  //asigna una cadena a la variable "nombre"
	$smarty->display('informe_compras_del_dia.tpl');   //define la plantilla que utilizara
}
?>
