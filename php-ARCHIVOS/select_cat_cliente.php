<?
	include("conexion.php");
	$consulta = "SELECT * FROM categoria order by descripcion"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_cat' id='lista_cat' class='caja'onKeyUp='pasar_foco_clie_17(event)'>"; 
		do{
				$nombre=$registro[1];
				echo "<option value=$nombre>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
?>