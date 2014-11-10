<?
		$nombre = strtoupper($nombre);
		if($nombre == "TODOS"){
			$pag_consulta = "SELECT grupo.cod_grupo, grupo.descripcion, marca.cod_marca, marca.descripcion FROM marca INNER JOIN grupo ON grupo.cod_grupo = marca.cod_grupo ORDER BY grupo.cod_grupo, marca.cod_marca";
		}else{
			$consulta = "SELECT grupo.cod_grupo, grupo.descripcion, marca.cod_marca, marca.descripcion FROM marca INNER JOIN grupo ON grupo.cod_grupo = marca.cod_grupo";
     		$consulta2 = " where ";
			include ("cascada_marcas.php");
			$pag_consulta = $consulta . " " . "ORDER BY grupo.cod_grupo, marca.cod_marca";
			//echo $pag_consulta;
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
       		echo "<td width='15%'><div align='center' class='seccion'>Codigo</div></td>"; //columna
        	echo "<td width='35%'><div align='center' class='seccion'>Marca</div></td>";
			echo "<td width='35%'><div align='center' class='seccion'>Grupo</div></td>";
			echo "<td width='15%'><div align='center' class='seccion'>Modificar</div></td>";
        	//echo "<td width='14%'><div align='center' class='seccion'>Eliminar</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas
		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$cod_grupo=$registro[0];		
				$grupo=$registro[1];		
				$codigo=$registro[2];
				$nombre=$registro[3];
				
				//echo "<tr onmouseover=color_seleccion(this,'EAEAEA'); onmouseout=color_defecto(this,'F7F7F7'); bgcolor='#F7F7F7'>"; //efecto ded color en las filas
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='center'>";
							echo $codigo;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$nombre;     
					echo"</td>";					
					echo "<td $clase align='left'>";
							echo $espacio_izq.$cod_grupo." - ".$grupo;     
					echo"</td>"; 
					
					$consulta_variedad =  "select cod_variedad from variedad where cod_marca = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_variedad = mysql_query($consulta_variedad);            // hace la consulta
					$nfilas_variedad = mysql_num_rows ($result_variedad);          //indica la cantidad de resultados


					echo"<td $clase align='center'>";	
							if ( $nfilas_variedad == 0 ){      						 // si existe el usuario inicia la sesion
									echo "<img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' onClick='javascript: modificar_marca($codigo,$cod_grupo)'>";
							}else{
									echo "<img  src='../imagenes/modificar_no.png' border='0'>";
							}
					echo"</td>"; 

				/*	echo"<td align='center'>"; 
							echo "<img class='iconos' src='../imagenes/eliminar.png' border='0' title='Eliminar' onClick='javascript: eliminar_prov($codigo)'>"; //onClick='javascript: abreventanaprecio($codigo)'
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
