<?
if($cod_prov){
	include("conexion.php");
	$consulta = "SELECT * FROM provincia where cod_prov = '$cod_prov'"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_pais=$registro[1];
	
	$consulta = "SELECT nombre FROM pais where cod_pais = '$cod_pais'"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nombre_pais=$registro[0];
	
	$consulta = "SELECT nombre FROM pais order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	
	echo"<select name='lista_pais' id='lista_pais' class='caja' onKeyUp='pasar_foco_prov_mod_lista(event)' >";
			do{
				$nombre=$registro[0];
				if ( $nombre == $nombre_pais){
					echo "<option selected value=$nombre>$nombre</option>";
				}else{
					echo "<option value=$nombre>$nombre</option>";
				}
			}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>