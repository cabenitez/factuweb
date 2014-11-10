<?
	// Obtiene todas las localidades de los remitos hechos
	include("conexion.php");
	$consulta = "select DISTINCT localidad.cod_localidad, localidad.nombre from localidad inner join (zona inner join(cliente inner join remito_vta on remito_vta.cod_cliente = cliente.cod_cliente) on cliente.cod_zona = zona.cod_zona) on zona.cod_localidad = localidad.cod_localidad"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro

	$consulta2 = "select DISTINCT localidad from remito_vta_no_cliente"; // consulta sql
	$result2 = mysql_query($consulta2);            // hace la consulta
	$registro2 = mysql_fetch_row($result2);        // toma el registro

	echo"<select name='lista_loca' id='lista_loca' class='caja' onKeyUp='pasar_foco_fact_vta_bus_3(event)'>"; 
		echo "<option value='TODOS'>TODOS</option>";
		do{
			$nombre2 = $registro2[0];
			echo "<option value=$nombre2>$nombre2</option>"; //	lista de localidades de remitos a NO CLIENTES
			do{
				$nombre= $registro[1];
				if ($nombre2 != $nombre){
					echo "<option value=$nombre>$nombre</option>";
				}
			}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
			
		}while($registro2 = mysql_fetch_row($result2)); // obtengo los resultados 		
	echo"</select>";
	
	
?>