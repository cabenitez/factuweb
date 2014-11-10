<?
	include("conexion.php");
	$consulta = "SELECT localidad FROM empresa"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$prov= $registro[0];
	
	$consulta = "SELECT * FROM localidad order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_loca' id='lista_loca' class='caja'  onKeyUp='pasar_foco_prove_9(event)'>"; 
		do{
				$codigo=$registro[0];
				$nombre=$registro[3];
				if ( $nombre == $prov){
					echo "<option selected value=$codigo>$nombre</option>";
				}else{
					echo "<option value=$codigo>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
?>