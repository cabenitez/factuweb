<?
session_start();   // Iniciar sesión

$usuario_no_borrar= $_SESSION['user_usuario'];

		if($nombre == "TODOS"){
			$pag_consulta = "SELECT * FROM usuario where activo = 'S'order by nombre"; 									// consulta sql
		}
	//---------------------Paginacion----------------------------------------------------------------------------------------//
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
        	echo "<td  class = 'content' align='left'>";
						echo "ACTIVOS";     
			echo"</td>";
		echo "</tr>";

		echo "<tr class='top'>";
        	echo "<td width='10%'><div align='center' class='seccion'>Usuario</div></td>";
        	echo "<td width='65%'><div align='center' class='seccion'>Nombre</div></td>";
			echo "<td width='5%'><div align='center' class='seccion' >Permisos</div></td>";
			echo "<td width='1%'><div align='center' class='seccion' >Modificar</div></td>";
			echo "<td width='5%'><div align='center' class='seccion'>Eliminar</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas

		echo"<div ID='overDiv' STYLE='position:absolute; visibility:hide; z-index: 1;'>";   // Capa para el detalle tipo tooltip
		
		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$codigo=$registro[0];		
				$usuario_sis=$registro[1];
				$clave_sis=$registro[2];
				$nombre_sis=$registro[3];
				// ======================= Permisos ======================= //
				$abm_zonas_geo=$registro[4];
				$abm_alicuotas=$registro[5];
				$abm_comprobante=$registro[6];
				$abm_cond_iva=$registro[7];
				$abm_talonario=$registro[8];
				$abm_proveedor=$registro[9];
				$abm_vehiculo=$registro[10];	
				$abm_repartidor=$registro[11];	
				$abm_vendedor=$registro[12];		
				$abm_categoria=$registro[13];		
				$abm_forma_pago=$registro[14];		
				$abm_cliente=$registro[15];		
				$abm_articulo=$registro[16];
				$datos_empresa=$registro[17];
				$conf_listados=$registro[18];				
				$abm_usuarios=$registro[19];
				$stock=$registro[20];
				$factura_compra=$registro[21];				
				$remito_vta=$registro[22];
				$factura_vta=$registro[23];		
				$nota_credito=$registro[24];
				$cta_cte=$registro[25];
				$comisiones=$registro[26];
				$devoluciones=$registro[27];				
				$finalizar_carga=$registro[28];
				$informes=$registro[29];
				$estadisticas=$registro[30];				
				$utilidades=$registro[31];
				$estado=$registro[32];
				
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='left'>";
							echo $espacio_izq.$usuario_sis;     
					echo"</td>";
					echo "<td $clase align='left'>";
							echo $espacio_izq.$nombre_sis;     
					echo"</td>";
					
					echo "<td  $clase align='center'>";
							if($abm_zonas_geo == 'S'){
								$detelle_tooltip = "ABM Zonas geogr&aacute;ficas<br>";
							}
							if($abm_alicuotas == 'S'){
								$detelle_tooltip .= "ABM Al&iacute;cuotas<br>";
							}
							if($abm_comprobante == 'S'){
								$detelle_tooltip .= "AM Comprobantes<br>";
							}
							if($abm_cond_iva == 'S'){
								$detelle_tooltip .= "AM Condici&oacute;n de IVA<br>";
							}
							if($abm_talonario == 'S'){
								$detelle_tooltip .= "AM Talonarios<br>";
							}
							if($abm_proveedor == 'S'){
								$detelle_tooltip .= "AM Proveedores<br>";
							}
							if($abm_vehiculo == 'S'){
								$detelle_tooltip .= "AM Veh&iacute;culos<br>";
							}
							if($abm_repartidor == 'S'){
								$detelle_tooltip .= "AM Repartidores<br>";
							}
							if($abm_vendedor == 'S'){
								$detelle_tooltip .= "AM Vendedores<br>";
							}
							if($abm_categoria == 'S'){
								$detelle_tooltip .= "ABM Categor&iacute;as<br>";
							}
							if($abm_forma_pago == 'S'){
								$detelle_tooltip .= "AM Formas de pago<br>";
							}
							if($abm_cliente == 'S'){
								$detelle_tooltip .= "AM Clientes<br>";
							}
							if($abm_articulo == 'S'){
								$detelle_tooltip .= "AM Art&iacute;culos<br>";
							}
							if($datos_empresa == 'S'){
								$detelle_tooltip .= "AM Datos de Empresa<br>";
							}
							if($conf_listados == 'S'){
								$detelle_tooltip .= "Configurar Listados<br>";
							}
							if($abm_usuarios == 'S'){
								$detelle_tooltip .= "ABM Usuarios<br>";
							}
							if($stock == 'S'){
								$detelle_tooltip .= "Ingreso Stock<br>";
							}
							if($factura_compra == 'S'){
								$detelle_tooltip .= "Facturas Compra<br>";
							}
							if($remito_vta == 'S'){
								$detelle_tooltip .= "Remitos Venta<br>";
							}
							if($factura_vta == 'S'){
								$detelle_tooltip .= "Facturas Venta<br>";
							}
							if($nota_credito == 'S'){
								$detelle_tooltip .= "Notas de Cr&eacute;dito<br>";
							}
							if($cta_cte == 'S'){
								$detelle_tooltip .= "Cuenta Corriente<br>"; 
							}
							if($comisiones == 'S'){
								$detelle_tooltip .= "Comisiones<br>";
							}
							if($devoluciones == 'S'){
								$detelle_tooltip .= "Devoluciones<br>";
							}
							if($finalizar_carga == 'S'){
								$detelle_tooltip .= "Finalizar Cargas<br>";
							}
							if($informes == 'S'){
								$detelle_tooltip .= "Informes<br>";
							}
							if($estadisticas == 'S'){
								$detelle_tooltip .= "Estad&iacute;sticas <br>";
							}
							if($utilidades == 'S'){
								$detelle_tooltip .= "Utilidades<br>";
							}

							?>
							 <img src="../imagenes/ver_cliente.gif"  class='iconos' onmouseover="dlc(' <? echo $detelle_tooltip  ?> ', ' <? echo 'PERMISOS PARA: '.$usuario_sis ?> '); return true;" onmouseout="nd(); return true;"> 
							<?
							$detelle_tooltip = ""; 
							
							//echo "&nbsp;&nbsp;&nbsp;&nbsp;<img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' onClick='javascript: modificar_usuario($codigo)'>"; 

					echo"</td>";
					
					echo"<td $clase align='center'>";	
							echo "<img  class='iconos' src='../imagenes/modificar.png' border='0' title='Modificar' onClick='javascript: modificar_usuario($codigo)'>"; 
					echo"</td>";  
					
					echo"<td $clase align='center'>";
								if($usuario_no_borrar == $usuario_sis){ 
									echo "<img  src='../imagenes/eliminar_no.png' border='0'>";
								}else{
									echo "<img  class='iconos' src='../imagenes/eliminar.png' border='0' title='Eliminar' onClick='javascript: eliminar_usuario($codigo)'>"; 
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

include("buscar_usuarios_eliminados.php");			//OBLIGATORIO Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente

?>
