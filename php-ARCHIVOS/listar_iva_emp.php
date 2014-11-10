<?
	include("conexion.php");
	$consulta = "SELECT iva FROM empresa"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$nombre_iva= $registro[0];
	
	$consulta = "SELECT nombre FROM iva where cuit = 'S' order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_iva' id='lista_iva' class='caja'  onKeyUp='pasar_foco_prove_7(event)'>";
		do{
				$nombre=$registro[0];
				if ( $nombre == $nombre_iva){
					echo "<option selected value=$nombre>$nombre</option>";
				}else{
					echo "<option value=$nombre>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
?>