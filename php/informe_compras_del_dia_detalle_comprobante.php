<?
 $num_fac = $_POST['num_fac'];
 $suc = $_POST['suc'];
if($num_fac){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$consulta =" select * from factura_compra_detalle where n_factura = $num_fac and n_sucursal = $suc";
	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<br>";
	echo "<div  align='center' class='seccion'><b><u>DETALLE POR COMPROBANTE</u> $nombre</b></div>";
								
	echo "<input name='oculto_n_factura' id='oculto_n_factura' type='hidden' value=$num_fac />";
	echo "<input name='oculto_suc' id='oculto_suc' type='hidden' value=$suc />";

	echo "<div  align='right' class='seccion'>";
		echo "<img src='../imagenes/pdf.gif' width='18' height='18' border='0' class='iconos'  title='Exportar' onClick=\"javascript: exportar_listado_compra_del_dia_detalle_comprobante('exportar_informe_compras_del_dia_detalle_comprobante.php')\" /> pdf  &nbsp;&nbsp;<img src='../imagenes/imprimir.png' width='18' height='18' title='Imprimir' class='iconos' onClick=\"javascript: imprimir_listado_compra_del_dia_detalle_comprobante('exportar_informe_compras_del_dia_detalle_comprobante.php')\" /> imprimir";
	echo "</div>";


	echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";

		echo"<tr class='totales'>";			
			echo"<td colspan='2' align='left'>&nbsp;&nbsp;$suc  $num_fac</td>";
		echo"</tr>";

		echo "<tr class='top'>";
			echo "<td width='10%'><div align='center' class='seccion'>Codigo</div></td>";
			echo "<td width='50%'><div align='center' class='seccion'>Descripcion</div></td>";
			echo "<td width='10%'><div align='center' class='seccion'>Cantidad</div></td>";
			echo "<td width='10%'><div align='center' class='seccion'>Precio Unit.</div></td>";
			echo "<td width='10%'><div align='center' class='seccion'>% Bonif.</div></td>";
			echo "<td width='10%'><div align='center' class='seccion'>Importe</div></td>";
		echo "</tr>";

		$clase="class='filas'"; 							//defino la clase para las filas

		do{ 					// obtengo los resultados 
			$cod_prod=$registro[0];		
			$cod_variedad=$registro[1];
			$cod_marca=$registro[2];		
			$cod_grupo=$registro[3];
			$cod_proveedor=$registro[6];
			$precio=$registro[7];	
			$cantidad=$registro[8];
			$bonif=$registro[9];
			$importe=$registro[10];

			$cod_producto = $cod_grupo.$cod_marca.$cod_variedad.$cod_prod;
			$consulta2 = "SELECT descripcion FROM producto where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $cod_producto"; // consulta sql
			$result2 = mysql_query($consulta2);            // hace la consulta
			$registro2 = mysql_fetch_row($result2);        // toma el registro
			$desc_producto = $registro2[0];
			
			$precio = number_format($precio,2,'.',''); 				// es para dejar 2 lugares decimales
			$importe = number_format($importe,2,'.',''); 				// es para dejar 2 lugares decimales
			
			echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
				echo "<td $clase align='center'>";
						echo $cod_producto;     
				echo"</td>"; 
				echo"<td $clase align='left'>";	
						echo $desc_producto;
				echo"</td>"; 
				echo "<td $clase align='center'>";
					echo $cantidad;
				echo"</td>"; 
				echo"<td $clase align='center'>";	
						echo $precio;
				echo"</td>"; 
				echo "<td $clase align='center'>";
						 echo $bonif;
				echo"</td>"; 
				echo"<td $clase align='center'>";	
						echo $importe;
				echo"</td>"; 
			echo"</tr>";
			
			$cant_bulto = $cant_bulto + $cantidad;		 // total de bultos
			$total_importe = $total_importe + $importe; // es para dejar 2 lugares decimales
			$total_importe = number_format($total_importe,2,'.',''); // es para dejar 2 lugares decimales
					
			}while($registro = mysql_fetch_array($result)); 	// obtengo los resultados } //end while

			echo"<tr class='totales'>";			
				echo"<td colspan='2' align='left'>&nbsp;&nbsp;TOTALES </td>";
				echo"<td align='center'>$cant_bulto</td>";
				echo"<td colspan='2'></td>";
				echo"<td align='center'>$total_importe</td>";
			echo"</tr>";
			echo"<tr>";									// fila de separador
				echo"<td>&nbsp;</td>";
				echo"<td>&nbsp;</td>";
			echo"</tr>";
			
			$consulta2 = "SELECT * FROM factura_compra where n_factura = $num_fac and n_sucursal = $suc"; // consulta sql
			$result2 = mysql_query($consulta2);            // hace la consulta
			$registro2 = mysql_fetch_row($result2);        // toma el registro
			 	 	 	 	 	 	 	 	 	 	 	
			$subtotal = number_format($registro2[4],2,'.','');
			$imp_interno_alicuota = $registro2[5];
			$imp_interno_monto = number_format($registro2[6],2,'.',''); 
			$iva_alicuota = $registro2[7];
			$iva_monto = number_format($registro2[8],2,'.',''); 
			$perc_iva_alicuota = $registro2[9];
			$perc_iva_monto = number_format($registro2[10],2,'.','');
			$pib_alicuota = $registro2[11];
			$pib_monto = number_format($registro2[12],2,'.','');
			$otros_alicuota = $registro2[13];
			$otros_monto = number_format($registro2[14],2,'.',''); 
			$total = number_format($registro2[15],2,'.',''); 
			
			//**************************************** TABLA DE TOTALES ***************************************************//
			echo "<table width='25%' align='right' border='0' cellspacing='1' cellpadding='0' bordercolor='#CCCCCC' bgcolor='#FBFBFB'>";
				echo"<tr>";
					echo"<td width='30%' align='left'>&nbsp;&nbsp;SUBTOTAL:</td>";
					echo"<td width='15%' align='right'>$subtotal <input type='hidden'  id='subtotal'  name='subtotal' value='$subtotal'> </td>";
				echo"</tr>";

				echo"<tr>";
					echo"<td width='30%' align='left'>&nbsp;&nbsp;IVA:</td>";
					echo"<td width='15%' align='right'>$iva_monto <input type='hidden'  id='tasa_iva'  name='tasa_iva' value='$iva_monto'> </td>";
				echo"</tr>";
				
				echo"<tr>";
					echo"<td align='left'>&nbsp;&nbsp;PERC. IVA:</td>";
					echo"<td align='right'>$perc_iva_monto <input type='hidden'  id='perc_iva_monto'  name='perc_iva_monto' value='$perc_iva_monto'> </td>";
				echo"</tr>";
				
				echo"<tr>";
					echo"<td align='left'>&nbsp;&nbsp;PERC. ING. BRUTOS:</td>";
					echo"<td align='right'>$pib_monto <input type='hidden'  id='pib_monto'  name='pib_monto' value='$pib_monto'> </td>";
					
				echo"</tr>";
				
				echo"<tr>";
					echo"<td align='left'>&nbsp;&nbsp;IMP. INTERNO</td>";
					echo"<td align='right'>$imp_interno_monto <input type='hidden'  id='imp_interno_monto'  name='imp_interno_monto' value='$imp_interno_monto'> </td>";
				echo"</tr>";

				echo"<tr>";
					echo"<td align='left'>&nbsp;&nbsp;<b>TOTAL COMPROBANTE:</b></td>";
					echo"<td align='right'><b>$total </b><input type='hidden'  id='total'  name='total' value='$total'> </td>";
				echo"</tr>";
		echo "</table>";
		echo "</table>";   
		//---------------------cierra tabla--------------------------------------------------------------------------------------//
}
?>