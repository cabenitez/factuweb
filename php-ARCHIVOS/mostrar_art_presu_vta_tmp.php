<?
	session_start();   									// Iniciar sesión
	$usuario_presu = $_SESSION['user_usuario']; 	// usuario conectado 
	$provincia = $_POST['provincia'];
	include("conexion.php"); 
	
	//-------------------------OBTIENE LOS IMPUESTOS-----------------------------------------------------------------------//
	//$consulta = "SELECT tasa FROM alicuota_iva inner join producto on producto"; // % DE IVA
	//$result = mysql_query($consulta);            
	//$registro = mysql_fetch_row($result);        
	//$tasa_iva = $registro[0];
	
	$consulta = "SELECT tasa FROM imp_interno"; // MONTO DE IMPUESTO INTERNO (MONTO FIJO)
	$result = mysql_query($consulta);            
	$registro = mysql_fetch_row($result);        
	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	if ($nfilas > 0){     						 		// si ya existe el articulo
		$monto_imp_int = $registro[0];
	}else{
		$monto_imp_int = 0;
	}		
	
	$consulta = "SELECT tasa FROM perc_iva"; // % DE PEROCEPCION DE IVA
	$result = mysql_query($consulta);            
	$registro = mysql_fetch_row($result);        
	$nfilas1 = mysql_num_rows ($result);          		//indica la cantidad de resultados
	if ($nfilas1 > 0){     						 		// si ya existe el articulo
		$tasa_perc_iva = $registro[0];
	}else{
		$tasa_perc_iva = 0;
	}
	
	// INGRSO BRUTO
	$tasa_img_bruto = 0;
	if(!empty($provincia)){ 									// verifico q se defina una provincia
		$consulta_p = "SELECT cod_prov FROM provincia where nombre = '$provincia' "; 	
		$result_p = mysql_query($consulta_p);            
		$registro_p = mysql_fetch_row($result_p);        
		$nfilas_p = mysql_num_rows ($result_p);          		// indica la cantidad de resultados
		if ($nfilas_p > 0){     						 		// si ya existe el articulo
			$cod_prov = $registro_p[0];
			
			$consulta = "SELECT tasa FROM ing_bruto where cod_prov = $cod_prov"; // % DE INGRESO BRUTO
			$result = mysql_query($consulta);            
			$registro = mysql_fetch_row($result);        
			$nfilas2 = mysql_num_rows ($result);          		//indica la cantidad de resultados
			if ($nfilas2 > 0){     						 		// si ya existe el articulo
				$tasa_img_bruto = $registro[0];
			}
		}
	}
	//echo $tasa_img_bruto;
	
	//---------------------Paginacion----------------------------------------------------------------------------------------//
	$pag_consulta = "SELECT * FROM presupuesto_vta_tmp where usuario = '$usuario_presu' ORDER BY linea";
	$estilo_pag_nav = "barra_nav";					//OPCIONAL Cadena. Contiene el nombre del estilo CSS para los enlaces de paginación.
	$estilo_pag_actual = "barra_nav_actual";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	$estilo_pag_info = "caja";						//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	$pag_tamano_extra = 100;
	include("paginador.php");						//OBLIGATORIO Incluimos el script de paginación. 
	//---------------------Fin Paginacion------------------------------------------------------------------------------------//
	
	if($pag_filas > 0){
		//echo $pag_info;  					//info de paginacion
		//---------------------abre la tabla--------------------------------------------------------------------------------------//
		echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
			echo "<tr class='top'>";
				echo "<td width='7%'><div align='center' class='seccion'>Codigo</div></td>";
				echo "<td width='43%'><div align='center' class='seccion'>Descripcion</div></td>";
				echo "<td width='7%'><div align='center' class='seccion'>Cantidad</div></td>";
				echo "<td width='1%'><div align='center' class='seccion'></div></td>";
				echo "<td width='7%'><div align='center' class='seccion'>Precio Unit.</div></td>";
				echo "<td width='7%'><div align='center' class='seccion'>% Bonif.</div></td>";
				echo "<td width='7%'><div align='center' class='seccion'>Importe</div></td>";
				echo "<td width='7%'><div align='center' class='seccion'>% IVA</div></td>";
				echo "<td width='7%'><div align='center' class='seccion'>Total</div></td>";
				echo "<td width='7%'><div align='center' class='seccion'>Eliminar</div></td>";
			echo "</tr>";
			$clase="class='filas'"; 							//defino la clase para las filas

			while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
					$codigo=$registro[1];		
					$descripcion=$registro[2];
					$cantidad=$registro[3];		
					$precio=$registro[4];
					$bonif=$registro[5];	
					$fila=$registro[7];
					$tasa_iva=$registro[8];
					
					$consulta = "SELECT stock_actual,envase, unidad_bulto,peso FROM producto where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $codigo"; // % DE IVA
					$result = mysql_query($consulta);            
					$registro = mysql_fetch_row($result);        
					
					$stock=$registro[0];
					$tiene_envase=$registro[1]; 
					$unidad_bulto=$registro[2];
					$peso=$registro[3];

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
							?>
								<div onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); title="Click para Modificar" id="<? echo 'div_'.$fila; ?>" onclick="editar_in_situ(this.id,<? echo 11..$fila; ?>)"> <? echo $cantidad ?> </div> 
								<input type='hidden' id='<? echo 11..$fila; ?>' name='<? echo $cantidad; ?>' onKeyPress='return solo_entero(event)' onBlur="actualizar_cant_art_presu_vta_blur(<? echo 11..$fila; ?>)" onKeyUp='actualizar_cant_art_presu_vta(event, <? echo 11..$fila; ?>)' size='5' maxlength='5' class='caja_fila'  value='<? echo $cantidad ?>'>     
							<?
						echo"</td>"; 
						echo"<td $clase align='center'>";  
								if ($stock < $cantidad){
									echo "<img src='../imagenes/advertencia.png' width='16' height='16' title='La cantidad pedida Suepera la existente, Stock: $stock'>";
									//echo"La cantidad pedida supera el Stock actual, en Stock $stock";
								}
						echo"</td>";
						echo"<td $clase align='right'>";	
								echo $precio.$espacio_izq;
						echo"</td>"; 
						echo "<td $clase align='center'>";
								// echo $bonif;
								
								?>
								<div onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); title="Click para Modificar" id="<? echo 'div_'.$fila.'_bonif'; ?>" onclick="editar_in_situ2(this.id,<? echo 99..$fila; ?>)"> <? echo $bonif ?> </div>
								<input type='hidden' id='<? echo 99..$fila; ?>' name='<? echo $bonif; ?>' onKeyPress='return solo_entero(event)' onBlur="actualizar_bonif_art_presu_vta_blur(<? echo 99..$fila; ?>)"  onKeyUp='actualizar_bonif_art_presu_vta(event, <? echo 99..$fila; ?>)' size='5' maxlength='5' class='caja_fila'  value='<? echo $bonif ?>'>     
								<?
						echo"</td>"; 
						echo"<td $clase align='right'>";	
								echo number_format($importe,2,'.','').$espacio_izq;
						echo"</td>"; 
						echo"<td $clase align='center'>";	
								echo $tasa_iva;
						echo"</td>"; 						
						echo"<td $clase align='right'>";	
								echo number_format($importe_con_iva,2,'.','').$espacio_izq;
						echo"</td>";						 
						echo"<td $clase align='center'>"; 
								?> <img  class='iconos' src='../imagenes/eliminar.png' border='0' title="Eliminar" onClick="javascript: eliminar_art_fac_vta_tmp(' <? echo $fila ?>')"> <? 
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
					
			} //end while

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
								echo"<td colspan='2'></td>";
								echo"<td align='right'>$total_importe$espacio_izq</td>";
								echo"<td ></td>";
								echo"<td align='right'>$total_con_iva$espacio_izq</td>";
								echo"<td ></td>";
								echo"<td></td>";
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
									if($total_envases == ""){
										$total_envases="-------";
									}
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
		echo "<table border = 0>";
			echo"<tr>";
					echo"<td align='left' colspan=2>";
						if($total_comprobante > 999){
								//echo " <div id='msg_mod'  class='nota'> &nbsp;&nbsp;<img src='../imagenes/advertencia.gif' width='16' height='16'> ADVERTENCIA: LA FACTURA SUPERA $999.00 &nbsp;&nbsp;</div>";
						}
					echo"</td>";
			echo"</tr>";
		echo "</table>";   

		//echo $pag_navegacion;
	}	
?>
