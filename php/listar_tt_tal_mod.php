<?
//variables = "cod_tipo_talonario="+codigo_tt+"&cod_talonario="+codigo_t;
if($cod_tipo_talonario){
	include("conexion.php");
	$consulta = "SELECT cod_talonario FROM talonario where cod_talonario = '$cod_tipo_talonario' and num_talonario = $cod_talonario"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_tal= $registro[0];
	
	$consulta = "SELECT * FROM tipo_talonario order by descripcion"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_tt_mod' id='lista_tt_mod' class='caja'  onKeyUp='pasar_foco_tal_1_mod(event,this.value)'>"; 
		do{
				$codigo=$registro[0];
				$nombre=$registro[1];
				if ( $codigo == $cod_tal){
					echo "<option selected value=$codigo>$nombre</option>";
				}else{
					echo "<option value=$codigo>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>