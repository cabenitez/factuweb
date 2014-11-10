<?
if($cod_loca){
	include("conexion.php");
	$consulta = "SELECT * FROM localidad where cod_localidad = '$cod_loca'"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_prov=$registro[1];
	
	$consulta = "SELECT nombre FROM provincia where cod_prov = '$cod_prov'"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nombre_prov=$registro[0];
	
	$consulta = "SELECT nombre FROM provincia order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_prov' id='lista_prov' class='caja' onKeyUp='pasar_foco_loca_mod_lista(event)' >";
		do{
				$nombre=$registro[0];
				if ( $nombre == $nombre_prov){
					echo "<option selected value=$nombre>$nombre</option>";
				}else{
					echo "<option value=$nombre>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>