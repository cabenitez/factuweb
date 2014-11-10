<?
	$pag_consulta = "SELECT * FROM caja_inicial ORDER BY fecha"; 									// consulta sql
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
       		echo "<td width='20%'><div align='center' class='seccion'>Fecha</div></td>"; //columna
        	echo "<td width='10%'><div align='center' class='seccion'>Importe</div></td>";
			echo "<td width='70%'><div align='center' class='seccion'>Observacion</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas
		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$fecha_caja=$registro[0];
			    $fecha_caja_ano=substr($fecha_caja,0,4);
			    $fecha_caja_mes=substr($fecha_caja,4,2);
			    $fecha_caja_dia=substr($fecha_caja,-2);
				$fecha_caja = "$fecha_caja_dia/$fecha_caja_mes/$fecha_caja_dia";

				$importe = number_format($registro[1],2,'.','');
				$obs=$registro[2];
				//echo "<tr onmouseover=color_seleccion(this,'EAEAEA'); onmouseout=color_defecto(this,'F7F7F7'); bgcolor='#F7F7F7'>"; //efecto ded color en las filas
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='left'>";
							echo $espacio_izq.$fecha_caja;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo $importe.$espacio_izq;     
					echo"</td>"; 
					
					echo "<td $clase align='left'>";
							echo $espacio_izq.$obs;     
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