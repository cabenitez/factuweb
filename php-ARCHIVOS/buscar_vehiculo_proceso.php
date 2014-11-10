<?
	include("conexion.php");
	$marca = strtoupper($marca);
	$chofer = strtoupper($chofer);
		
	$consulta = "SELECT * FROM fletero"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			if($nombre == "TODOS"){
			$pag_consulta = "SELECT * FROM vehiculo  order by cod_vehiculo"; 									// consulta sql
		}else{
			$consulta = "SELECT * FROM vehiculo";
     		$consulta2 = "where";   
			$flet="no";
			include ("cascada_vehiculo.php");
			$pag_consulta = $consulta . " " . "order by vehiculo.cod_vehiculo";
			//echo $pag_consulta;
		}
	}else{
		if($nombre == "TODOS"){
			$pag_consulta = "SELECT * FROM vehiculo left JOIN (fletero_por_vehiculo left JOIN fletero ON fletero.cod_flero = fletero_por_vehiculo.cod_flero) ON fletero_por_vehiculo.cod_vehiculo = vehiculo.cod_vehiculo";
		}else{
			$consulta = "SELECT * FROM vehiculo left JOIN (fletero_por_vehiculo left JOIN fletero ON fletero.cod_flero = fletero_por_vehiculo.cod_flero) ON fletero_por_vehiculo.cod_vehiculo = vehiculo.cod_vehiculo ";
     		$consulta2 = "where";   
			include ("cascada_vehiculo.php");
			$pag_consulta = $consulta . " " . "order by vehiculo.cod_vehiculo";
			//echo $pag_consulta;
		}
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
        	echo "<td width='7%'><div align='center' class='seccion'>Codigo</div></td>";
			echo "<td width='8%'><div align='center' class='seccion'>Patente</div></td>";
        	echo "<td width='8%'><div align='center' class='seccion'>Acoplado</div></td>";
        	echo "<td width='23%'><div align='center' class='seccion'>Marca</div></td>";
			echo "<td width='23%'><div align='center' class='seccion'>Modelo</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>Propio</div></td>";
			echo "<td width='16%'><div align='center' class='seccion'>Repartidor</div></td>";
			echo "<td width='8%'><div align='center' class='seccion'>Modificar</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas

		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$codigo=$registro[0];		
				$patente=$registro[1];
				$patente_a=$registro[2];
				$marca=$registro[3];
				$modelo=$registro[4];
				$propiedad=$registro[5];
				$repartidor=$registro[10];

				//echo "<tr onmouseover=color_seleccion(this,'EAEAEA'); onmouseout=color_defecto(this,'F7F7F7'); bgcolor='#F7F7F7'>"; //efecto ded color en las filas
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='center'>";
							echo $codigo;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$patente;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$patente_a;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$marca;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$modelo;     
					echo"</td>";
					echo "<td $clase align='center'>";
							if($propiedad == "S"){
								echo "SI";     
							}else{
								echo "NO";
							}
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$repartidor;     
					echo"</td>";					
					
					$consulta_fletero= "select cod_flero from fletero_por_vehiculo where cod_vehiculo = $codigo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
					$result_fletero = mysql_query($consulta_fletero);            // hace la consulta
					$nfilas_fletero = mysql_num_rows ($result_fletero);          //indica la cantidad de resultados

					echo"<td $clase align='center'>";	
							if ($nfilas_fletero == 0){     						 // si existe el usuario inicia la sesion
									echo "<img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' onClick='javascript: modificar_vehiculo($codigo)'>"; 
							}else{
									echo "<img  src='../imagenes/modificar_no.png' border='0'>";
							}
					echo"</td>"; 
					/*
					echo"<td $clase align='center'>"; 
							echo "<img class='iconos' src='../imagenes/eliminar.png' border='0' title='Eliminar' onClick='javascript: eliminar_pais($codigo)'>"; //onClick='javascript: abreventanaprecio($codigo)'
					echo"</td>"; 		
					*/
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
