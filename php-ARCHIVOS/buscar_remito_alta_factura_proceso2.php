<?

		//-----------------------------------REMITOS A CLIENTES NO REGISTRADOS---------------------------------------------------------//
		//-----------------------------------------------------------------------------------------------------------------------------//
		if($nombre == "TODOS"){
			$pag_consulta = "SELECT * FROM remito_vta_no_cliente where pendiente = 'S' order by num_remito";
		}else{
			//$razon = strtoupper($razon);
			$consulta = "SELECT * FROM remito_vta_no_cliente";
			$consulta2 = "where pendiente = 'S' and";
			include ("cascada_remitos_alta_fact_proceso2.php");
			$pag_consulta = $consulta . " " . "order by num_remito";
		}
		//echo $pag_consulta;
		//---------------------Paginacion----------------------------------------------------------------------------------------//
		$pag_tamano_extra = 7;
		$estilo_pag_nav = "barra_nav";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para los enlaces de paginación.
		$estilo_pag_actual = "barra_nav_actual";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
		$estilo_pag_info = "caja";			//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
			
		include("paginador2.php");			//OBLIGATORIO Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
		//---------------------Fin Paginacion------------------------------------------------------------------------------------//
		echo "<div align='left'class='select_1'> Clientes NO Registrados </div>";

		if($pag_filas > 0){
			//echo $pag_info;  					//info de paginacion
			//---------------------abre la tabla--------------------------------------------------------------------------------------//
			
			//echo "<div align='left'class='select_1'> Clientes NO Registrados </div>";
			echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
				echo "<tr class='top'>";
					echo "<td width='10%'><div align='center' class='seccion'>Remito</div></td>";
					echo "<td width='15%'><div align='center' class='seccion'>Fecha</div></td>";
					echo "<td width='40%'><div align='center' class='seccion'>Cliente</div></td>";
					echo "<td width='25%'><div align='center' class='seccion'>Localidad</div></td>";
					
				echo "</tr>";
				$clase="class='filas'"; 							//defino la clase para las filas
		
				while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
						$codigo=$registro[0];		
						$razon=$registro[6];
						$localidad=$registro[8];
						
						$fecha=$registro[1];
						if (strlen($fecha) == 8){
							$ano=substr($fecha,0,4);
							$mes=substr($fecha,4,2);
							$dia=substr($fecha,-2);
						}						
						$fecha=$dia."/".$mes."/".$ano;

						// Completo con ceros para mostrar **********************************************
						$len_num_remito=strlen($codigo); // completo el numero del remito con ceros
						$ceros="";
						while ($len_num_remito < 8){
							$ceros.="0";
							$len_num_remito++;
						}
						$codigo=$ceros.$codigo;
						/*
						$len_num_sucursal=strlen($num_sucursal); // completo el numero de la sucursal con ceros
						while ($len_num_sucursal < 4){
							$ceros_2.="0";
							$len_num_sucursal++;
						}
						$num_sucursal=$ceros_2.$num_sucursal;
						// FIN de Completo con ceros para mostrar ******************************************
						*/
							
						?>
						 <tr onclick="window.opener.document.getElementById('remito').value=<? echo "'".$codigo."'" ?>;window.opener.document.getElementById('busca_pop_up3').click();window.opener.document.getElementById('remito').focus();window.close();return false;"; onMouseOver=color_seleccion(this,"E0E0E0"); onMouseOut=color_defecto(this,"EAEAEA"); bgcolor="#EAEAEA"> 
						
						<!-- <tr onclick="window.parent.document.getElementById('remito').value=<? // echo "'".$codigo."'" ?>;window.parent.document.getElementById('busca_pop_up3').click();window.parent.document.getElementById('remito').focus();window.document.close();return false;"; onMouseOver=color_seleccion(this,"E0E0E0"); onMouseOut=color_defecto(this,"EAEAEA"); bgcolor="#EAEAEA">	-->					
						<?	
							echo "<td style='cursor:pointer' align='center'>";
									echo "<span class='botones'>$codigo</span>" ;     
							echo"</td>";
							echo "<td style='cursor:pointer' $clase align='center'>";
									echo $fecha;     
							echo"</td>";
							echo "<td style='cursor:pointer' $clase align='left'>";
									echo "&nbsp;&nbsp;".$razon;     
							echo"</td>";
							echo "<td style='cursor:pointer' $clase align='left'>";
									echo "&nbsp;&nbsp;".$localidad;     
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