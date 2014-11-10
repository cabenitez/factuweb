<?
	include("conexion.php");
	$consulta = "SELECT * FROM vendedor order by cod_vendedor"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='vendedor' id='vendedor' size='5' multiple class='caja'onKeyUp='pasar_foco_estad_1(event)'>";  
		do{
				$codigo=$registro[0];
				$nombre=$registro[2];
				echo "<option value=$codigo title='$nombre'>$codigo $nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
?>