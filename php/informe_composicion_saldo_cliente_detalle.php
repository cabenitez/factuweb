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
	$consulta ="SELECT * FROM cc_vta_detalle where n_factura =$num_fac and cod_talonario ='$cod_tal' and num_talonario =$num_tal ";
	
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$filas = mysql_num_rows ($result);          //indica la cantidad de resultados
	
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<br>";
	echo "<div  align='center' class='seccion'><b><u>COMPOSICION DE SALDOS DETALLE</u></b></div>";

	echo "<input name='oculto_cod_talonario' id='oculto_cod_talonario' type='hidden' value='$cod_tal' />";
	echo "<input name='oculto_n_talonario' id='oculto_n_talonario' type='hidden' value=$num_tal />";
	echo "<input name='oculto_n_factura' id='oculto_n_factura' type='hidden' value=$num_fac />";
	echo "<input name='oculto_desc_fac' id='oculto_desc_fac' type='hidden' value='$desc_fac' />";
	echo "<input name='oculto_suc' id='oculto_suc' type='hidden' value=$suc />";
								
	echo '<br>';
	echo "<div  align='right' class='seccion'>";
		echo "<img src='../imagenes/pdf.gif' width='18' height='18' border='0' class='iconos'  title='Exportar' onClick=\"javascript: exportar_composicion_saldo_cliente_detalle('exportar_composicion_saldo_cliente_detalle.php')\" /> pdf  &nbsp;&nbsp;<img src='../imagenes/imprimir.png' width='18' height='18' title='Imprimir' class='iconos' onClick=\"javascript: imprimir_composicion_saldo_cliente_detalle('exportar_composicion_saldo_cliente_detalle.php')\" /> imprimir";
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
			echo "<td width='5%'><div align='center' class='seccion'>N&deg; TAL</div></td>";
			echo "<td width='20%'><div align='center' class='seccion'>COMPROBANTE</div></td>";
			echo "<td width='20%'><div align='center' class='seccion'>OBSERVACION</div></td>";
			echo "<td width='20%'><div align='center' class='seccion'>IMPUTADO POR</div></td>";

			echo "<td width='7%'><div align='center' class='seccion'>FECHA</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>IMPORTE</div></td>";
		echo "</tr>";

		$clase="class='filas'"; 							//defino la clase para las filas

		do{ 					// obtengo los resultados 
				$n_recibo=$registro[4];		
				$cod_tal_recibo=$registro[5];
				$num_tal_recibo=$registro[6];		
				$importe=$registro[7];
				$fecha_imp=$registro[8];
				$obs=$registro[9];
				$usuario_cs=$registro[10];
				
				//====================OBTENGO LA DESCRIPCION DEL RECIBO==========================//
				$consulta2 = "select * from tipo_talonario inner join talonario on tipo_talonario.cod_talonario = talonario.cod_talonario 
								where talonario.cod_talonario = '$cod_tal_recibo' and talonario.num_talonario = $num_tal_recibo"; 
				$result2 = mysql_query($consulta2);            
				$registro2 = mysql_fetch_row($result2);        
				$desc_recibo=$registro2[1];
				$suc_recibo=$registro2[5];

				
				//-------------------------//
				$len_num_tal_recibo=strlen($num_tal_recibo); 					// completo el numero de la sucursal con ceros
				$ceros_3 = '';
				while ($len_num_tal_recibo < 4){
						$ceros_3.="0";
						$len_num_tal_recibo++;
				}
				$num_tal_recibo=$ceros_3.$num_tal_recibo;
				//-------------------------//
				$len_num_sucursal_recibo=strlen($suc_recibo); 					// completo el numero de la sucursal con ceros
				$ceros_2 = '';
				while ($len_num_sucursal_recibo < 4){
						$ceros_2.="0";
						$len_num_sucursal_recibo++;
				}
				$suc_recibo=$ceros_2.$suc_recibo;
				//-------------------------//
				$len_n_recibo=strlen($n_recibo); 						// completo el numero de factura con ceros
				$ceros= '';
				while ($len_n_recibo < 8){								// completo el numero de la factura con ceros
						$ceros.="0";
						$len_n_recibo++;
				}
				$n_recibo=$ceros.$n_recibo;

			  //----------------------------------------------------------------------------------------------------------------//				  
			  $ano = substr($fecha_imp,0,4); 
			  $mes = substr($fecha_imp,4,2);
			  $dia = substr($fecha_imp,-2);
			  $fecha_imp = "$dia/$mes/$ano";										// maqueta la fecha para imprimir
			  //----------------------------------------------------------------------------------------------------------------//


				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='left'>";
							echo $espacio_izq.$num_tal_recibo;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$desc_recibo.' '.$suc_recibo.' '.$n_recibo;     
					echo"</td>";
					echo "<td $clase align='left'>";
						echo $espacio_izq.$obs;
					echo"</td>";
					echo "<td $clase align='left'>";
						$consulta22 = "SELECT nombre FROM usuario where usuario = '$usuario_cs'"; // consulta sql
						$result22 = mysql_query($consulta22);            // hace la consulta
						$registro22 = mysql_fetch_row($result22);        // toma el registro
						$usuario_cs = $registro22[0];

						echo $espacio_izq.$usuario_cs; 
					echo"</td>";

					echo "<td $clase align='center'>";
							echo $fecha_imp;     
					echo"</td>";

					echo "<td $clase align='right'>";
							echo number_format($importe,2,'.','').$espacio_izq;     
					echo"</td>";
					$total_importe= $total_importe + $importe;
				echo"</tr>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 		
				echo"<tr bgcolor='#E0E0E0' >";			
					echo"<td colspan='5' align='left'>&nbsp;&nbsp;TOTALES	</td>";
					$total_importe= number_format($total_importe,2,'.','');
					echo"<td align='right'>$total_importe$espacio_izq</td>";
					//echo"<td colspan='2' align='right'></td>";
				echo"</tr>";
	echo "</table>";   
	//---------------------cierra tabla--------------------------------------------------------------------------------------//
}
?>