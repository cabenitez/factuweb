<?
 $cod_tal = $_POST['cod_tal'];
 $num_tal = $_POST['num_tal'];
 $num_fac = $_POST['num_fac'];
 $desc_fac = $_POST['desc_fac'];
 $suc = $_POST['suc'];
if($cod_tal){
	//---------------------- INCLUYE CONEXION A BD -----------------------------------------------//
	include("conexion.php");
	
	// Obtiene el detalle de todos los comprobantes Factura Vta Cliente
	$consulta ="SELECT * FROM
						(
						SELECT 
						iva, imp_interno, perc_iva, ing_bruto,
						concat(cod_grupo,cod_marca,cod_variedad,cod_prod) AS codigo, cantidad, precio, bonificacion, 
						round((cantidad * precio)- ((cantidad * precio * bonificacion)/100),2) AS importe_bonif,
						round(((cantidad * precio)- ((cantidad * precio * bonificacion)/100)) + ((((cantidad * precio)- ((cantidad * precio * bonificacion)/100)) * iva)/100) ,2) as importe_fila
												
						from factura_vta_no_cliente INNER JOIN factura_vta_no_cliente_detalle  
						ON factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario 
						
						WHERE factura_vta_no_cliente.cod_talonario = '$cod_tal'
						AND  factura_vta_no_cliente.num_talonario = $num_tal
						AND  factura_vta_no_cliente.n_factura = $num_fac
					UNION
						SELECT 
						iva, imp_interno, perc_iva, ing_bruto,	
						concat(cod_grupo,cod_marca,cod_variedad,cod_prod)AS codigo, cantidad, precio, bonificacion, 
						round((cantidad * precio)- ((cantidad * precio * bonificacion)/100),2) AS importe_bonif,
						round(((cantidad * precio)- ((cantidad * precio * bonificacion)/100))+ ((((cantidad * precio)- ((cantidad * precio * bonificacion)/100)) * iva)/100) ,2) as importe_fila
						
						FROM factura_vta INNER JOIN factura_vta_detalle 
						ON factura_vta_detalle.n_factura = factura_vta.n_factura AND factura_vta_detalle.cod_talonario = factura_vta.cod_talonario AND factura_vta_detalle.num_talonario = factura_vta.num_talonario 
						
						WHERE factura_vta.cod_talonario = '$cod_tal'
						AND factura_vta.num_talonario = $num_tal
						AND factura_vta.n_factura = $num_fac
				) AS detalle_factura ";
	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<br>";
	echo "<div  align='center' class='seccion'><b><u>DETALLE POR COMPROBANTE</u> $nombre</b></div>";
								
	echo "<input name='oculto_cod_talonario' id='oculto_cod_talonario' type='hidden' value='$cod_tal' ";
	echo "<input name='oculto_n_talonario' id='oculto_n_talonario' type='hidden' value=$num_tal ";
	echo "<input name='oculto_n_factura' id='oculto_n_factura' type='hidden' value=$num_fac ";
	echo "<input name='oculto_desc_fac' id='oculto_desc_fac' type='hidden' value='$desc_fac' ";
	echo "<input name='oculto_suc' id='oculto_suc' type='hidden' value=$suc ";

	echo "<div  align='right' class='seccion'>";
		echo "<img src='../imagenes/pdf.gif' width='18' height='18' border='0' class='iconos'  title='Exportar' onClick=\"javascript: exportar_factura_vta_detalle_comprobante('exportar_factura_vta_detalle_comprobante.php')\" /> pdf  &nbsp;&nbsp;<img src='../imagenes/imprimir.png' width='18' height='18' title='Imprimir' class='iconos' onClick=\"javascript: imprimir_factura_vta_detalle_comprobante('exportar_factura_vta_detalle_comprobante.php')\" /> imprimir";
	echo "</div>";


	echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
				//-------------------------//
				$len_n_talonario=strlen($num_tal); 					// completo el numero de la sucursal con ceros
				$ceros_3 = '';
				while ($len_n_talonario < 4){
						$ceros_3.="0";
						$len_n_talonario++;
				}
				$num_tal=$ceros_3.$num_tal;
				//-------------------------//
				$len_num_sucursal=strlen($suc); 					// completo el numero de la sucursal con ceros
				$ceros_2 = '';
				while ($len_num_sucursal < 4){
						$ceros_2.="0";
						$len_num_sucursal++;
				}
				$suc=$ceros_2.$suc;
				//-------------------------//
				$len_num_factura=strlen($num_fac); 						// completo el numero de factura con ceros
				$ceros= '';
				while ($len_num_factura < 8){								// completo el numero de la factura con ceros
						$ceros.="0";
						$len_num_factura++;
				}
				$num_fac=$ceros.$num_fac;

		echo"<tr class='totales'>";			
			echo"<td colspan='2' align='left'>&nbsp;&nbsp;$num_tal - $desc_fac $suc  $num_fac</td>";
		echo"</tr>";

		echo "<tr class='top'>";
			echo "<td width='5%'><div align='center' class='seccion'>CODIGO</div></td>";
			echo "<td width='30%'><div align='center' class='seccion'>DESCRIPCION</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>CANTIDAD</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>PRECIO UNIT.</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>% BONIF.</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>IMPORTE</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>TOTAL</div></td>";
		echo "</tr>";

		$clase="class='filas'"; 							//defino la clase para las filas

		$iva=$registro[0];		
		$imp_int=$registro[1];
		$perc_iva=$registro[2];		
		$ing_bruto=$registro[3];
		do{ 					// obtengo los resultados 
					$codigo=$registro[4];		
					
					$consulta2 = "SELECT descripcion, peso, envase, unidad_bulto FROM producto where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $codigo"; // % DE IVA
					$result2 = mysql_query($consulta2);            
					$registro2 = mysql_fetch_row($result2);        
					$descripcion=$registro2[0];
					$peso=$registro2[1];
					$envase=$registro2[2];
					$unidad_bulto=$registro2[3];
					
					$cantidad=$registro[5];		
					$precio=$registro[6];
					$bonif=$registro[7];	
					$imp_bonif=$registro[8];
					$importe=$registro[9];
				
				
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='left'>";
							echo $espacio_izq.$codigo;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$descripcion;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $cantidad.$espacio_izq;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo number_format($precio,2,'.','').$espacio_izq;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $bonif.$espacio_izq;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo number_format($imp_bonif,2,'.','').$espacio_izq; 
					echo"</td>";
					echo "<td $clase align='right'>";
							echo number_format($importe,2,'.','').$espacio_izq; 
					echo"</td>";

					$total_cantidad= $total_cantidad + $cantidad;
					$total_precio = $total_precio + $precio;
					$total_importe= $total_importe + $imp_bonif;
					$total_fila = $total_fila + $importe;
					$total_peso= $total_peso+($peso * $cantidad);
					
					$total_imp_bonif = $total_imp_bonif + $imp_bonif ;
											
					$total_bonif_fila =  ($total_importe*$bonif)/100;
					$total_bonif=$total_bonif + $total_bonif_fila; // es para dejar 2 lugares decimales

					if($envase == "SI"){
						$total_envases= $total_envases+($cantidad * $unidad_bulto);
					}

				echo"</tr>";
				
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 		
		
				echo"<tr bgcolor='#E0E0E0' >";			
					echo"<td colspan='2' align='left'>&nbsp;&nbsp;TOTALES	</td>";
					
					$total_precio= number_format($total_precio,2,'.','');
					$total_importe = number_format($total_importe,2,'.','');
					$total_fila= number_format($total_fila,2,'.','');
					
					echo"<td align='right'>$total_cantidad$espacio_izq</td>";
					echo"<td align='right'>$total_precio$espacio_izq</td>";
					echo"<td align='right'></td>";
					echo"<td align='right'>$total_importe$espacio_izq</td>";
					echo"<td align='right'>$total_fila$espacio_izq</td>";
					echo"<td align='right'></td>";
				echo"</tr>";
	echo "</table>";   
	//---------------------cierra tabla--------------------------------------------------------------------------------------//
	//------------CREA LA FILA DE TOTALES-------------------//
	$total_bonif=number_format($total_bonif,2,'.',''); // es para dejar 2 lugares decimales
	
	$total_tasa_iva = ($total_importe*$iva)/100;
	$total_tasa_iva=number_format($total_tasa_iva,2,'.',''); // es para dejar 2 lugares decimales
	
	$total_monto_imp_int = number_format($imp_int,2,'.','');
	
	$total_tasa_perc_iva = ($total_importe*$perc_iva)/100;
	$total_tasa_perc_iva=number_format($total_tasa_perc_iva,2,'.',''); // es para dejar 2 lugares decimales
	
	$total_tasa_img_bruto = ($total_importe*$ing_bruto)/100;
	$total_tasa_img_bruto=number_format($total_tasa_img_bruto,2,'.',''); // es para dejar 2 lugares decimales
	
	//**************************************** TABLA DE TOTALES ***************************************************//
	echo "<br>";
	echo "<table width='50%' align='right' border='0' cellspacing='1' cellpadding='0' bordercolor='#CCCCCC' bgcolor='#FBFBFB'>";
			echo"<tr>";
					echo"<td width='30%' align='left'>&nbsp;&nbsp;IVA:</td>";
					echo"<td width='15%' align='right'>$total_tasa_iva</td>";
					echo"<td width='10%'>&nbsp;</td>";
					echo"<td width='30%' align='left'>&nbsp;&nbsp;TOTAL DE BULTOS:</td>";
					echo"<td width='15%' align='right'>$total_cantidad </td>";
			echo"</tr>";
								
			echo"<tr>";
					echo"<td align='left'>&nbsp;&nbsp;PERC. IVA:</td>";
					echo"<td align='right'>$total_tasa_perc_iva</td>";
					echo"<td>&nbsp;</td>";
					echo"<td align='left'>&nbsp;&nbsp;TOTAL DE KILOS:</td>";
					echo"<td align='right'>$total_peso</td>";
			echo"</tr>";
								
			echo"<tr>";
					echo"<td align='left'>&nbsp;&nbsp;PERC. ING. BRUTOS:</td>";
					echo"<td align='right'>$total_tasa_img_bruto </td>";
					echo"<td>&nbsp;</td>";									
									
					if($total_envases == ""){
							$total_envases="-------";
					}
					echo"<td align='left'>&nbsp;&nbsp;TOTAL DE ENVASES:</td>";
					echo"<td align='right'>$total_envases</td>";
			echo"</tr>";
								
			echo"<tr>";
					echo"<td align='left'>&nbsp;&nbsp;IMP. INTERNO</td>";
					echo"<td align='right'>$total_monto_imp_int</td>";
					echo"<td>&nbsp;</td>";
					echo"<td align='left'>&nbsp;&nbsp;<b>SUBTOTAL:</b></td>";
					echo"<td align='right'><b>$total_importe</b></td>";
			echo"</tr>";

			echo"<tr>";
					echo"<td align='left'></td>";
					echo"<td align='right'></td>";
					echo"<td>&nbsp;</td>";
					echo"<td align='left'>&nbsp;&nbsp;BONIFICACION:</td>";
					echo"<td align='right'>$total_bonif</td>";
			echo"</tr>";
							
			echo"<tr>";
					echo"<td align='left'></td>";
					echo"<td align='right'></td>";
					echo"<td>&nbsp;</td>";
					echo"<td align='left'>&nbsp;&nbsp;<b>TOTAL COMPROBANTE:</b></td>";
					echo"<td align='right'><b>$total_fila</b> </td>";
			echo"</tr>";
	echo "</table>";
}
?>