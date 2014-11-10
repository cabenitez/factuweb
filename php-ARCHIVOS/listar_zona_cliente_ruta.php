<?
	include("conexion.php");
	$consulta = "SELECT cod_zona, nombre FROM zona order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_zona_bus' id='lista_zona_bus' class='caja'  onKeyUp='pasar_foco_clie_26(event,this.value)'>"; 
		do{
				$codigo=$registro[0];
				$nombre=$registro[1];
				echo "<option value=$codigo>$nombre</option>"; //$codigo - 
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
?>