<?
if($cod_repartidor){
	include("conexion.php");
	
	$consulta = "SELECT cod_vehiculo FROM fletero_por_vehiculo where cod_flero = $cod_repartidor"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_vehiculo= $registro[0];
	
	$consulta = "SELECT * FROM vehiculo order by cod_vehiculo"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_vehi_mod' id='lista_vehi_mod' class='caja'  onKeyUp='pasar_foco_rep_12_mod(event)'>";
		do{
				$codigo=$registro[0];
				$marca=$registro[3];
				$modelo=$registro[4];
				if ( $codigo == $cod_vehiculo){
					echo "<option selected value=$codigo title='$marca - $modelo'>$codigo</option>";
				}else{
					echo "<option value=$codigo title='$marca - $modelo'>$codigo</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>
