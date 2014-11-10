<?
		if($nombre == "TODOS"){
			$pag_consulta = "select producto.cod_prod, producto.cod_variedad, producto.cod_marca, producto.cod_grupo,producto.descripcion,precio_costo, envase, stock_actual, stock_min, stock_max, producto.cod_proveedor, cod_medida, porc_vta, porc_transporte, unidad_bulto, peso, activo, razon_social, producto.cod_iva from grupo inner join (marca inner join (variedad inner join (producto inner join proveedor on proveedor.cod_proveedor= producto.cod_proveedor) on producto.cod_variedad= variedad.cod_variedad) on variedad.cod_marca=marca.cod_marca) on marca.cod_grupo = grupo.cod_grupo group by producto.descripcion,producto.cod_prod,producto.cod_variedad,producto.cod_marca,producto.cod_grupo order by   producto.cod_grupo,producto.cod_marca,producto.cod_variedad,producto.cod_prod"; // producto.cod_proveedor,
		
		}else{
			$desc = strtoupper($desc);
			$consulta = "select producto.cod_prod, producto.cod_variedad, producto.cod_marca, producto.cod_grupo,producto.descripcion,precio_costo, envase, stock_actual, stock_min, stock_max, producto.cod_proveedor, cod_medida, porc_vta, porc_transporte, unidad_bulto, peso, activo, razon_social, producto.cod_iva from grupo inner join (marca inner join (variedad inner join (producto inner join proveedor on proveedor.cod_proveedor= producto.cod_proveedor) on producto.cod_variedad= variedad.cod_variedad) on variedad.cod_marca=marca.cod_marca) on marca.cod_grupo = grupo.cod_grupo";
     		$consulta2 = "where";
			include ("cascada_articulos.php");
	 		
			$pag_consulta = $consulta . " " . "group by producto.descripcion,producto.cod_prod,producto.cod_variedad,producto.cod_marca,producto.cod_grupo order by  producto.cod_grupo,producto.cod_marca,producto.cod_variedad,producto.cod_prod"; //producto.cod_proveedor,
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
        	echo "<td width='50%' ><div align='center' class='seccion'>Descripcion</div></td>";
			//echo "<td width='7%' ><div align='center' class='seccion'>Stock</div></td>";
			echo "<td width='7%' ><div align='center' class='seccion'>Precio Costo</div></td>";
			//echo "<td width='6%' ><div align='center' class='seccion'>Com. Vta.</div></td>";
        	//echo "<td width='6%' ><div align='center' class='seccion'>Com. Transp.</div></td>";
			echo "<td width='5%' ><div align='center' class='seccion'>IVA</div></td>";
			echo "<td width='10%' ><div align='center' class='seccion'>Categoria</div></td>";
			echo "<td width='7%' ><div align='center' class='seccion'>Precio Neto</div></td>";
			echo "<td width='7%' ><div align='center' class='seccion'>Precio Final</div></td>";
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
				$precio_costo=$registro[5];	
				$envase=$registro[6];	
				$stock=$registro[7];
				$stock_min=$registro[8];
				$stock_max=$registro[9];
				$cod_proveedor=$registro[10];
				$medida=$registro[11];
				$com_vta=$registro[12];
				$com_tran=$registro[13];
				$unidad_bulto=$registro[14];
				$peso=$registro[14];
				$activo=$registro[16];
				$nombre_proveedor=$registro[17];
				$prod_cod_iva=$registro[18];
				
				$precio_costo= number_format($precio_costo,2,'.','');
				/*
				$consulta_prov ="select razon_social from proveedor where cod_proveedor = $cod_proveedor";
				$result_prov = mysql_query($consulta_prov);            // hace la consulta
				$reg_prov = mysql_fetch_row($result_prov);
				*/
				$consulta_iva_p ="select nombre, tasa from alicuota_iva where cod_iva = $prod_cod_iva";
				$result_iva_p = mysql_query($consulta_iva_p);            // hace la consulta
				$reg_iva_p = mysql_fetch_row($result_iva_p);
				$nombre_iva_p = $reg_iva_p[0];
				$tasa_iva_p = $reg_iva_p[1];
				
				$consulta= "select cod_categoria from prod_por_categ where cod_prod = $codigo and prod_por_categ.cod_grupo = $cod_grupo and prod_por_categ.cod_marca = $cod_marca and prod_por_categ.cod_variedad = $cod_variedad";
				//echo $consulta;
				$result = mysql_query($consulta);            // hace la consulta
				$cant = mysql_num_rows($result);        	 // toma el registro
				$i++;
				
				echo "<tr id='fila_$i' onMouseOver=color_seleccion_hijo('E0E0E0',$i,$cant); onMouseOut=color_defecto_hijo('EAEAEA',$i,$cant); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td rowspan='$cant' $clase align='left'>";
							echo $espacio_izq.$cod_grupo.$cod_marca.$cod_variedad.$codigo;     
					echo"</td>";
					echo "<td rowspan='$cant' $clase align='left'>";
							echo $espacio_izq.$desc;     
					echo"</td>";
					/*
					echo "<td rowspan='$cant' $clase align='right'>";
							echo $stock.$espacio_izq;     
					echo"</td>";
					*/
					echo "<td rowspan='$cant' $clase align='right'>";
							echo $precio_costo.$espacio_izq;     
					echo"</td>";
					
					/*
					echo "<td rowspan='$cant' $clase align='right'>";
							echo $stock.$espacio_izq;     
					echo"</td>";
					echo "<td rowspan='$cant' $clase align='center'>";
							echo $com_vta;     
					echo"</td>";
					
					echo "<td rowspan='$cant' $clase align='center'>";
							echo $com_tran;     
					echo"</td>";
					*/
					echo "<td rowspan='$cant' $clase align='center'>";
							echo $tasa_iva_p."%";
					echo"</td>";

					$consulta2 ="select categoria.descripcion, prod_por_categ.precio_vta from categoria inner join prod_por_categ on prod_por_categ.cod_categoria = categoria.cod_categoria where cod_prod = $codigo and prod_por_categ.cod_grupo = $cod_grupo and prod_por_categ.cod_marca = $cod_marca and prod_por_categ.cod_variedad = $cod_variedad ORDER BY categoria.descripcion";
					$result2 = mysql_query($consulta2);            // hace la consulta
					$reg2 = mysql_fetch_row($result2);
					$categoria= $reg2[0];
					$precio_categoria= $reg2[1];
					
					echo "<td $clase align='left'>";
							echo $espacio_izq.$categoria;     
					echo"</td>";
					
					echo "<td $clase align='right'>";
							echo number_format($precio_categoria,2,'.','').$espacio_izq;     
					echo"</td>";
					echo "<td $clase align='right'>";
							echo number_format($precio_categoria + ($precio_categoria * $tasa_iva_p / 100),2,'.','').$espacio_izq;     
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
					//--------------------------------------------------------//						
					
					$consulta ="select categoria.descripcion, prod_por_categ.precio_vta from categoria inner join prod_por_categ on prod_por_categ.cod_categoria = categoria.cod_categoria where cod_prod = $codigo and prod_por_categ.cod_grupo = $cod_grupo and prod_por_categ.cod_marca = $cod_marca and prod_por_categ.cod_variedad = $cod_variedad ORDER BY categoria.descripcion LIMIT 1,$cant";
					//echo $consulta;
					$result = mysql_query($consulta);            // hace la consulta
				    
					while($regi = mysql_fetch_array($result)){ 	 // obtengo los resultados 
							$categoria2= $regi[0];
							$precio_categoria2= number_format($regi[1],2,'.','');
							$i++;
						echo"<tr id= 'fila_$i' bgcolor='#EAEAEA'>";
							echo "<td $clase align='left'>"; 
									echo $espacio_izq.$categoria2;     
							echo"</td>";
							echo "<td $clase align='right'>";
									echo $precio_categoria2.$espacio_izq;;     
							echo"</td>";
							echo "<td $clase align='right'>";
									echo number_format($precio_categoria2 + ($precio_categoria2 * $tasa_iva_p / 100),2,'.','').$espacio_izq;     
							echo"</td>";

						echo"</tr>";
					} //end while 
		} //end while
		
	echo "</table>";   
	//---------------------cierra tabla--------------------------------------------------------------------------------------//
	echo $pag_navegacion;
	
	//================================ OBTIENE LA CONSULTA PARA IMPRIMIR ==================================================================================//				
	 $posicion_order = strrpos ($pag_consulta, "group by"); 		
	 $consulta_order = substr($pag_consulta, 0,$posicion_order); 		// obtiene solo la info de la impresora
	 
	 $posicion_where = strrpos ($pag_consulta, "where");
	 if($posicion_where > 0){
	 	$palabra = ' and ';
	 }else{
		 $palabra = ' where ';
	 }
	 
	 $consulta_informe = $consulta_order .$palabra." activo = 'S' group by producto.descripcion,producto.cod_prod,producto.cod_variedad,producto.cod_marca,producto.cod_grupo 
	 															  order by  producto.cod_grupo,producto.cod_marca,producto.cod_variedad,producto.cod_prod"; //producto.cod_proveedor, 
	 $consulta_informe = ereg_replace("'","@@",$consulta_informe);
	
	include('consulta_session.php');		// crea el div y el id de session del sql
	//================================ FIN DE OBTIENE LA CONSULTA PARA IMPRIMIR ===========================================================================//				

	
}else{
echo "<div class='$estilo_pag_info'>NO se han encontrado Registros</div>";
}	
?>
