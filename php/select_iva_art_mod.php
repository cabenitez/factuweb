<?
if($codigo){
	include("conexion.php");
	
	$consulta = "SELECT cod_iva FROM producto where cod_prod = $codigo and cod_variedad = $variedad and cod_marca = $marca and cod_grupo = $grupo"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_i= $registro[0];
	
	$consulta = "SELECT * FROM alicuota_iva order by tasa"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_iva_mod' id='lista_iva_mod' class='caja' onKeyUp='pasar_foco_art_16_mod(event)'>"; 
		do{
				$codigo=$registro[0];
				$nombre=$registro[1];
				$tasa=$registro[2];

				if ( $codigo == $cod_i){
					echo "<option selected value=$codigo title='$nombre'>$tasa%</option>";
				}else{
					echo "<option value=$codigo title='$nombre'>$tasa%</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>