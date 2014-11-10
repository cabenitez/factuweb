<?
		$nombre = strtoupper($nombre);
		if($nombre == "TODOS"){
			$pag_consulta = "SELECT * FROM tipo_asociado order by letra"; 									// consulta sql
		}else{
			$pag_consulta = "SELECT * FROM tipo_asociado where nombre LIKE '%$letra%' order by letra"; 	// consulta sql
		}
	//---------------------Paginacion----------------------------------------------------------------------------------------//
	$estilo_pag_nav = "barra_nav";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para los enlaces de paginación.
	$estilo_pag_actual = "barra_nav_actual";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	$estilo_pag_info = "caja";			//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	//$pag_tamano = 1;
	include("paginador.php");			//OBLIGATORIO Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
	//---------------------Fin Paginacion------------------------------------------------------------------------------------//
if($pag_filas > 0){
	echo $pag_info;  					//info de paginacion
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<table width='100%' border='0'cellspacing='1' cellpadding='0'>";
      	echo "<tr class='top'>";
        	echo "<td width='72%'><div align='center' class='seccion'>Letra</div></td>";
        	//echo "<td width='14%'><div align='center' class='seccion'>Modificar</div></td>";
        	echo "<td width='14%'><div align='center' class='seccion'>Eliminar</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas

		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$nombre=$registro[0];
				//echo "<tr onmouseover=color_seleccion(this,'EAEAEA'); onmouseout=color_defecto(this,'F7F7F7'); bgcolor='#F7F7F7'>"; //efecto ded color en las filas
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='center'>";
							echo $nombre;     
					echo"</td>"; 
					/*
					echo"<td $clase align='center'>";	
							echo "<img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' onClick='javascript: modificar_tipo_asoc($nombre)'>"; 
					echo"</td>"; 
					*/
					echo"<td $clase align='center'>"; 
							?> <img class='iconos' src='../imagenes/eliminar.png' border='0' title='Eliminar' onClick="javascript: eliminar_tipo_asoc('<? echo $nombre; ?>')"> <?  //onClick='javascript: abreventanaprecio($codigo)'
					echo"</td>"; 		
				echo"</tr>";
		} //end while
		
	echo "</table>";   
	//---------------------cierra tabla--------------------------------------------------------------------------------------//
	echo $pag_navegacion;
}else{
echo "<div class='$estilo_pag_info'>NO se han encontrado Registros</div>";
}	
?>
