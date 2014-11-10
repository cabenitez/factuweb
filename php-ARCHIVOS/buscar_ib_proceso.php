<?
		$nombre = strtoupper($nombre);
		if($nombre == "TODOS"){
			$pag_consulta = "SELECT * FROM ing_bruto ORDER BY cod_prov"; 									// consulta sql
		}else{
			$pag_consulta = "SELECT * FROM ing_bruto where ing_bruto.nombre LIKE '%$nombre%' order by cod_prov"; 	// consulta sql
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
       		echo "<td width='29%'><div align='center' class='seccion'>Nombre</div></td>"; //columna
        	echo "<td width='14%'><div align='center' class='seccion'>Tasa %</div></td>";
			echo "<td width='29%'><div align='center' class='seccion'>Provincia</div></td>"; //columna
			echo "<td width='14%'><div align='center' class='seccion'>Modificar</div></td>";
        	echo "<td width='14%'><div align='center' class='seccion'>Eliminar</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas
		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$codigo=$registro[0];
				$nombre=$registro[1];
				$tasa=$registro[2];
				$cod_prov=$registro[3];
				
				//echo "<tr onmouseover=color_seleccion(this,'EAEAEA'); onmouseout=color_defecto(this,'F7F7F7'); bgcolor='#F7F7F7'>"; //efecto ded color en las filas
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
						echo "<td $clase align='left'>";
							echo $espacio_izq.$espacio_izq.$espacio_izq.$espacio_izq.$nombre;     
					echo"</td>";
					
					echo "<td $clase align='center'>";
							echo $tasa;     
					echo"</td>"; 

					echo "<td $clase align='left'>";
							$consulta_p = "SELECT nombre FROM provincia where cod_prov = $cod_prov"; // consulta sql                  where nombre = '$nombre'
							$result_p = mysql_query($consulta_p);            // hace la consulta
							$registro_p = mysql_fetch_row($result_p);        // toma el registro
							echo $espacio_izq.$registro_p[0];
					echo"</td>"; 
					
					echo"<td align='center'>";	
							echo "<img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' onClick='javascript: modificar_ib($codigo)'>"; 
					echo"</td>"; 
					echo"<td align='center'>"; 
							echo "<img class='iconos' src='../imagenes/eliminar.png' border='0' title='Eliminar' onClick='javascript: eliminar_ib($codigo)'>"; //onClick='javascript: abreventanaprecio($codigo)'
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
