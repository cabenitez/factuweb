<?
if($cod_prov){
	include("conexion.php");
	$consulta = "SELECT * FROM localidad where cod_prov = $cod_prov order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_loca' id='lista_loca' class='caja' onkeyup='pasar_foco_prove_9(event)'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		do{
				$codigo=$registro[0];
				$nombre=$registro[3];
				echo "<option value=$codigo>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}else{
	echo"<select name='lista_loca' id='lista_loca' class='caja'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		echo "<option value='nulo'>-- seleccione provincia --</option>";
	echo"</select>";
}
?>