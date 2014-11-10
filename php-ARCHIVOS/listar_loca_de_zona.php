<?
if($cod_zona){
	include("conexion.php");
	$consulta = "SELECT * FROM zona where cod_zona = $cod_zona"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_loca=$registro[1];
	
	$consulta = "SELECT nombre FROM localidad where cod_localidad = $cod_loca"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nombre_loca=$registro[0];
	
	$consulta = "SELECT nombre FROM localidad order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_loca' id='lista_loca' class='caja' onKeyUp='pasar_foco_zona_mod_lista(event)' >";
		do{
				$nombre=$registro[0];
				if ( $nombre == $nombre_loca){
					echo "<option selected value=$nombre>$nombre</option>";
				}else{
					echo "<option value=$nombre>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>