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
						factura_vta_no_cliente_detalle.iva, imp_interno, perc_iva, ing_bruto,
						concat(cod_grupo,cod_marca,cod_variedad,cod_prod) AS codigo, cantidad, precio, bonificacion, 
						round((cantidad * precio)- ((cantidad * precio * bonificacion)/100),2) AS importe_bonif,
						round(((cantidad * precio)- ((cantidad * precio * bonificacion)/100)) + ((((cantidad * precio)- ((cantidad * precio * bonificacion)/100)) * factura_vta_no_cliente_detalle.iva)/100) ,2) as importe_fila
												
						from factura_vta_no_cliente INNER JOIN factura_vta_no_cliente_detalle  
						ON factura_vta_no_cliente_detalle.n_factura = factura_vta_no_cliente.n_factura AND factura_vta_no_cliente_detalle.cod_talonario = factura_vta_no_cliente.cod_talonario AND factura_vta_no_cliente_detalle.num_talonario = factura_vta_no_cliente.num_talonario 
						
						WHERE factura_vta_no_cliente.cod_talonario = '$cod_tal'
						AND  factura_vta_no_cliente.num_talonario = $num_tal
						AND  factura_vta_no_cliente.n_factura = $num_fac
					UNION
						SELECT 
						factura_vta_detalle.iva, imp_interno, perc_iva, ing_bruto,	
						concat(cod_grupo,cod_marca,cod_variedad,cod_prod)AS codigo, cantidad, precio, bonificacion, 
						round((cantidad * precio)- ((cantidad * precio * bonificacion)/100),2) AS importe_bonif,
						round(((cantidad * precio)- ((cantidad * precio * bonificacion)/100))+ ((((cantidad * precio)- ((cantidad * precio * bonificacion)/100)) * factura_vta_detalle.iva)/100) ,2) as importe_fila
						
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
								
	echo "<input name='oculto_cod_talonario' id='oculto_cod_talonario' type='hidden' value='$cod_tal' />";
	echo "<input name='oculto_n_talonario' id='oculto_n_talonario' type='hidden' value=$num_tal />";
	echo "<input name='oculto_n_factura' id='oculto_n_factura' type='hidden' value=$num_fac />";
	echo "<input name='oculto_desc_fac' id='oculto_desc_fac' type='hidden' value='$desc_fac' />";
	echo "<input name='oculto_suc' id='oculto_suc' type='hidden' value=$suc />";

	echo "<div  align='right' class='seccion'>";
		echo "<img src='../imagenes/pdf.gif' width='18' height='18' border='0' class='iconos'  title='Exportar' onClick=\"javascript: exportar_detalle_comprobante_detalle('exportar_detalle_comprobante_detalle.php')\" /> pdf  &nbsp;&nbsp;<img src='../imagenes/imprimir.png' width='18' height='18' title='Imprimir' class='iconos' onClick=\"javascript: imprimir_detalle_comprobante_detalle('exportar_detalle_comprobante_detalle.php')\" /> imprimir";
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
			echo "<td width='7%'><div align='center' class='seccion'>Codigo</div></td>";
			echo "<td width='43%'><div align='center' class='seccion'>Descripcion</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>Cantidad</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>Precio Unit.</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>% Bonif.</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>Importe</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>% IVA</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>Total</div></td>";
		echo "</tr>";

		$clase="class='filas'"; 							//defino la clase para las filas

		do{ 					// obtengo los resultados 
					$tasa_iva=$registro[0];		
					$monto_imp_int=$registro[1];
					$tasa_perc_iva=$registro[2];		
					$tasa_img_bruto=$registro[3];
					
					$codigo=$registro[4];		
					$cantidad=$registro[5];		
					$precio=$registro[6];
					$bonif=$registro[7];	
					$imp_bonif=$registro[8];
					$importe=$registro[9];

					
					$consulta2 = "SELECT stock_actual,envase, unidad_bulto,peso,descripcion FROM producto where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $codigo"; // % DE IVA
					$result2 = mysql_query($consulta2);            
					$registro2 = mysql_fetch_row($result2);        
					
					$stock=$registro2[0];
					$tiene_envase=$registro2[1]; 
					$unidad_bulto=$registro2[2];
					$peso=$registro2[3];
					$descripcion=$registro2[4];
					
					
					if($tiene_envase == "SI"){
						$total_envases= $total_envases + ($cantidad * $unidad_bulto);
					}
					
					//prepara la variable para utilizar
					$precio=number_format($precio,2,'.','');
					
					$importe_neto=$cantidad * $precio;
					
					
					if($bonif == 100){
						$importe = 0;
					}else{
						$importe=$cantidad * $precio;
						$importe_bonif=(($cantidad * $precio)*$bonif)/100;
						$importe=$importe-$importe_bonif;
					}
					
					$importe = number_format($importe,2,'.',''); 				// es para dejar 2 lugares decimales
					
					$importe_con_iva = $importe+($importe * $tasa_iva)/100;
					$importe_con_iva=number_format($importe_con_iva,2,'.','');  // es para dejar 2 lugares decimales

					echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
						echo "<td $clase align='center'>";
								echo $codigo;     
						echo"</td>"; 
						echo"<td $clase align='left'>";	
								echo $descripcion;
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
								echo number_format($importe,2,'.','');
						echo"</td>"; 
						echo"<td $clase align='center'>";	
								echo $tasa_iva;
						echo"</td>"; 						
						echo"<td $clase align='center'>";	
								echo number_format($importe_con_iva,2,'.','');
						echo"</td>";						 
					echo"</tr>";
					
					//$consulta = "SELECT peso FROM producto where concat(cod_grupo, cod_marca, cod_variedad, cod_prod)= $codigo"; // consulta sql
					//$result = mysql_query($consulta);            // hace la consulta
					//$registro = mysql_fetch_row($result);        // toma el registro
					//$peso = $registro[0];
					$total_peso=$total_peso+($peso*$cantidad); 	 // peso total

					$total_precio=$total_precio+($precio*$cantidad); //precio total de cada erticulo sin bonificacion
					
					//////////////////**************** V2 ******************///////////////////////////////
					$cant_bulto = $cant_bulto + $cantidad;		 // total de bultos
					
					$total_importe_neto = $total_importe_neto + $importe_neto; // es para dejar 2 lugares decimales
					$total_importe_neto = number_format($total_importe_neto,2,'.',''); // es para dejar 2 lugares decimales
					
					$total_importe = $total_importe + $importe; // es para dejar 2 lugares decimales
					$total_importe = number_format($total_importe,2,'.',''); // es para dejar 2 lugares decimales

					$total_bonif = abs($total_precio-$total_importe);
					$total_bonif=number_format($total_bonif,2,'.',''); // es para dejar 2 lugares decimales

					$total_con_iva = $total_con_iva + $importe_con_iva;
					$total_con_iva=number_format($total_con_iva,2,'.',''); // es para dejar 2 lugares decimales

					$total_tasa_iva = $total_tasa_iva +($importe_con_iva - $importe);
					$total_tasa_iva=number_format($total_tasa_iva,2,'.',''); // es para dejar 2 lugares decimales

					
					//////////////////**************** V2 ******************///////////////////////////////
					
			}while($registro = mysql_fetch_array($result)); 	// obtengo los resultados } //end while

						//------------CREA LA FILA DE TOTALES-------------------//
						$total_monto_imp_int =number_format($monto_imp_int,2,'.','');
							
						$total_tasa_perc_iva = ($total_importe*$tasa_perc_iva)/100;
						$total_tasa_perc_iva=number_format($total_tasa_perc_iva,2,'.',''); // es para dejar 2 lugares decimales
						/*
						if(!empty($talonario)){ 									
							if($talonario != "A"){
								$total_importe = $total_con_iva;   				
							}
						}
						*/
						$total_tasa_img_bruto = ($total_importe*$tasa_img_bruto)/100;
						$total_tasa_img_bruto=number_format($total_tasa_img_bruto,2,'.',''); // es para dejar 2 lugares decimales


							echo"<tr class='totales'>";			
								echo"<td colspan='2' align='left'>&nbsp;&nbsp;TOTALES </td>";
								echo"<td align='center'>$cant_bulto</td>";
								echo"<td ></td>";
								echo"<td colspan='1'></td>";
								echo"<td align='center'>$total_importe</td>";
								echo"<td ></td>";
								echo"<td align='center'>$total_con_iva</td>";
								//echo"<td ></td>";
								//echo"<td></td>";
							echo"</tr>";
							echo"<tr>";									// fila de separador
								echo"<td>&nbsp;</td>";
								echo"<td>&nbsp;</td>";
							echo"</tr>";
	
						//**************************************** TABLA DE TOTALES ***************************************************//
							echo "<table width='50%' align='right' border='0' cellspacing='1' cellpadding='0' bordercolor='#CCCCCC' bgcolor='#FBFBFB'>";

								echo"<tr>";
									echo"<td width='30%' align='left'>&nbsp;&nbsp;TOTAL DE PAQUETES:</td>";
									echo"<td width='15%' align='right'>$cant_bulto <input type='hidden'  id='cant_bulto'  name='cant_bulto' value='$cant_bulto'> </td>";
   									echo"<td width='10%'>&nbsp;</td>";
									echo"<td width='30%' align='left'>&nbsp;&nbsp;<b>SUBTOTAL NETO:</b></td>";
									echo"<td width='15%' align='right'><b>$total_importe_neto</b><input type='hidden'  id='total_importe_neto'  name='total_importe_neto' value='$total_importe_neto'> </td>";
								echo"</tr>";

								echo"<tr>";
									echo"<td align='left'>&nbsp;&nbsp;TOTAL DE KILOS:</td>";
									echo"<td align='right'>$total_peso <input type='hidden'  id='total_peso'  name='total_peso' value='$total_peso'> </td>";
									echo"<td>&nbsp;</td>";
									echo"<td align='left'>&nbsp;&nbsp;BONIFICACION:</td>";
									echo"<td align='right'>$total_bonif <input type='hidden'  id='total_bonif'  name='total_bonif' value='$total_bonif'> </td>";
								echo"</tr>";


								echo"<tr>";
									if($total_envases == ""){
										$total_envases="----";
									}

									echo"<td align='left'>&nbsp;&nbsp;TOTAL DE ENVASES:</td>";
									echo"<td align='right'>$total_envases <input type='hidden'  id='total_envases'  name='total_envases' value='$total_envases'> </td>";
   									echo"<td width='10%'>&nbsp;</td>";
									echo"<td align='left'>&nbsp;&nbsp;<b>SUBTOTAL:</b></td>";
									echo"<td align='right'><b>$total_importe</b> <input type='hidden'  id='sub_total'  name='sub_total' value='$total_importe'> </td>";
								echo"</tr>";

								echo"<tr>";
									echo"<td>&nbsp;</td>";
									echo"<td>&nbsp;</td>";
									echo"<td>&nbsp;</td>";
									echo"<td width='30%' align='left'>&nbsp;&nbsp;IVA:</td>";
									echo"<td width='15%' align='right'>$total_tasa_iva <input type='hidden'  id='tasa_iva'  name='tasa_iva' value='$tasa_iva'> </td>";
								echo"</tr>";
								
								echo"<tr>";
									echo"<td>&nbsp;</td>";
									echo"<td>&nbsp;</td>";
									echo"<td>&nbsp;</td>";
									echo"<td align='left'>&nbsp;&nbsp;PERC. IVA:</td>";
									echo"<td align='right'>$total_tasa_perc_iva <input type='hidden'  id='tasa_perc_iva'  name='tasa_perc_iva' value='$tasa_perc_iva'> </td>";
								echo"</tr>";
								
								echo"<tr>";
									echo"<td>&nbsp;</td>";
									echo"<td>&nbsp;</td>";
									echo"<td>&nbsp;</td>";
									echo"<td align='left'>&nbsp;&nbsp;PERC. ING. BRUTOS:</td>";
									echo"<td align='right'>$total_tasa_img_bruto <input type='hidden'  id='tasa_img_bruto'  name='tasa_img_bruto' value='$tasa_img_bruto'> </td>";
									
								echo"</tr>";
								
								echo"<tr>";
									echo"<td>&nbsp;</td>";
									echo"<td>&nbsp;</td>";
									echo"<td>&nbsp;</td>";
									echo"<td align='left'>&nbsp;&nbsp;IMP. INTERNO</td>";
									echo"<td align='right'>$total_monto_imp_int <input type='hidden'  id='monto_imp_int'  name='monto_imp_int' value='$monto_imp_int'> </td>";
									
									//echo"<td align='left'>&nbsp;&nbsp;<b>SUBTOTAL:</b></td>";
									//echo"<td align='right'><b>$total_importe</b> <input type='hidden'  id='sub_total'  name='sub_total' value='$total_precio'> </td>";
								echo"</tr>";

								//----------------- calcula los totales --------------//
								$impuetos = $total_tasa_perc_iva + $total_tasa_img_bruto + $total_monto_imp_int;
								
								
								/*
								//==============VERIFICO QUE SEA 'A' PARA SUMARLE EL IVA===============//
								if(!empty($talonario)){ 									
									if($talonario == "A"){
										$impuetos = $impuetos + $total_tasa_iva ;
									}
								}else{
									$impuetos = $impuetos + $total_tasa_iva ;
								}
								*/
								
								$total_comprobante = $total_importe + $impuetos + $total_tasa_iva;
								$total_comprobante = number_format($total_comprobante,2,'.',''); 
								echo"<tr>";
									echo"<td align='left'></td>";
									echo"<td align='right'></td>";
									echo"<td>&nbsp;</td>";
									echo"<td align='left'>&nbsp;&nbsp;<b>TOTAL COMPROBANTE:</b></td>";
									echo"<td align='right'><b>$total_comprobante </b><input type='hidden'  id='total_importe'  name='total_importe' value='$total_comprobante'> </td>";
								echo"</tr>";
						echo "</table>";
		echo "</table>";   
		//---------------------cierra tabla--------------------------------------------------------------------------------------//
		/*
		echo "<table border = 0>";
			echo"<tr>";
					echo"<td align='left' colspan=2>";
						if($total_comprobante > 999){
								echo " <div id='msg_mod'  class='nota'> &nbsp;&nbsp;<img src='../imagenes/advertencia.gif' width='16' height='16'> ADVERTENCIA: LA FACTURA SUPERA $999.00 &nbsp;&nbsp;</div>";
						}
					echo"</td>";
			echo"</tr>";
		echo "</table>";   
		*/
}
?>