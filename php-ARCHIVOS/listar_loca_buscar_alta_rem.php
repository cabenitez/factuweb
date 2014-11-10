<?
	include("conexion.php");
	$consulta = "select DISTINCT localidad.cod_localidad, localidad.nombre from localidad inner join (zona inner join cliente on cliente.cod_zona = zona.cod_zona) on zona.cod_localidad = localidad.cod_localidad ORDER BY localidad.nombre"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro

	
	echo"<select name='lista_loca' id='lista_loca' class='caja' onKeyUp='pasar_foco_rem_vta_bus_3(event)'>"; 
		echo "<option value='TODOS'>TODOS</option>";
		do{
			$codigo= $registro[0];
			$nombre= $registro[1];
			echo "<option value=$codigo>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
?>