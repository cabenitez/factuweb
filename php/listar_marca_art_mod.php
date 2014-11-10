<?
if($codigo){
	include("conexion.php");
	
	$consulta = "SELECT cod_marca FROM producto where cod_prod = $codigo and cod_variedad = $variedad and cod_marca = $marca and cod_grupo = $grupo"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_m= $registro[0];
	
	$consulta = "SELECT * FROM marca order by cod_marca"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_marca_mod' id='lista_marca_mod' class='caja'  onKeyUp='pasar_foco_grupo_6(event,this.value)'>"; 
		do{
				$cod=$registro[0];
				$nombre=$registro[2];
				if ( $cod == $cod_m){
					echo "<option selected value=$cod title='$nombre'>$cod</option>";
				}else{
					echo "<option value=$cod title='$nombre'>$cod</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>