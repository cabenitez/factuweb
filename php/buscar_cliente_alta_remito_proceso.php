<?
		if($nombre == "TODOS"){
			$pag_consulta = "SELECT * FROM cliente where activo = 'S' order by cod_cliente"; 									// consulta sql
		}else{
			$razon = strtoupper($razon);
			$consulta = "Select * from cliente";
			$consulta2 = "where activo = 'S' and";
			include ("cascada_clientes_alta_remito_proceso.php");
			$pag_consulta = $consulta . " " . "order by cod_cliente";
		}
		//---------------------Paginacion----------------------------------------------------------------------------------------//
		$pag_tamano_extra = 10;
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
					echo "<td><div align='center' class='seccion'>Razon Social</div></td>";
					echo "<td><div align='center' class='seccion'>Direcci&oacute;n</div></td>";
					echo "<td><div align='center' class='seccion'>Localidad</div></td>";
				echo "</tr>";
				$clase="class='filas'"; 							//defino la clase para las filas
		
				while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
						$codigo=$registro[0];		
						$razon=$registro[6];
						$cod_localidad=$registro[2];
						$direccion=$registro[10];
						
						$consulta ="select * from localidad where cod_localidad = $cod_localidad";
						$result = mysql_query($consulta);            // hace la consulta
						$reg = mysql_fetch_row($result);        	// toma el registro
						$localidad= $reg[3];
						
						?>
						<tr onclick="window.opener.document.getElementById('codigo').value=<? echo "'".$codigo."'" ?>;window.opener.document.getElementById('busca_pop_up').click();window.opener.document.getElementById('codigo').focus();window.close();return false;"; onMouseOver=color_seleccion(this,"E0E0E0"); onMouseOut=color_defecto(this,"EAEAEA"); bgcolor="#EAEAEA">
						<?	
							echo "<td style='cursor:pointer' align='center'>";
									echo "<span class='botones'>$codigo</span>" ;     
							echo"</td>";
							echo "<td style='cursor:pointer' $clase align='left'>";
									echo $espacio_izq.$razon;     
							echo"</td>";
							echo "<td style='cursor:pointer' $clase align='left'>";
									echo $espacio_izq.$direccion;     
							echo"</td>";
							echo "<td style='cursor:pointer' $clase align='left'>";
									echo $espacio_izq.$localidad;     
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
