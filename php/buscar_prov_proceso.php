<?
		$nombre = strtoupper($nombre);
		if($nombre == "TODOS"){
			$pag_consulta = "SELECT pais.nombre, provincia.cod_prov, provincia.nombre FROM provincia INNER JOIN pais WHERE pais.cod_pais = provincia.cod_pais ORDER BY pais.nombre"; 									// consulta sql
		}else{
			$pag_consulta = "SELECT pais.nombre, provincia.cod_prov, provincia.nombre FROM provincia INNER JOIN pais ON pais.cod_pais = provincia.cod_pais where provincia.nombre LIKE '%$nombre%' order by pais.nombre"; 	// consulta sql
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
       		echo "<td width='36%'><div align='center' class='seccion'>Pais</div></td>"; //columna
        	echo "<td width='36%'><div align='center' class='seccion'>Provincia</div></td>";
			echo "<td width='14%'><div align='center' class='seccion'>Modificar</div></td>";
        	echo "<td width='14%'><div align='center' class='seccion'>Eliminar</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas
		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$pais_nombre=$registro[0];		
				$codigo=$registro[1];		
				$nombre=$registro[2];
				//echo "<tr onmouseover=color_seleccion(this,'EAEAEA'); onmouseout=color_defecto(this,'F7F7F7'); bgcolor='#F7F7F7'>"; //efecto ded color en las filas
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='left'>";
							echo $espacio_izq.$pais_nombre;     
					echo"</td>";
					
					echo "<td $clase align='left'>";
							echo $espacio_izq.$nombre;     
					echo"</td>"; 
					
					$consulta_prov = "select * from localidad where cod_prov = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_prov = mysql_query($consulta_prov);            // hace la consulta
					$nfilas_prov = mysql_num_rows ($result_prov);          //indica la cantidad de resultados

					echo"<td align='center'>";	
							if ($nfilas_prov == 0){     						 // si existe el usuario inicia la sesion
							echo "<img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' onClick='javascript: modificar_prov($codigo)'>"; 
							}else{
									echo "<img  src='../imagenes/modificar_no.png' border='0'>"; 
							}
					echo"</td>"; 

					echo"<td align='center'>"; 
							if ($nfilas_prov == 0){     						 // si existe el usuario inicia la sesion
									echo "<img class='iconos' src='../imagenes/eliminar.png' border='0' title='Eliminar' onClick='javascript: eliminar_prov($codigo)'>"; //onClick='javascript: abreventanaprecio($codigo)'
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
