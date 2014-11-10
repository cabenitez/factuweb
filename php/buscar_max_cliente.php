<?
	include("conexion.php");
	$consulta = "SELECT max(cod_cliente)FROM cliente"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$codigo= $registro[0]+1;
	
	echo $codigo;
?>