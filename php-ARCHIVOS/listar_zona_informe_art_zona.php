<?
	include("conexion.php"); 
	$consulta = "SELECT * FROM zona order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_zona_bus' id='lista_zona_bus' class='caja'  onKeyUp='informe_articulos_cliente_2(event)'>"; 
		do{
				$codigo=$registro[0];
				$nombre=$registro[4];
				echo "<option value=$codigo>$nombre</option>"; 
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
?>