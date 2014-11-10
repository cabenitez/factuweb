<?
		$nombre = strtoupper($nombre);
		if($nombre == "TODOS"){
			$pag_consulta = "SELECT * FROM talonario INNER JOIN tipo_talonario ON tipo_talonario.cod_talonario = talonario.cod_talonario ORDER BY tipo_talonario.descripcion";		// consulta sql
		}else{
			$consulta = "SELECT * FROM talonario INNER JOIN tipo_talonario ON tipo_talonario.cod_talonario = talonario.cod_talonario";		// consulta sql
			$consulta2 = "where";
			include ("cascada_talonario.php");
			$pag_consulta = $consulta . " " . "order by tipo_talonario.descripcion";
		}
		//echo $consulta;
	//---------------------Paginacion----------------------------------------------------------------------------------------//
	$estilo_pag_nav = "barra_nav";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para los enlaces de paginación.
	$estilo_pag_actual = "barra_nav_actual";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	$estilo_pag_info = "caja";			//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	include("paginador.php");			//OBLIGATORIO Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
	//---------------------Fin Paginacion------------------------------------------------------------------------------------//
if($pag_filas > 0){
	echo $pag_info;  					//info de paginacion
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
      	echo "<tr class='top'>"; //fila
       		echo "<td><div align='center' class='seccion'>Comprobante</div></td>"; //columna
        	echo "<td><div align='center' class='seccion'>N&ordm; Talonario</div></td>";
			echo "<td><div align='center' class='seccion'>Primer N&ordm;</div></td>";
			echo "<td><div align='center' class='seccion'>Ultimo N&ordm;</div></td>";
			echo "<td><div align='center' class='seccion'>Siguiente N&ordm;</div></td>";
			echo "<td><div align='center' class='seccion'>Fecha Vto</div></td>";
			echo "<td><div align='center' class='seccion'>N&ordm; CAI</div></td>";
			echo "<td><div align='center' class='seccion'>Destino de Impresion</div></td>";
			echo "<td><div align='center' class='seccion'>Modificar</div></td>";
        	//echo "<td width='14%'><div align='center' class='seccion'>Eliminar</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas
				
		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$cod_tt= $registro[0];
				$numero=$registro[1];
		//================================IMPRESORAS==================================================================================//				
				$impresion=$registro[3];   									// obtiene el nombre y la info de la impresora
				$posicion_comodin = strrpos ($impresion, "#") + 1; 		
				$impresion = substr($impresion, $posicion_comodin); 		// obtiene solo la info de la impresora
		//================================FIN DE IMPRESORAS============================================================================//				
				
				$primer=$registro[5];
				$ultimo=$registro[6];
				$siguiente=$registro[7];
			    $dia = substr($registro[8], 0, 2);  // dia
				$mes = substr($registro[8], 2, 2);  // mes
				$ano = substr($registro[8], 4, 4);  // año
				$fecha=$dia."/".$mes."/".$ano;
				$cai=$registro[9];
				$tipo=$registro[11];

				$numero_talon=$numero;
				$len_numero=strlen($numero); 					// completo el numero de la sucursal con ceros
				while ($len_numero < 4){								// completo el numero de la factura con ceros
						$ceros.="0";
						$len_numero++;
				}
				$numero=$ceros.$numero;
				$ceros="";
					
				$len_num_sucursal=strlen($n_sucursal); 					// completo el numero de la sucursal con ceros
				while ($len_num_sucursal < 4){
						$ceros_2.="0";
						$len_num_sucursal++;
				}
				$n_sucursal=$ceros_2.$n_sucursal;
				$ceros_2="";
				
				$len_primer=strlen($primer); 					// completo el numero de la sucursal con ceros
				while ($len_primer < 8){								// completo el numero de la factura con ceros
						$ceros_3.="0";
						$len_primer++;
				}
				$primer=$ceros_3.$primer;
				$ceros_3="";
					
				$len_ultimo=strlen($ultimo); 					// completo el numero de la sucursal con ceros
				while ($len_ultimo < 8){
						$ceros_4.="0";
						$len_ultimo++;
				}
				$ultimo=$ceros_4.$ultimo;
				$ceros_4="";

				$len_siguiente=strlen($siguiente); 					// completo el numero de la sucursal con ceros
				while ($len_siguiente < 8){
						$ceros_5.="0";
						$len_siguiente++;
				}
				$siguiente=$ceros_5.$siguiente;
				$ceros_5="";

				//echo "<tr onmouseover=color_seleccion(this,'EAEAEA'); onmouseout=color_defecto(this,'F7F7F7'); bgcolor='#F7F7F7'>"; //efecto ded color en las filas
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='left'>";
							echo $espacio_izq.$tipo;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$numero;     //echo "<b>".$numero."</b>";     
					echo"</td>"; 
					echo "<td $clase align='left'>";
							echo $espacio_izq.$primer;     
					echo"</td>";					
					echo "<td $clase align='left'>";
							echo $espacio_izq.$ultimo;     
					echo"</td>";					
					echo "<td $clase align='left'>";
							echo $espacio_izq.$siguiente;     
					echo"</td>";					
					echo "<td $clase align='left'>";
							echo $espacio_izq.$fecha;     
					echo"</td>";					
					echo "<td $clase align='left'>";
							echo $espacio_izq.$cai;     
					echo"</td>";	
					echo "<td $clase align='left'>";
							echo $espacio_izq.$impresion;     
					echo"</td>";					
					
					$consulta_devolucion = "select n_devolucion from devolucion where cod_talonario = '$cod_tt' and num_talonario = $numero_talon";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_devolucion = mysql_query($consulta_devolucion);            							// hace la consulta
					$nfilas_devolucion = mysql_num_rows ($result_devolucion);          							//indica la cantidad de resultados
					
					$consulta_remito_vta = "select num_remito from remito_vta where cod_talonario = '$cod_tt' and num_talonario = $numero_talon";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_remito_vta = mysql_query($consulta_remito_vta);            							// hace la consulta
					$nfilas_remito_vta = mysql_num_rows ($result_remito_vta);          							//indica la cantidad de resultados

					$consulta_remito_vta_no_cliente = "select num_remito from remito_vta_no_cliente where cod_talonario = '$cod_tt' and num_talonario = $numero_talon";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_remito_vta_no_cliente = mysql_query($consulta_remito_vta_no_cliente);            	// hace la consulta
					$nfilas_remito_vta_no_cliente = mysql_num_rows ($result_remito_vta_no_cliente);          	//indica la cantidad de resultados
					
					$consulta_factura_vta = "select n_factura from factura_vta where cod_talonario = '$cod_tt' and num_talonario = $numero_talon";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_factura_vta = mysql_query($consulta_factura_vta);           						 // hace la consulta
					$nfilas_factura_vta = mysql_num_rows ($result_factura_vta);          						 //indica la cantidad de resultados

					$consulta_factura_vta_no_cliente = "select n_factura from factura_vta_no_cliente where cod_talonario = '$cod_tt' and num_talonario = $numero_talon";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_factura_vta_no_cliente = mysql_query($consulta_factura_vta_no_cliente);             // hace la consulta
					$nfilas_factura_vta_no_cliente = mysql_num_rows ($result_factura_vta_no_cliente);           //indica la cantidad de resultados
					
					$consulta_recibos_por_cliente = "select cod_cliente from recibos_por_cliente where cod_talonario = '$cod_tt' and num_talonario = $numero_talon";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_recibos_por_cliente = mysql_query($consulta_recibos_por_cliente);            		// hace la consulta
					$nfilas_recibos_por_cliente = mysql_num_rows ($result_recibos_por_cliente);          		//indica la cantidad de resultados
					
					echo"<td align='center'>";	
							//if ($nfilas_devolucion == 0 && $nfilas_remito_vta == 0 && $nfilas_remito_vta_no_cliente == 0 && $nfilas_factura_vta == 0 && $nfilas_factura_vta_no_cliente == 0 && $nfilas_recibos_por_cliente == 0){     						 // si existe el usuario inicia la sesion
									?><img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' onClick="javascript: modificar_talonario('<? echo $cod_tt ?>' , <? echo $numero_talon ?>)"><?
							//}else{
							//		echo "<img  src='../imagenes/modificar_no.png' border='0'>";
							//}
					echo"</td>"; 
					/*echo"<td align='center'>"; 
							echo "<img class='iconos' src='../imagenes/eliminar.png' border='0' title='Eliminar' onClick='javascript: eliminar_iva($codigo)'>"; //onClick='javascript: abreventanaprecio($codigo)'
					echo"</td>"; 		*/
				echo"</tr>";
		}
	echo "</table>";   
	//---------------------cierra tabla--------------------------------------------------------------------------------------//
	echo $pag_navegacion;
	
	//================================ OBTIENE LA CONSULTA PARA IMPRIMIR ==================================================================================//				
	$posicion_limit = strrpos ($pag_consulta, "limit"); 		
	$consulta_informe = substr($pag_consulta, 0,$posicion_limit); 		// obtiene solo la info de la impresora
	$consulta_informe = ereg_replace("'","@@",$consulta_informe);
	
	include('consulta_session.php');		// crea el div y el id de session del sql
	//================================ FIN DE OBTIENE LA CONSULTA PARA IMPRIMIR ===========================================================================//				
	
}else{
echo "<div class='$estilo_pag_info'>NO se han encontrado Registros</div>";
}	
?>
