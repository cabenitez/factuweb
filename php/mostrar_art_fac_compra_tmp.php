<?
	session_start();   									// Iniciar sesión
	$usuario_fac = $_SESSION['user_usuario']; 	// usuario conectado 
	
	include("conexion.php"); 
	//---------------------Paginacion----------------------------------------------------------------------------------------//
	$pag_consulta = "SELECT * FROM factura_compra_tmp where usuario = '$usuario_fac' ORDER BY linea";
	$estilo_pag_nav = "barra_nav";					//OPCIONAL Cadena. Contiene el nombre del estilo CSS para los enlaces de paginación.
	$estilo_pag_actual = "barra_nav_actual";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	$estilo_pag_info = "caja";						//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	$pag_tamano_extra = 100;
	include("paginador.php");						//OBLIGATORIO Incluimos el script de paginación. 
	//---------------------Fin Paginacion------------------------------------------------------------------------------------//
	if($pag_filas > 0){
			//---------------------abre la tabla--------------------------------------------------------------------------------------//
				echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
					echo "<tr class='top'>";
						echo "<td width='7%'><div align='center' class='seccion'>Codigo</div></td>";
						echo "<td width='50%'><div align='center' class='seccion'>Descripcion</div></td>";
						echo "<td width='7%'><div align='center' class='seccion'>Precio</div></td>";
						echo "<td width='7%'><div align='center' class='seccion'>Cantidad</div></td>";
						echo "<td width='7%'><div align='center' class='seccion'>% Bonif.</div></td>";
						echo "<td width='7%'><div align='center' class='seccion'>Importe</div></td>";
						echo "<td width='7%'><div align='center' class='seccion'>Eliminar</div></td>";
					echo "</tr>";
					$clase="class='filas'"; 							//defino la clase para las filas
		
					while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
							$codigo=$registro[1];		
							$descripcion=$registro[2];
							$cantidad=$registro[3];		
							$precio=$registro[4];
							$bonif=$registro[5];
							$importe=$registro[6];	
							$fila=$registro[7];
		
		
							echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
								echo "<td $clase align='center'>";
										echo $codigo;     
								echo"</td>"; 
								echo"<td $clase align='left'>";	
										echo $descripcion;
								echo"</td>"; 
								echo "<td $clase align='center'>";
									?>
										<div onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); title="Click para Modificar" id="<? echo 'div_'.$fila.'_precio'; ?>" onclick="editar_in_situ(this.id,<? echo $fila; ?>)"> <? echo $precio ?> </div>
										<input type='hidden' id='<? echo $fila; ?>' name='<? echo $precio; ?>' onKeyPress='return solo_entero(event)' onBlur="actualizar_precio_art_fact_compra_blur(<? echo $fila; ?>)" onKeyUp='actualizar_precio_art_fact_compra(event, <? echo $fila; ?>)' size='5' maxlength='5' class='caja_fila'  value='<? echo $precio ?>'>     
									<?
								echo"</td>"; 
								echo"<td $clase align='center'>"; 
									?>
										<div onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); title="Click para Modificar" id="<? echo 'div_'.$fila; ?>" onclick="editar_in_situ(this.id,<? echo 77..$fila; ?>)"> <? echo $cantidad ?> </div>
										<input type='hidden' id='<? echo 77..$fila; ?>' name='<? echo $cantidad; ?>' onKeyPress='return solo_entero(event)' onBlur="actualizar_cant_art_fact_compra_blur(<? echo 77..$fila; ?>)" onKeyUp='actualizar_cant_art_fact_compra(event, <? echo 77..$fila; ?>)' size='5' maxlength='5' class='caja_fila'  value='<? echo $cantidad ?>'>     
									<?
								echo"</td>";
								echo"<td $clase align='center'>";	
									?>
										<div onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); title="Click para Modificar" id="<? echo 'div_'.$fila.'_bonif'; ?>" onclick="editar_in_situ(this.id,<? echo 88..$fila; ?>)"> <? echo $bonif ?> </div>
										<input type='hidden' id='<? echo 88..$fila; ?>' name='<? echo $bonif; ?>' onKeyPress= 'return solo_entero(event)' onBlur="actualizar_bonif_art_fact_compra_blur(<? echo 88..$fila; ?>)" onKeyUp='actualizar_bonif_art_fact_compra(event, <? echo 88..$fila; ?>)' size='5' maxlength='5' class='caja_fila'  value='<? echo $bonif ?>'>     
									<?
		
								echo"</td>"; 
								echo "<td $clase align='center'>";								
										?>
										<div onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); title="Click para Modificar" id="<? echo 'div_'.$fila.'_importe'; ?>" onclick="editar_in_situ(this.id,<? echo 99..$fila; ?>)"> <? echo $importe ?> </div>
										<input type='hidden' id='<? echo 99..$fila; ?>' name='<? echo $importe; ?>' onKeyPress='return solo_entero(event)' onBlur="actualizar_importe_art_fact_compra_blur(<? echo 99..$fila; ?>)"  onKeyUp='actualizar_importe_art_fact_compra(event, <? echo 99..$fila; ?>)' size='5' maxlength='5' class='caja_fila'  value='<? echo $importe ?>'>     
										<?
								echo"</td>"; 
								echo"<td $clase align='center'>"; 
										?> <img  class='iconos' src='../imagenes/eliminar.png' border='0' title="Eliminar" onClick="javascript: eliminar_art_fac_compra_tmp(' <? echo $fila ?>')"> <? 
								echo"</td>"; 		
							echo"</tr>";
							$total_precio=$total_precio+($precio*$cantidad); //precio total de cada erticulo sin bonificacion
							$consulta = "SELECT peso FROM producto where concat(cod_grupo, cod_marca, cod_variedad, cod_prod)= $codigo"; // consulta sql
							$result = mysql_query($consulta);            // hace la consulta
							$registro = mysql_fetch_row($result);        // toma el registro
							$peso = $registro[0];
							$total_peso=$total_peso+($peso*$cantidad); 	 // peso total
							
					} //end while
				
				echo "</table>";   
				//---------------------cierra tabla--------------------------------------------------------------------------------------//
				echo $pag_navegacion;
				echo "<br>";
				echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
						  echo "<tr class='top'>";
							echo "<td width='5%'>&nbsp;</td>";
							echo "<td width='13.5%'><div align='center' class='seccion'>SUBTOTAL</div></td>";
							echo "<td width='13.5%'><div align='center' class='seccion'>IMP. INTERNO </div></td>";
							echo "<td width='13.5%'><div align='center' class='seccion'>I.V.A.</div></td>";
							echo "<td width='13.5%'><div align='center' class='seccion'>IVA PERCEPSION </div></td>";
							echo "<td width='13.5%'><div align='center' class='seccion'>P.I.B.</div></td>";
							echo "<td width='13.5%'><div align='center' class='seccion'>OTROS</div></td>";
							echo "<td width='13.5%'><div align='center' class='seccion'>TOTAL</div></td>";
						  echo "</tr>";
						 
						  echo "<tr bgcolor='#eeeeee' >";
							echo "<td> Alicuota:</td>";
							echo "<td>&nbsp;</td>";
							echo "<td><div align='center'>";
							  echo "<input  name='imp_int_ali'type='text' class='caja'  id='imp_int_ali' onKeyPress='return solo_entero(event)' onKeyUp='pasar_foco_fac_compra_14(event)' size='7' maxlength='7'>";
							echo "</div></td>";
							echo "<td><div align='center'>";
							  echo "<input  name='iva_ali'type='text' class='caja'  id='iva_ali' onKeyPress='return solo_entero(event)' onKeyUp='pasar_foco_fac_compra_16(event)' size='7' maxlength='7'>";
							echo "</div></td>";
							echo "<td><div align='center'>";
							  echo "<input  name='perc_iva_ali'type='text' class='caja'  id='perc_iva_ali' onKeyPress='return solo_entero(event)' onKeyUp='pasar_foco_fac_compra_18(event)' size='7' maxlength='7'>";
							echo "</div></td>";
							echo "<td><div align='center'>";
							  echo "<input  name='pib_ali'type='text' class='caja'  id='pib_ali' onKeyPress='return solo_entero(event)' onKeyUp='pasar_foco_fac_compra_20(event)' size='7' maxlength='7'>";
							echo "</div></td>";
							echo "<td><div align='center'>";
							  echo "<input  name='otros_ali'type='text' class='caja'  id='otros_ali' onKeyPress='return solo_entero(event)' onKeyUp='pasar_foco_fac_compra_22(event)' size='7' maxlength='7'>";
							echo "</div></td>";
							echo "<td><div align='center'>";
							echo "</div></td>";
						  echo "</tr>";
						  
						  echo "<tr bgcolor='#eeeeee'>";
							echo "<td> Importe:</td>";
							echo "<td><div align='center'>";
							  echo "<input  name='subtotal_imp'type='text' class='caja'  id='subtotal_imp' onKeyPress='return solo_entero(event)' onKeyUp='pasar_foco_fac_compra_13(event)' size='7' maxlength='7'>";
							echo "</div></td>";
							echo "<td><div align='center'>";
							  echo "<input  name='imp_int_imp'type='text' class='caja'  id='imp_int_imp' onKeyPress='return solo_entero(event)' onKeyUp='pasar_foco_fac_compra_15(event)' size='7' maxlength='7'>";
							echo "</div></td>";
							echo "<td><div align='center'>";
							  echo "<input  name='iva_imp'type='text' class='caja'  id='iva_imp' onKeyPress='return solo_entero(event)' onKeyUp='pasar_foco_fac_compra_17(event)' size='7' maxlength='7'>";
							echo "</div></td>";
							echo "<td><div align='center'>";
							  echo "<input  name='perc_iva_imp'type='text' class='caja'  id='perc_iva_imp' onKeyPress='return solo_entero(event)' onKeyUp='pasar_foco_fac_compra_19(event)' size='7' maxlength='7'>";
							echo "</div></td>";
							echo "<td><div align='center'>";
							  echo "<input  name='pib_imp' type='text' class='caja'  id='pib_imp' onKeyPress='return solo_entero(event)' onKeyUp='pasar_foco_fac_compra_21(event)' size='7' maxlength='7'>";
							echo "</div></td>";
							echo "<td><div align='center'>";
							  echo "<input  name='otros_imp'type='text' class='caja'  id='otros_imp' onKeyPress='return solo_entero(event)' onKeyUp='pasar_foco_fac_compra_23(event)' size='7' maxlength='7'>";
							echo "</div></td>";
							echo "<td><div align='center'>";
							  echo "<input  name='total'type='text' class='caja'  id='total' onKeyPress='return solo_entero(event)'  onKeyUp='pasar_foco_fac_compra_24(event)' size='7' maxlength='7'>";
							echo "</div></td>";
						  echo "</tr>";
				echo "</table>";
				
				echo "<br>";
				echo "<div  align='center' class='seccion'><b><u>DEPOSITOS PENDIENTES</u> $nombre</b></div>";
				echo "<br>";
				
				$consulta = "SELECT * from deposito where deposito.id not in (select id_deposito from factura_compra) order by id"; // consulta sql 
				$result = mysql_query($consulta);            // hace la consulta
			
				//---------------------abre la tabla--------------------------------------------------------------------------------------//
				echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
					echo "<tr class='top'>";
						echo "<td width='10%'><div align='center' class='seccion'>Fecha - Hora</div></td>";
						echo "<td width='20%'><div align='center' class='seccion'>Banco</div></td>";
						echo "<td width='10%'><div align='center' class='seccion'>N&ordm; Transacci&oacute;n</div></td>";
						echo "<td width='10%'><div align='center' class='seccion'>N&ordm; Cuenta</div></td>";
						echo "<td width='20%'><div align='center' class='seccion'>Titular</div></td>";
						echo "<td width='10%'><div align='center' class='seccion'>Importe</div></td>";
						echo "<td width='20%'><div align='center' class='seccion'>Seleccionar</div></td>";
					echo "</tr>";
					$clase="class='filas'"; 							//defino la clase para las filas
			
					while($registro = mysql_fetch_array($result)){ 	// obtengo los resultados 
							$id=$registro[0];		
							$fecha_deposito=$registro[1];
							$fecha_deposito_dia=substr($fecha_deposito,-2);
							$fecha_deposito_mes=substr($fecha_deposito,4,2);
							$fecha_deposito_ano=substr($fecha_deposito,0,4);
							$fecha_deposito= $fecha_deposito_dia.'/'.$fecha_deposito_mes.'/'.$fecha_deposito_ano;
							$hora=strtoupper($registro[2]);
							
							$banco=strtoupper($registro[3]);
							$trans=strtoupper($registro[4]);
							$cta=strtoupper($registro[5]);
							$titular=strtoupper($registro[6]);
							$importe=number_format($registro[7],2,'.','');
							$obs=strtoupper($registro[8]);
			
							echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA' title='$obs'>"; //efecto ded color en las filas
								echo "<td $clase align='left'>";
										echo $espacio_izq.$fecha_deposito;     
								echo"</td>";
								echo "<td $clase align='left'>";
										echo $espacio_izq.$banco;     
								echo"</td>";
								echo "<td $clase align='right'>";
										echo $trans.$espacio_izq;     
								echo"</td>";
								echo "<td $clase align='right'>";
										echo $cta.$espacio_izq;     
								echo"</td>";
								echo "<td $clase align='left'>";
										echo $espacio_izq.$titular;     
								echo"</td>";
								echo "<td $clase align='right'>";
										echo $importe.$espacio_izq;     
								echo"</td>";
								echo "<td $clase align='center'>";
										//echo $espacio_izq.$obs;     
										echo"<input name='deposito' id='deposito' type='radio' value='$id' onChange='actualizar_id_deposito($id)'>";
								echo"</td>";
							echo"</tr>";
					} //end while
					echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA' title='COMPRA DIRECTA'>"; //efecto ded color en las filas
						echo "<td $clase align='left'colspan=6 >";
							echo $espacio_izq."<b>PAGO DIRECTO</b>";     
						echo"</td>";
						echo "<td $clase align='center'colspan=6 >";
								//echo $espacio_izq.$obs;     
								echo"<input name='deposito' id='deposito' type='radio' value='0' checked onChange='actualizar_id_deposito(0)'>";
						echo"</td>";
						echo"<input name='id_deposito' id='id_deposito' type='hidden' value='0'>";
						
				echo"</tr>";
				echo "</table>";   
				//---------------------cierra tabla--------------------------------------------------------------------------------------//

		
		}
?>
