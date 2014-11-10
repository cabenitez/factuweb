<?
	include("conexion.php");
	
	$marca = strtoupper($marca);
	$chofer = strtoupper($chofer);
		
	if($nombre == "TODOS"){
		$pag_consulta = "SELECT * FROM agenda order by nombre";
	}else{
		$consulta = "SELECT * FROM agenda ";
		$consulta2 = "where";   
		include ("cascada_vehiculo.php");
		$pag_consulta = $consulta . " " . "order by nombre";
		//echo $pag_consulta;
	}

	//echo $pag_consulta;
	//---------------------Paginacion----------------------------------------------------------------------------------------//
	$estilo_pag_nav = "barra_nav";					//OPCIONAL Cadena. Contiene el nombre del estilo CSS para los enlaces de paginación.
	$estilo_pag_actual = "barra_nav_actual";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	$estilo_pag_info = "caja";						//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	
	include("paginador.php");						//OBLIGATORIO Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
	//---------------------Fin Paginacion------------------------------------------------------------------------------------//
if($pag_filas > 0){
	echo $pag_info;  					//info de paginacion
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
      	echo "<tr class='top'>";
        	echo "<td width='28%'><div align='center' class='seccion'>Nombre</div></td>";
			echo "<td width='28%'><div align='center' class='seccion'>Telefono</div></td>";
        	echo "<td width='28%'><div align='center' class='seccion'>e-mail</div></td>";
			echo "<td width='8%'><div align='center' class='seccion'>Modificar</div></td>";
			echo "<td width='8%'><div align='center' class='seccion'>Eliminar</div></td>";			
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas

		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$codigo=$registro[0];		
				$nombre=$registro[1];
				$telefono=$registro[2];
				$mail=$registro[3];

				//echo "<tr onmouseover=color_seleccion(this,'EAEAEA'); onmouseout=color_defecto(this,'F7F7F7'); bgcolor='#F7F7F7'>"; //efecto ded color en las filas
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='left'>";
							echo $espacio_izq.$nombre;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$telefono;     
					echo"</td>";

					echo "<td $clase align='left'>";
							echo $espacio_izq.$mail;     
					echo"</td>";

					echo"<td $clase align='center'>";	
							echo "<img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' onClick='javascript: modificar_agenda($codigo)'>"; 
					echo"</td>"; 

					echo"<td $clase align='center'>"; 
							echo "<img class='iconos' src='../imagenes/eliminar.png' border='0' title='Eliminar' onClick='javascript: eliminar_agenda($codigo)'>"; //onClick='javascript: abreventanaprecio($codigo)'
					echo"</td>"; 		
				echo"</tr>";
		} //end while
		
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
