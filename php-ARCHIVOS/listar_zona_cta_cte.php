<?
	include("conexion.php");
	$consulta = "select cod_zona, zona.nombre, zona.cod_localidad, localidad.nombre from zona inner join localidad where localidad.cod_localidad=zona.cod_localidad order by zona.nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_zona'  id='lista_zona' disabled class='caja'onKeyUp='pasar_foco_rem_vta_4a(event)'>"; 
		do{
				$codigo=$registro[0];
				$nombre=$registro[1];
				$cod_loca=$registro[2];
				$nombre_loca=$registro[3];
				echo "<option value=$codigo id=$nombre title='$nombre_loca'>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";

?>