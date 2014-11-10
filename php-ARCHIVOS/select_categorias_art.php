<? 
	include("conexion.php");
	$codigo_grupo = $_POST['codigo_grupo'];
	if (!empty($codigo_grupo)){
			$consulta = "SELECT * FROM categoria order by descripcion"; // consulta sql                  where nombre = '$nombre'
			$result = mysql_query($consulta);            // hace la consulta
			$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
			$registro = mysql_fetch_row($result);        // toma el registro
			if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
				$cont=0;
				echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
				do{
					$codigo=$registro[0];
					$nombre=$registro[1];
					$cont=$cont+1;
					echo "<tr>";

						$consulta2 = "SELECT utilidad FROM categoria inner join ajuste_precio on ajuste_precio.cod_categoria = categoria.cod_categoria where ajuste_precio.cod_grupo = $codigo_grupo and ajuste_precio.cod_categoria = $codigo"; // consulta sql                  where nombre = '$nombre'
						$result2 = mysql_query($consulta2);            // hace la consulta
						$nfilas2 = mysql_num_rows ($result2);          //indica la cantidad de resultados
						$registro2 = mysql_fetch_row($result2);        // toma el registro
						if ($nfilas2 > 0){
								$utilidad=$registro2[0];     						 
								echo"<td width='25%' align='left' valign='bottom'>$nombre: </td>";
								echo"<td  align='left' valign='bottom'><input name='$nombre'id='$codigo' type='text' class='caja'  onKeyPress='return solo_entero(event)' onKeyUp='pasar_foco_art_17(event,$cont,$nfilas)' size='12' maxlength='9' title='Margen de Utilidad: $utilidad%' alt='$utilidad'></td>"; //readonly='true'
								echo"<td width='75%' align='left' valign='bottom'>";
									echo"<div class='seccion' align='left' id='div_Precio_$codigo' > Margen de Utilidad: $utilidad%</div>";				
								echo"</td>";
							}else{
								echo"<td width='25%' align='left' valign='bottom'>$nombre: </td>";
								echo"<td  align='left' valign='bottom'><input name='$nombre'id='$codigo' type='text' class='caja'  onKeyPress='return solo_entero(event)' onKeyUp='pasar_foco_art_17(event,$cont,$nfilas)' size='12' maxlength='9'></td>";
								echo"<td width='75%' align='left' valign='bottom'>";
									echo"<div class='seccion' align='left' id='div_Precio_$codigo' > Manual</div>";				
								echo"</td>";
							}	
					echo "</tr>";
				}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
				echo"</table>";
			}	
	}else{
			$consulta = "SELECT * FROM categoria order by descripcion"; // consulta sql                  where nombre = '$nombre'
			$result = mysql_query($consulta);            // hace la consulta
			$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
			$registro = mysql_fetch_row($result);        // toma el registro
			if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
				$cont=0;
				echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
				do{
					$codigo=$registro[0];
					$nombre=$registro[1];
					$cont=$cont+1;
					echo "<tr>";
						echo"<td width='25%' align='left' valign='bottom'>$registro[1]: </td>";
						echo"<td align='left' valign='bottom'><input name='$nombre'id='$codigo' type='text' class='caja'  onKeyPress='return solo_entero(event)' onKeyUp='pasar_foco_art_17(event,$cont,$nfilas)' size='12' maxlength='9'></td>";
						echo"<td width='75%' align='left' valign='bottom'></td>";
					echo "</tr>";
				}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
				echo"</table>";
			}	
	}
?>