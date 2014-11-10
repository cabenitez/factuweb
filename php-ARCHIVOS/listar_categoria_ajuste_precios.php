<? 
	$id_grupo= $_POST['id_grupo'];
	
	include("conexion.php");
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
				echo"<td width='40%' align='left' valign='bottom'>$nombre: </td>";
				echo"<td align='left' valign='bottom'>";
						
						$consulta2 = "SELECT utilidad FROM ajuste_precio where cod_grupo = $id_grupo and cod_categoria = $codigo and utilidad <> ''"; // consulta sql                  where nombre = '$nombre'
						$result2 = mysql_query($consulta2);            // hace la consulta
						$registro2 = mysql_fetch_row($result2);        // toma el registro
						$nfilas2 = mysql_num_rows ($result2);          //indica la cantidad de resultados
						if($nfilas2 > 0){
							$utilidad = $registro2[0];
							echo"<input name='$codigo' id='radio1_$codigo' type='radio' value='manual' onClick='habilitarDeshabilitar(\"caja_$codigo\",true)'> Manual".$espacio_izq.$espacio_izq;
							echo"<input name='$codigo' id='radio2_$codigo' type='radio' value='utilidad' onClick='habilitarDeshabilitar(\"caja_$codigo\",false)' checked > Margen de Utilidad <input name='caja_$nombre'id='caja_$codigo' type='text' value ='$utilidad' class='caja'  onKeyPress='return solo_entero(event)'  size='5' maxlength='5'>%".$espacio_izq;;
						}else{
							echo"<input name='$codigo' id='radio1_$codigo' type='radio' value='manual'   onClick='habilitarDeshabilitar(\"caja_$codigo\",true)' checked> Manual".$espacio_izq.$espacio_izq;
							echo"<input name='$codigo' id='radio2_$codigo' type='radio' value='utilidad' onClick='habilitarDeshabilitar(\"caja_$codigo\",false)'> Margen de Utilidad <input name='caja_$nombre' id='caja_$codigo' type='text' class='caja'  onKeyPress='return solo_entero(event)' size='5' maxlength='5' disabled>%".$espacio_izq;;						
						}
						echo"<input name='enviar_$codigo' type='button' class='botones' id='enviar_$codigo' onclick='registrar_ajuste_precio($id_grupo,$codigo,\"radio1_$codigo\",\"radio2_$codigo\",\"caja_$codigo\",this.id)' value='Actualizar'>";
						
				echo"</td>";
			echo "</tr>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
		echo"</table>";
	}	
?>