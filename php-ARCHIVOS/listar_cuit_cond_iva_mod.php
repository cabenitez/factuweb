<?
if($codigo){
	include("conexion.php");
	$consulta = "SELECT * FROM iva where cod_iva = '$codigo'"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cuit = $registro[3];
	echo"<select name='req_cuit_mod' id='req_cuit_mod' class='caja'  onKeyUp='pasar_foco_cond_iva_5a(event)'>"; 
		do{
				if ( $cuit == 'S'){
					echo "<option value='N'>NO</option>";
					echo "<option selected value='S'>SI</option>";
				}else{
					echo "<option selected value='N'>NO</option>";
					echo "<option value='S'>SI</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>