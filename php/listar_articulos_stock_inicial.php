<?
			$pag_consulta = "select concat(cod_grupo,cod_marca,cod_variedad,cod_prod), descripcion, stock_actual from producto where activo = 'S' order by producto.cod_proveedor, producto.cod_grupo,producto.cod_marca,producto.cod_variedad,producto.cod_prod";

	//---------------------Paginacion----------------------------------------------------------------------------------------//
	$estilo_pag_nav = "barra_nav";					//OPCIONAL Cadena. Contiene el nombre del estilo CSS para los enlaces de paginación.
	$estilo_pag_actual = "barra_nav_actual";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	$estilo_pag_info = "caja";						//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	
	include("paginador.php");						//OBLIGATORIO Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
	//---------------------Fin Paginacion------------------------------------------------------------------------------------//
if($pag_filas > 0){
	//echo $pag_info;  					//info de paginacion
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
      	echo "<tr class='top'>";
        	echo "<td width='10%' ><div align='center' class='seccion'>Codigo</div></td>";
        	echo "<td width='80%' ><div align='center' class='seccion'>Descripcion</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>Stock Actual</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas
		
		echo"<div ID='overDiv' STYLE='position:absolute; visibility:hide; z-index: 1;'>";   // Capa para el detalle tipo tooltip
		
		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$codigo=$registro[0];
				$descripcion=$registro[1];
				$stock=$registro[2];
				
				//echo "<tr onmouseover=color_seleccion(this,'EAEAEA'); onmouseout=color_defecto(this,'F7F7F7'); bgcolor='#F7F7F7'>"; //efecto ded color en las filas
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td rowspan='$cant' $clase align='center'>";
							echo $codigo;     
					echo"</td>";
					echo "<td rowspan='$cant' $clase align='left'>";
							echo $espacio_izq.$descripcion;     
					echo"</td>";


					echo "<td rowspan='$cant' $clase align='center'>";
							echo "<input name=$codigo type='text' class='caja'  id=$codigo  onKeyPress='return solo_entero(event)' onKeyUp='actualizar_cant_art_stock_inicial(event,$codigo)' onBlur='actualizar_cant_art_stock_inicial_blur($codigo)' size='5' maxlength='5' style='text-align:right'  value='$stock'>";
							//echo $stock.$espacio_izq;     
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
