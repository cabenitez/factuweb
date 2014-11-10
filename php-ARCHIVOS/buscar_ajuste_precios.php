<?
    $pag_consulta = "select * from grupo order by cod_grupo"; // producto.cod_proveedor,
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
        	echo "<td width='7%' ><div align='center' class='seccion'>C&oacute;digo</div></td>";
        	echo "<td width='20%' ><div align='center' class='seccion'>Descripcion</div></td>";
			echo "<td width='20%' ><div align='center' class='seccion'>Categor&iacute;a</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>Metodo de Ajuste</div></td>";
        	echo "<td width='10%' ><div align='center' class='seccion'>Utilidad</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas
		$i = 0;
		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$codigo=$registro[0];
				$desc=$registro[1];
				
				$consulta_cat= "select cod_categoria from categoria";
				$result_cat = mysql_query($consulta_cat);            // hace la consulta
				$cant = mysql_num_rows($result_cat);        	 // toma el registro

                $i++;
				echo "<tr id='fila_$i' onMouseOver=color_seleccion_hijo('E0E0E0',$i,$cant); onMouseOut=color_defecto_hijo('EAEAEA',$i,$cant); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td rowspan='$cant' $clase align='center'>";
							echo $codigo;     
					echo"</td>";
					echo "<td rowspan='$cant' $clase align='left'>";
							echo $espacio_izq.$desc;     
					echo"</td>";

					$consulta2 ="select cod_categoria,descripcion from categoria ORDER BY descripcion";
					$result2 = mysql_query($consulta2);            // hace la consulta
					$reg2 = mysql_fetch_row($result2);
					
					$cod_categoria= $reg2[0];
					$categoria= $reg2[1];										
					
					echo "<td $clase align='left'>";
							echo $espacio_izq.$categoria;     
					echo"</td>";

					$consulta3 ="select utilidad from ajuste_precio where cod_grupo = $codigo and cod_categoria = $cod_categoria";
					$result3 = mysql_query($consulta3);            // hace la consulta
					$reg3 = mysql_fetch_row($result3);
					$cant3 = mysql_num_rows($result3);        	 // toma el registro
					if($cant3 > 0){
						$ajuste_metodo= "Margen de Utilidad";
						$ajuste_porcentaje= $reg3[0].'%';
					}else{
 						$ajuste_metodo= "Manual";
						$ajuste_porcentaje= "";
					}
					echo "<td $clase align='left'>";
							echo $espacio_izq.$ajuste_metodo;     
					echo"</td>";
					
					echo "<td $clase align='center'>";
							echo $espacio_izq.$ajuste_porcentaje;     
					echo"</td>";

				echo"</tr>";

				//--------------------------------------------------------//						

				$consulta ="select cod_categoria,descripcion from categoria ORDER BY descripcion LIMIT 1,$cant";
				//echo $consulta;
				$result = mysql_query($consulta);            // hace la consulta
				while($regi = mysql_fetch_array($result)){ 	 // obtengo los resultados 
					$cod_categoria= $regi[0];
					$categoria= $regi[1];
					
					$i++;
					echo"<tr id= 'fila_$i' bgcolor='#EAEAEA'>";
						echo "<td $clase align='left'>"; 
								echo $espacio_izq.$categoria;     
						echo"</td>";
						
						$consulta4 ="select utilidad from ajuste_precio where cod_grupo = $codigo and cod_categoria = $cod_categoria";
						$result4 = mysql_query($consulta4);            // hace la consulta
						$reg4 = mysql_fetch_row($result4);
						$cant4 = mysql_num_rows($result4);        	 // toma el registro
						if($cant4 > 0){
							$ajuste_metodo= "Margen de Utilidad";
							$ajuste_porcentaje= $reg4[0].'%';
						}else{
							$ajuste_metodo= "Manual";
							$ajuste_porcentaje= "";
						}
						echo "<td $clase align='left'>";
								echo $espacio_izq.$ajuste_metodo;     
						echo"</td>";

						echo "<td $clase align='center'>";
								echo $espacio_izq.$ajuste_porcentaje;     
						echo"</td>";
					echo"</tr>";
				} //end while 
		} //end while
		
	echo "</table>";   
	//---------------------cierra tabla--------------------------------------------------------------------------------------//
	echo $pag_navegacion;
	
	/*
	//================================ OBTIENE LA CONSULTA PARA IMPRIMIR ==================================================================================//				
	 $posicion_order = strrpos ($pag_consulta, "group by"); 		
	 $consulta_order = substr($pag_consulta, 0,$posicion_order); 		// obtiene solo la info de la impresora
	 
	 $posicion_where = strrpos ($pag_consulta, "where");
	 if($posicion_where > 0){
	 	$palabra = ' and ';
	 }else{
		 $palabra = ' where ';
	 }
	 
	 $consulta_informe = $consulta_order .$palabra." activo = 'S' group by producto.descripcion,producto.cod_prod,producto.cod_variedad,producto.cod_marca,producto.cod_grupo order by  producto.cod_proveedor, producto.cod_grupo,producto.cod_marca,producto.cod_variedad,producto.cod_prod";
	 $consulta_informe = ereg_replace("'","@@",$consulta_informe);
	
	
	
	//$posicion_limit = strrpos ($pag_consulta, "limit"); 		 
	//$consulta_informe = substr($pag_consulta, 0,$posicion_limit); 		// obtiene solo la info de la impresora
	//$consulta_informe = ereg_replace("'","@@",$consulta_informe);
	
	include('consulta_session.php');		// crea el div y el id de session del sql
	//================================ FIN DE OBTIENE LA CONSULTA PARA IMPRIMIR ===========================================================================//				
   */
	
}else{
	echo "<div class='$estilo_pag_info'>NO se han encontrado Registros</div>";
}	
?>
