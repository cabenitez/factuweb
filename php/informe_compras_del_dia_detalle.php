<?
$fecha_buscar = $_POST['fecha_buscar'];
$cod_proveedor = $_POST['proveedor'];

if($fecha_buscar){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	 $consulta ="select cod_proveedor, SUM(round(subtotal,2)), SUM(round(iva_monto,2)), SUM(round($factura_compra_otros_impuestos,2)), SUM(round(total,2)), n_factura, n_sucursal, fecha_reg, observacion, usuario, id_deposito
				from factura_compra 
				where fecha_fact = $fecha_buscar and cod_proveedor = $cod_proveedor 
				group by n_factura, n_sucursal";

	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<br>";
	echo "<div  align='center' class='seccion'><b><u>DETALLE POR PROVEEDOR</u> $nombre</b></div>";

	echo "<div  align='right' class='seccion'>";
		echo "<img src='../imagenes/pdf.gif' width='18' height='18' border='0' class='iconos'  title='Exportar' onClick=\"javascript: exportar_listado_compra_del_dia_detalle('exportar_informe_compras_del_dia_detalle.php')\" /> pdf  &nbsp;&nbsp;<img src='../imagenes/imprimir.png' width='18' height='18' title='Imprimir' class='iconos' onClick=\"javascript: imprimir_listado_compra_del_dia_detalle('exportar_informe_compras_del_dia_detalle.php')\" /> imprimir";
	echo "</div>";


	echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
		
		$cod_proveedor=$registro[0];
		$consulta2 = "SELECT razon_social FROM proveedor where cod_proveedor = $cod_proveedor"; // consulta sql
		$result2 = mysql_query($consulta2);            // hace la consulta
		$registro2 = mysql_fetch_row($result2);        // toma el registro
		$proveedor = $registro2[0];

		echo"<tr class='totales'>";			
			echo"<td colspan='2' align='left'>&nbsp;&nbsp;$proveedor";
			echo "<input name='oculto_proveedor' id='oculto_proveedor' type='hidden' value=$cod_proveedor ";
			echo"</td>";
		echo"</tr>";

		echo "<tr class='top'>";
        	echo "<td width='10%' ><div align='center' class='seccion'>COMPROBANTE</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>FECHA REG.</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>USUARIO</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>OBSERVACION</div></td>";
			echo "<td width='12%' ><div align='center' class='seccion'>TOTAL SIN IMPUESTOS</div></td>";
			echo "<td width='5%' ><div align='center' class='seccion'>IVA</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>OTROS IMPUESTOS</div></td>";
        	echo "<td width='8%' ><div align='center' class='seccion'>TOTAL</div></td>";
			echo "<td width='5%' ><div align='center' class='seccion'>DEPOSITO</div></td>";
			echo "<td width='5%' ><div align='center' class='seccion'>DETALLE</div></td>";
		echo "</tr>";
		
		$clase="class='filas'"; 							//defino la clase para las filas
		echo"<div ID='overDiv' STYLE='position:absolute; visibility:hide; z-index: 1;'>";   // Capa para el detalle tipo tooltip
		
		do{ 					// obtengo los resultados 
						$total_sin_imp=$registro[1];
						$total_iva=$registro[2];
						$total_otros_imp=$registro[3];
						$total_factura=$registro[4];
						$n_fact=$registro[5];
						$suc=$registro[6];
						$fecha_reg=$registro[7];
						$fecha_reg = substr($fecha_reg,6,2)."/".substr($fecha_reg,4,2)."/".substr($fecha_reg,0,4);
						
						$observacion=$registro[8];
						$usuario=$registro[9];
						$id_deposito=$registro[10];
						
						$total_carga_sin_imp= $total_carga_sin_imp + $total_sin_imp;
					 	$total_carga_iva = $total_carga_iva + $total_iva;
						$total_carga_otros_imp= $total_carga_otros_imp + $total_otros_imp;
						$total_carga_factura =$total_carga_factura + $total_factura;

				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='left'>";
							echo $espacio_izq.$suc.' '.$n_fact;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$fecha_reg;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$usuario;     
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
							if($id_deposito > 0){
								$consulta2 = "SELECT * FROM deposito where id = $id_deposito"; // consulta sql
								$result2 = mysql_query($consulta2);            // hace la consulta
								$registro2 = mysql_fetch_row($result2);        // toma el registro
								
								$codigo = $registro2[0];
								$fecha = $registro2[1];
								$fecha = substr($fecha,6,2)."/".substr($fecha,4,2)."/".substr($fecha,0,4);
								$hora = $registro2[2];
								$banco = $registro2[3];
								$n_trans = $registro2[4];
								$n_cta = $registro2[5];
								$titular = $registro2[6];
								$importe = number_format($registro2[7],2,'.','');
								$observacion = $registro2[8];

								$detelle_tooltip = "<U>Fecha:</U> ".$fecha;
								$detelle_tooltip .= "<br>";
								$detelle_tooltip .= "<U>Hora:</U> ".$hora;
								$detelle_tooltip .= "<br>";
								$detelle_tooltip .= "<U>Banco:</U> ".$banco;
								$detelle_tooltip .= "<br>";
								$detelle_tooltip .= "<U>N&ordm; Trans.:</U> ".$n_trans;
								$detelle_tooltip .= "<br>";
								$detelle_tooltip .= "<U>N&ordm; Cta:</U> ".$n_cta;
								$detelle_tooltip .= "<br>";
								$detelle_tooltip .= "<U>Titular:</U> ".$titular;
								$detelle_tooltip .= "<br>";
								$detelle_tooltip .= "<U>Importe:</U> ".$importe;
								$detelle_tooltip .= "<br>";
								$detelle_tooltip .= "<U>Obs.:</U> ".$observacion;
								?>
									<img src="../imagenes/detalle2.gif"  class='iconos' onmouseover="dlc(' <? echo $detelle_tooltip  ?> ', ' <? echo 'N&ordm; DEPOSITO : '.$codigo; ?> '); return true;" onmouseout="nd(); return true;"> 
								<?
							}
					echo"</td>";
					echo "<td $clase align='center'>";
							echo "<img  class='iconos' src='../imagenes/detalle.gif' border='0' title='Ver detalle' onClick='javascript: buscar_compra_dia_detalle_comprobante($n_fact,$suc)'>"; 
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
					echo"<td colspan=2 align='center'></td>";
				echo"</tr>";
	echo "</table>";   
		//---------------------cierra tabla--------------------------------------------------------------------------------------//
}
?>
