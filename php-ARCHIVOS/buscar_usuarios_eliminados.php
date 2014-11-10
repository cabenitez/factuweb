<?
	$pag_consulta = "SELECT * FROM usuario where activo = 'N' order by nombre"; 									// consulta sql

	//---------------------Paginacion----------------------------------------------------------------------------------------//
	$estilo_pag_nav = "barra_nav";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para los enlaces de paginación.
	$estilo_pag_actual = "barra_nav_actual";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	$estilo_pag_info = "caja";			//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	
	include("paginador.php");			//OBLIGATORIO Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
	//---------------------Fin Paginacion------------------------------------------------------------------------------------//
if($pag_filas > 0){
 echo "<div align='left' class='seccion'>";
	//echo $pag_info;  					//info de paginacion
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<table width='50%'  border='0'cellspacing='1' cellpadding='0'>"; 
      	echo "<tr class='top'>"; 
        	echo "<td  class = 'content' align='left'>";
						echo "ELIMINADOS";     
			echo"</td>";
		echo "</tr>";
      	echo "<tr class='top'>";
        	echo "<td width='23%'><div align='center' class='seccion'>Usuario</div></td>";
        	echo "<td width='80%'><div align='center' class='seccion'>Nombre</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas

		echo"<div ID='overDiv' STYLE='position:absolute; visibility:hide; z-index: 1;'>";   // Capa para el detalle tipo tooltip
		
		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$usuario_sis=$registro[1];
				$clave_sis=$registro[2];
				$nombre_sis=$registro[3];

				
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='left'>";
							echo $espacio_izq.$usuario_sis;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$nombre_sis;      
					echo"</td>";
				echo"</tr>";
		} //end while
		
	echo "</table>";   
	//---------------------cierra tabla--------------------------------------------------------------------------------------//
	echo $pag_navegacion;
echo "</div>";	
}
?>
