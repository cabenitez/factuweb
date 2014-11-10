<? 
if($codigo){
	include("conexion.php");
	
	$consulta = "SELECT cod_medida FROM producto where cod_prod = $codigo and cod_variedad = $variedad and cod_marca = $marca and cod_grupo = $grupo"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_m= $registro[0];
	
	$consulta = "SELECT * FROM medida order by unidad_de_medida"; // consulta sql  
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_medida_mod' id='lista_medida_mod' class='caja'  onKeyUp='pasar_foco_art_8_mod(event,this.value)'>"; 
		do{
				$cod=$registro[0];
				$nombre=$registro[1];
				if ( $cod == $cod_m){
					echo "<option selected value=$cod>$nombre</option>";
				}else{
					echo "<option value=$cod>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>