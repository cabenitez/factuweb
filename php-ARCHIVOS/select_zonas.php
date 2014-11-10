<?
if($cod_loca){
	include("conexion.php");
	$consulta = "SELECT * FROM zona where cod_localidad = $cod_loca"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_zona' id='lista_zona' class='caja' onkeyup='pasar_foco_clie_9(event)'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		do{
				$codigo=$registro[0];
				$nombre=$registro[4];
				echo "<option value=$codigo>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}else{
	echo"<select name='lista_zona' id='lista_zona' class='caja'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		echo "<option value='nulo'>-- seleccione localidad --</option>";
	echo"</select>";
}
?>