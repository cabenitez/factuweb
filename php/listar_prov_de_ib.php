<?
if($cod_ib){
	include("conexion.php");
	$consulta = "SELECT cod_prov FROM ing_bruto where cod_ing_bruto = $cod_ib"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_prov=$registro[0];
	
	$consulta = "SELECT nombre FROM provincia where cod_prov = $cod_prov "; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nombre_prov=$registro[0];
	
	$consulta = "SELECT cod_prov, nombre FROM provincia order by nombre"; // consulta sql  
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_prov_mod' id='lista_prov_mod' class='caja' onKeyUp='pasar_foco_loca_mod_lista(event)' >";
		do{
				$cod=$registro[0];
				$nombre=$registro[1];
				if ( $nombre == $nombre_prov){
					echo "<option selected value=$cod >$nombre</option>";
				}else{
					echo "<option value=$cod >$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>