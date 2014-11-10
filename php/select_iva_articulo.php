<?
	include("conexion.php");
	$consulta = "select * from alicuota_iva order by tasa"; // consulta sql  desc
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_iva' id='lista_iva' class='caja' onKeyUp='pasar_foco_art_16(event)'>";
		do{
				$codigo=$registro[0];
				$nombre=$registro[1];
				$tasa=$registro[2];
				echo "<option value=$codigo title='$nombre'>$tasa%</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
?>