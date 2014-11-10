<? 
if($codigo){	
	include("conexion.php");
	$consulta = "SELECT categoria.cod_categoria, descripcion, precio_vta FROM categoria INNER JOIN prod_por_categ ON prod_por_categ.cod_categoria = categoria.cod_categoria WHERE cod_prod = $codigo  and prod_por_categ.cod_variedad = $variedad and prod_por_categ.cod_marca = $marca and prod_por_categ.cod_grupo = $grupo order by descripcion"; // consulta sql                  where nombre = '$nombre'
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		$cont=0;
		echo "<table width='100%'  border='0'cellspacing='1' cellpadding='0'>";
		do{
			$codigo=$registro[0];
			$nombre=$registro[1];
			$precio=number_format($registro[2],2,'.','');
			$cont=$cont+1;
			echo "<tr>";
				$consulta2 = "SELECT utilidad FROM categoria inner join ajuste_precio on ajuste_precio.cod_categoria = categoria.cod_categoria where ajuste_precio.cod_grupo = $grupo and ajuste_precio.cod_categoria = $codigo"; // consulta sql                  where nombre = '$nombre'
				$result2 = mysql_query($consulta2);            // hace la consulta
				$nfilas2 = mysql_num_rows ($result2);          //indica la cantidad de resultados
				$registro2 = mysql_fetch_row($result2);        // toma el registro
				echo"<td width='25%' align='left' valign='bottom'>$nombre: </td>";
				if ($nfilas2 > 0){
						$utilidad=$registro2[0];     						 
						echo"<td align='left' valign='bottom'> <input name='$nombre' id='$codigo' type='text' class='caja' value='$precio' onKeyPress='solo_entero(this)' onKeyUp='pasar_foco_art_17_mod(event,$cont,$nfilas)' title='Margen de Utilidad: $utilidad%' alt='$utilidad' size='12' maxlength='9'> </td>";						
						echo"<td width='75%' align='left' valign='bottom'>";
							echo"<div class='seccion' align='left' id='div_Precio_$codigo' > Margen de Utilidad: $utilidad%</div>";				
						echo"</td>";
					}else{
						echo"<td align='left' valign='bottom'> <input name='$nombre' id='$codigo' type='text' class='caja' value='$precio' onKeyPress='solo_entero(this)' onKeyUp='pasar_foco_art_17_mod(event,$cont,$nfilas)' size='12' maxlength='9'> </td>";
						echo"<td width='75%' align='left' valign='bottom'>";
							echo"<div class='seccion' align='left' id='div_Precio_$codigo' > Manual</div>";				
						echo"</td>";
					}	
			echo "</tr>";
			//echo $registro[1].":                      <input name='$nombre'id='$codigo' type='text' class='caja' value='$precio' onKeyPress='solo_entero(this)' onKeyUp='pasar_foco_art_17_mod(event,$cont,$nfilas)' size='12' maxlength='9'>"."<br>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
		echo"</table>";
	}	
}	
?>