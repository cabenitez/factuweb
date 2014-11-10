<?
		$nombre = strtoupper($nombre);
		if($nombre == "TODOS"){
			$pag_consulta = "SELECT * FROM forma_pago ORDER BY descripcion"; 									// consulta sql
		}else{
			$obs = strtoupper($obs);
			$consulta = "SELECT * FROM forma_pago"; 	// consulta sql
			$consulta2 = "where";
			include ("cascada_fp.php");
			$pag_consulta = $consulta . " " . "order by descripcion";
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
       		echo "<td width='20%'><div align='center' class='seccion'>Nombre</div></td>"; //columna
        	echo "<td width='70%'><div align='center' class='seccion'>Observacion</div></td>";
			echo "<td width='10%'><div align='center' class='seccion'>Modificar</div></td>";
        	//echo "<td width='14%'><div align='center' class='seccion'>Eliminar</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas
		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$codigo=$registro[0];
				$nombre=$registro[1];
				$obs=$registro[2];
				//echo "<tr onmouseover=color_seleccion(this,'EAEAEA'); onmouseout=color_defecto(this,'F7F7F7'); bgcolor='#F7F7F7'>"; //efecto ded color en las filas
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='left'>";
							echo $espacio_izq.$nombre;     
					echo"</td>";
					
					echo "<td $clase align='left'>";
							echo $espacio_izq.$obs;     
					echo"</td>"; 
					
					$consulta_cliente =  "select cod_cliente from cliente where cod_fp = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_cliente = mysql_query($consulta_cliente);            // hace la consulta
					$nfilas_cliente = mysql_num_rows ($result_cliente);          //indica la cantidad de resultados

					$consulta_factura_vta =  "select n_factura from factura_vta where cod_fp = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_factura_vta = mysql_query($consulta_factura_vta);            // hace la consulta
					$nfilas_factura_vta = mysql_num_rows ($result_factura_vta);          //indica la cantidad de resultados

					$consulta_factura_vta_no_cliente =  "select n_factura from factura_vta_no_cliente where cod_fp = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_factura_vta_no_cliente = mysql_query($consulta_factura_vta_no_cliente);            // hace la consulta
					$nfilas_factura_vta_no_cliente = mysql_num_rows ($result_factura_vta_no_cliente);          //indica la cantidad de resultados

					$consulta_cc_compra_detalle =  "select n_factura from cc_compra_detalle where cod_fp = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_cc_compra_detalle = mysql_query($consulta_cc_compra_detalle);            // hace la consulta
					$nfilas_cc_compra_detalle = mysql_num_rows ($result_cc_compra_detalle);          //indica la cantidad de resultados


					echo"<td $clase align='center'>";	
							if ( $nfilas_cliente == 0 && $nfilas_factura_vta == 0 && $nfilas_factura_vta_no_cliente == 0 && $nfilas_cc_compra_detalle == 0){     						 // si existe el usuario inicia la sesion
									echo "<img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' onClick='javascript: modificar_fp($codigo)'>"; 
							}else{
									echo "<img  src='../imagenes/modificar_no.png' border='0'>";
							}
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
