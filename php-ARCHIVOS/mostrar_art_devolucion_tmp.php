<?
	session_start();   // Iniciar sesión
	$usuario_dev = $_SESSION['user_usuario']; //usuario conectado

	$pag_consulta = "SELECT * FROM devolucion_detalle_tmp where usuario = '$usuario_dev' ORDER BY linea"; 									// consulta sql
	//---------------------Paginacion----------------------------------------------------------------------------------------//
	$estilo_pag_nav = "barra_nav";					//OPCIONAL Cadena. Contiene el nombre del estilo CSS para los enlaces de paginación.
	$estilo_pag_actual = "barra_nav_actual";		//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	$estilo_pag_info = "caja";						//OPCIONAL Cadena. Contiene el nombre del estilo CSS para la pagina actual.
	$pag_tamano = 100;
	include("paginador.php");			//OBLIGATORIO Incluimos el script de paginación. Éste ya ejecuta la consulta automáticamente
	//---------------------Fin Paginacion------------------------------------------------------------------------------------//
if($pag_filas > 0){
	//echo $pag_info;  					//info de paginacion
	//---------------------abre la tabla--------------------------------------------------------------------------------------//
	echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
      	echo "<tr class='top'>";
        	echo "<td width='10%'><div align='center' class='seccion'>Codigo</div></td>";
        	echo "<td width='67%'><div align='center' class='seccion'>Descripcion</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>Cantidad</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>Precio Unit.</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>Importe</div></td>";
			echo "<td width='7%'><div align='center' class='seccion'>Eliminar</div></td>";
		echo "</tr>";
		$clase="class='filas'"; 							//defino la clase para las filas

		while($registro = mysql_fetch_array($pag_result)){ 	// obtengo los resultados 
				$codigo=$registro[1];		
				$descripcion=$registro[2];
				$precio=$registro[3];
				$cantidad=$registro[4];		
				$fila=$registro[5];

				$importe=$cantidad * $precio; // es para dejar 2 lugares decimales
				
				echo "<tr onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); bgcolor='#EAEAEA'>"; //efecto ded color en las filas
					echo "<td $clase align='center'>";
							echo $codigo;     
					echo"</td>"; 
					echo"<td $clase align='left'>";	
							echo $descripcion;
					echo"</td>"; 
					echo "<td $clase align='center'>";
							?>
							<div onMouseOver=color_seleccion(this,'E0E0E0'); onMouseOut=color_defecto(this,'EAEAEA'); title="Click para Modificar" id="<? echo 'div_'.$fila; ?>" onclick="editar_in_situ(this.id,<? echo $fila; ?>)"> <? echo $cantidad ?> </div>
							<input type='hidden' id='<? echo $fila; ?>' name='<? echo $fila; ?>' onKeyPress='return solo_entero(event)'  onBlur="actualizar_cant_art_devolucion_blur(<? echo $fila; ?>)" onKeyUp='actualizar_cant_art_devolucion(event, <? echo $fila; ?>)' size='5' maxlength='5' class='caja_fila' value='<? echo $cantidad ?>'>     
							<?
					echo"</td>"; 
					echo"<td $clase align='center'>";	
							echo number_format($precio,2,'.','');
					echo"</td>"; 
					echo"<td $clase align='center'>";	
							echo number_format($importe,2,'.','');
					echo"</td>"; 
					echo"<td $clase align='center'>"; 
							?> <img  class='iconos' src='../imagenes/eliminar.png' border='0' title="Eliminar" onClick="javascript: eliminar_art_devolucion_tmp(' <? echo $fila ?>')"> <? 
					echo"</td>"; 		
				echo"</tr>";
				$total_precio=$total_precio+($precio*$cantidad);
				$total_precio=number_format($total_precio,2,'.','');
		} //end while
					//------------CREA LA FILA DE TOTALES-------------------//
					$consulta = "SELECT SUM(cantidad), sum(cantidad * precio) FROM devolucion_detalle_tmp where usuario = '$usuario_dev'"; // consulta sql
					$result = mysql_query($consulta);            // hace la consulta
					$registro = mysql_fetch_row($result);        // toma el registro
					$cant_bulto = $registro[0];		
					$total_importe = number_format($registro[1],2,'.','');
					
					echo"<tr class='totales'>";			
						echo"<td colspan='2' align='left'>&nbsp;&nbsp;TOTALES	</td>";
						echo"<td align='center'>$cant_bulto</td>";
						echo"<td align='left'></td>";
						echo"<td align='center'>$total_importe</td>";
						echo"<td></td>";
					echo"</tr>";
	echo "</table>";   
	//---------------------cierra tabla--------------------------------------------------------------------------------------//
}else{
//echo "<div class='$estilo_pag_info'>NO se han encontrado Registros</div>";
}	
?>
