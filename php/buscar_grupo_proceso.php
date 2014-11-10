<?
		$nombre = strtoupper($nombre);
		if($nombre == "TODOS"){
			$pag_consulta = "SELECT * FROM grupo order by cod_grupo"; 									// consulta sql
		}else{
			$consulta = "Select * from grupo";
     		$consulta2 = "where";
			include ("cascada_grupos.php");
			$pag_consulta = $consulta . " " . "order by cod_grupo";
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
      	echo "<tr class='top'>";
        	echo "<td width='20%'><div align='center' class='seccion'>Codigo</div></td>";
        	echo "<td width='65%'><div align='center' class='seccion'>Descripcion</div></td>";
			echo "<td width='15%'><div align='center' class='seccion'>Modificar</div></td>";
        	//echo "<td width='14%'><div align='center' class='seccion'>Eliminar</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas

		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$codigo=$registro[0];		
				$nombre=$registro[1];
				//echo "<tr onmouseover=color_seleccion(this,'EAEAEA'); onmouseout=color_defecto(this,'F7F7F7'); bgcolor='#F7F7F7'>"; //efecto ded color en las filas
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='center'>";
							echo $codigo;     
					echo"</td>"; 
					echo"<td $clase align='left'>";	
							echo $espacio_izq.$nombre;
					echo"</td>"; 
	
					$consulta_marca =  "select cod_marca from marca where cod_grupo = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_marca = mysql_query($consulta_marca);            // hace la consulta
					$nfilas_marca = mysql_num_rows ($result_marca);          //indica la cantidad de resultados


					echo"<td $clase align='center'>";	 
							if ( $nfilas_marca == 0 ){     						 // si existe el usuario inicia la sesion
									echo "<img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' onClick='javascript: modificar_grupo($codigo)'>";
							}else{
									echo "<img  src='../imagenes/modificar_no.png' border='0'>";
							}
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
