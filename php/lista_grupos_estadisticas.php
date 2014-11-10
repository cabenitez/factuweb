<?
	include("conexion.php");
	$consulta = "SELECT * FROM grupo order by cod_grupo"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='grupo' id='grupo' size='5' multiple class='caja'onKeyUp='pasar_foco_estad_1(event)'>";  
		do{
				$codigo=$registro[0];
				$nombre=$registro[1];
				echo "<option value=$codigo title='$nombre'>$codigo $nombre $espacio_izq$espacio_izq$espacio_izq$espacio_izq$espacio_izq</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
?>