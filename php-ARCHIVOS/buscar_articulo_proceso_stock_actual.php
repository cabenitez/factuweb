<?
		if($nombre == "TODOS"){
			$pag_consulta = "select producto.cod_prod, producto.cod_variedad, producto.cod_marca, producto.cod_grupo, producto.descripcion, stock_actual, stock_min, stock_max, producto.cod_proveedor, activo from producto inner join proveedor on proveedor.cod_proveedor= producto.cod_proveedor order by   producto.cod_grupo,producto.cod_marca,producto.cod_variedad,producto.cod_prod"; // producto.cod_proveedor,
		
		}else{
			$desc = strtoupper($desc);
			$consulta = "select producto.cod_prod, producto.cod_variedad, producto.cod_marca, producto.cod_grupo, producto.descripcion, stock_actual, stock_min, stock_max, producto.cod_proveedor, activo from producto inner join proveedor on proveedor.cod_proveedor= producto.cod_proveedor";
     		$consulta2 = "where";
			include ("cascada_articulos.php");
	 		
			$pag_consulta = $consulta . " " . "order by  producto.cod_grupo,producto.cod_marca,producto.cod_variedad,producto.cod_prod"; //producto.cod_proveedor,
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
        	echo "<td width='7%' ><div align='center' class='seccion'>Codigo</div></td>";
        	echo "<td width='56%' ><div align='center' class='seccion'>Descripcion</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>Stock Actual</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>Stock M&iacute;nimo</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>Stock M&aacute;ximo</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>Estado</div></td>";			
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas
		
		echo"<div ID='overDiv' STYLE='position:absolute; visibility:hide; z-index: 1;'>";   // Capa para el detalle tipo tooltip
		$i = 0;
		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				
				$codigo=$registro[0];
				$cod_variedad = $registro[1];				
				$cod_marca = $registro[2];				
				$cod_grupo = $registro[3];
				$desc=$registro[4];
				$stock=$registro[5];
				$stock_min=$registro[6];
				$stock_max=$registro[7];
				$cod_proveedor=$registro[8];
				$activo=$registro[9];
				
				/*
				$consulta_prov ="select razon_social from proveedor where cod_proveedor = $cod_proveedor";
				$result_prov = mysql_query($consulta_prov);            // hace la consulta
				$reg_prov = mysql_fetch_row($result_prov);
				*/
				
				
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td rowspan='$cant' $clase align='left'>";
							echo $espacio_izq.$cod_grupo.$cod_marca.$cod_variedad.$codigo;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$desc;     
					echo"</td>";
					
					echo "<td $clase align='right'>";
							echo $stock.$espacio_izq;     
					echo"</td>";
					
					echo "<td $clase align='right'>";
							echo $stock_min.$espacio_izq;     
					echo"</td>";

					echo "<td $clase align='right'>";
							echo $stock_max.$espacio_izq;     
					echo"</td>";
					echo "<td rowspan='$cant' $clase align='center'>";
						$codigo_articulo = $cod_grupo.$cod_marca.$cod_variedad.$codigo;
						if($activo == 'S'){
							?>
							 <img  id="<? echo 'id'.$codigo_articulo ?>" name="N" src="../imagenes/activo.gif"> 
							<?
						}else{
							?>
							 <img id="<? echo 'id'.$codigo_articulo ?>"  name="S" src="../imagenes/activo_no.gif"> 
							<?
						}
					echo"</td>";

				echo"</tr>";
		} //end while
		
	echo "</table>";   
	//---------------------cierra tabla--------------------------------------------------------------------------------------//
	echo $pag_navegacion;
	
	//================================ OBTIENE LA CONSULTA PARA IMPRIMIR ==================================================================================//				
	 $posicion_order = strrpos ($pag_consulta, "order by"); 		
	 $consulta_order = substr($pag_consulta, 0,$posicion_order); 		// obtiene solo la info de la impresora
	 
	 $posicion_where = strrpos ($pag_consulta, "where");
	 if($posicion_where > 0){
	 	$palabra = ' and ';
	 }else{
		 $palabra = ' where ';
	 }
	 
	 $consulta_informe = $consulta_order .$palabra." activo = 'S' order by  producto.cod_proveedor, producto.cod_grupo,producto.cod_marca,producto.cod_variedad,producto.cod_prod";
	 $consulta_informe = ereg_replace("'","@@",$consulta_informe);
	
	//$posicion_limit = strrpos ($pag_consulta, "limit"); 		 
	//$consulta_informe = substr($pag_consulta, 0,$posicion_limit); 		// obtiene solo la info de la impresora
	//$consulta_informe = ereg_replace("'","@@",$consulta_informe);
	
	include('consulta_session.php');		// crea el div y el id de session del sql
	//================================ FIN DE OBTIENE LA CONSULTA PARA IMPRIMIR ===========================================================================//				

	
}else{
echo "<div class='$estilo_pag_info'>NO se han encontrado Registros</div>";
}	
?>
