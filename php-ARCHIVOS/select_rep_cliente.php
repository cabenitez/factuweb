<?
	include("conexion.php");
	$consulta = "SELECT * FROM fletero order by cod_flero"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_rep' id='lista_rep' class='caja'onKeyUp='pasar_foco_clie_19(event)'>"; 
		do{
				$codigo=$registro[0];
				$nombre=$registro[2];
				echo "<option value=$codigo title='$nombre'>$codigo</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
?>