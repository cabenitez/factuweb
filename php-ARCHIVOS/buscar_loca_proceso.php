<?
		$nombre = strtoupper($nombre);
		if($nombre == "TODOS"){
			$pag_consulta = "SELECT  provincia.nombre, localidad.nombre, localidad.cod_localidad, localidad.cp FROM localidad INNER JOIN provincia WHERE provincia.cod_prov = localidad.cod_prov ORDER BY provincia.nombre, localidad.nombre"; 									// consulta sql
		}else{
			$pag_consulta = "SELECT  provincia.nombre, localidad.nombre, localidad.cod_localidad, localidad.cp FROM localidad INNER JOIN provincia ON provincia.cod_prov = localidad.cod_prov where localidad.nombre LIKE '%$nombre%' ORDER BY provincia.nombre, localidad.nombre"; 	// consulta sql
		}
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
       		echo "<td width='36%'><div align='center' class='seccion'>Provincia</div></td>"; //columna
        	echo "<td width='36%'><div align='center' class='seccion'>Localidad</div></td>";
			echo "<td width='14%'><div align='center' class='seccion'>Modificar</div></td>";
        	echo "<td width='14%'><div align='center' class='seccion'>Eliminar</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas
		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$prov_nombre=$registro[0];		
				$nombre=$registro[1];
				$codigo=$registro[2];		
				$cp=$registro[3];
				//echo "<tr onmouseover=color_seleccion(this,'EAEAEA'); onmouseout=color_defecto(this,'F7F7F7'); bgcolor='#F7F7F7'>"; //efecto ded color en las filas
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='left'>";
							echo $espacio_izq.$prov_nombre;     
					echo"</td>";
					
					echo "<td $clase align='left'>";
							echo $espacio_izq.$cp.' - '.$nombre;     
					echo"</td>"; 
					
					$consulta_zona= "select * from zona where cod_localidad = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_zona = mysql_query($consulta_zona);            // hace la consulta
					$nfilas_zona = mysql_num_rows ($result_zona);          //indica la cantidad de resultados
					
					$consulta_vendedor= "select * from vendedor where cod_localidad = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_vendedor = mysql_query($consulta_vendedor);            // hace la consulta
					$nfilas_vendedor = mysql_num_rows ($result_vendedor);          //indica la cantidad de resultados

					$consulta_proveedor= "select * from proveedor where cod_localidad = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_proveedor = mysql_query($consulta_proveedor);            // hace la consulta
					$nfilas_proveedor = mysql_num_rows ($result_proveedor);          //indica la cantidad de resultados
					
					$consulta_fletero= "select * from fletero where cod_localidad = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_fletero = mysql_query($consulta_fletero);            // hace la consulta
					$nfilas_fletero = mysql_num_rows ($result_fletero);          //indica la cantidad de resultados

					echo"<td align='center'>";	
							if ($nfilas_zona == 0 && $nfilas_vendedor == 0 && $nfilas_proveedor == 0 && $nfilas_fletero == 0){     						 // si existe el usuario inicia la sesion
									echo "<img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' onClick='javascript: modificar_loca($codigo)'>";   
							}else{
									echo "<img  src='../imagenes/modificar_no.png' border='0'>";
							}

					echo"</td>"; 

					echo"<td align='center'>"; 
							if ($nfilas_zona == 0 && $nfilas_vendedor == 0 && $nfilas_proveedor == 0 && $nfilas_fletero == 0){     						 // si existe el usuario inicia la sesion
									echo "<img class='iconos' src='../imagenes/eliminar.png' border='0' title='Eliminar' onClick='javascript: eliminar_loca($codigo)'>"; //onClick='javascript: abreventanaprecio($codigo)'
							}else{
									echo "<img  src='../imagenes/eliminar_no.png' border='0'>";   
							}
					echo"</td>"; 		
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
