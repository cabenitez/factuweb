<?
		if($nombre == "TODOS"){
			$pag_consulta = "select cod_grupo, cod_marca, cod_variedad, cod_prod, descripcion,stock_actual from producto group by cod_grupo, cod_marca, cod_variedad, cod_prod order by cod_grupo";
		}else{
			$razon = strtoupper($razon);
			$consulta = "select cod_grupo, cod_marca, cod_variedad, cod_prod, descripcion  from producto";
			$consulta2 = "where";
			include ("cascada_articulos_alta_remito_proceso.php");
			$pag_consulta = $consulta . " " . "group by cod_grupo, cod_marca, cod_variedad, cod_prod order by cod_grupo";
		}
		//echo $pag_consulta;
		//---------------------Paginacion----------------------------------------------------------------------------------------//
		$pag_tamano_extra = 15;
		$estilo_pag_nav = "barra_nav";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para los enlaces de paginación.
		$estilo_pag_actual = "barra_nav_actual";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
		$estilo_pag_info = "caja";			//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
			
		include("paginador.php");			//OBLIGATORIO Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
		//---------------------Fin Paginacion------------------------------------------------------------------------------------//
		if($pag_filas > 0){
			//echo $pag_info;  					//info de paginacion
			//---------------------abre la tabla--------------------------------------------------------------------------------------//
			echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
				echo "<tr class='top'>";
					echo "<td><div align='center' class='seccion'>Codigo</div></td>";
					echo "<td><div align='center' class='seccion'>Descripcion</div></td>";
					echo "<td><div align='center' class='seccion'>Grupo</div></td>";
					echo "<td><div align='center' class='seccion'>Stock</div></td>";
				echo "</tr>";
				$clase="class='filas'"; 							//defino la clase para las filas
		
				while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
						$grupo=$registro[0];
						$marca=$registro[1];
						$variedad=$registro[2];
						$codigo=$registro[3];		
						$desc=$registro[4];
						$stock=$registro[5];
						
						$codigo_art=$grupo.$marca.$variedad.$codigo; //concatena los codigos para formar el codigo del articulo
						?>
						<tr onclick="window.opener.document.getElementById('codigo_art').value=<? echo "'".$codigo_art."'" ?>;window.opener.document.getElementById('busca_pop_up2').click();window.opener.document.getElementById('codigo_art').focus();window.close();return false;"; onMouseOver=color_seleccion(this,"E0E0E0"); onMouseOut=color_defecto(this,"EAEAEA"); bgcolor="#EAEAEA">
						<?	// opener.document.formul.codigo.value=pref
							
							echo "<td style='cursor:pointer' align='center'>";
									echo "<span class='botones'>$codigo_art</span>" ;     
							echo"</td>";
							echo "<td style='cursor:pointer' $clase align='left'>";
									echo $espacio_izq.$desc;     
							echo"</td>";
							echo "<td style='cursor:pointer' $clase align='left'>";
									$consulta = "SELECT descripcion FROM grupo WHERE cod_grupo = $grupo"; // consulta sql
									$result = mysql_query($consulta);            		// hace la consulta
									$registro = mysql_fetch_row($result);        		// toma el registro
									$grupo_desc = $registro[0];
									echo $espacio_izq.$grupo_desc;     
							echo"</td>";
							echo "<td style='cursor:pointer' $clase align='right'>";
									echo $stock.$espacio_izq;     
							echo"</td>";
						echo"</tr>";
				} //end while
				
			echo "</table>";   
			//---------------------cierra tabla--------------------------------------------------------------------------------------//
			echo $pag_navegacion;
		}else{
		echo "<div class='$estilo_pag_info'>NO se han encontrado Registros</div>";
		}	
?>
