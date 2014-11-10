<?
	include("conexion.php");
	$consulta = "SELECT * FROM vehiculo"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_vehiculo' id='lista_vehiculo' class='caja'onKeyUp='pasar_foco_rep_12(event)'>"; 
		do{
				$codigo=$registro[0];
				$marca=$registro[3];
				$modelo=$registro[4];
				echo "<option value=$codigo title='$marca - $modelo'>$codigo</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	
	echo"</select>";
	//echo "<label class='botones'> $marca - $modelo</label>";
?>