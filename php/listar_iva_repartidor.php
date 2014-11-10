<?
if($cod_repartidor){
	include("conexion.php");
	
		$consulta = "SELECT cod_iva FROM fletero where cod_flero = $cod_repartidor"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_iva= $registro[0];
	
	$consulta = "select * from iva order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_iva_mod' id='lista_iva_mod' class='caja'  onKeyUp='pasar_foco_rep_11_mod(event)'>";
		do{
				$codigo=$registro[0];
				$nombre=$registro[2];
				$cuit=$registro[3];
				if ( $codigo == $cod_iva){
					echo "<option selected value=$codigo id=$cuit>$nombre</option>";
				}else{
					echo "<option value=$codigo id=$cuit>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>