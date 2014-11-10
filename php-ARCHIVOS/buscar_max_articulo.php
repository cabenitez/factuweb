<?
	$cod_vari = $_POST["cod_vari"]; 					// toma la variable de la url q vino de ajax.js
	$cod_marca = $_POST["cod_marca"]; 					// toma la variable de la url q vino de ajax.js
	$cod_grupo = $_POST["cod_grupo"]; 					// toma la variable de la url q vino de ajax.js
	$codigo=$cod_grupo.$cod_marca.$cod_vari;
	include("conexion.php");
	$consulta = "SELECT max(cod_prod)FROM producto where concat(cod_grupo, cod_marca, cod_variedad) = $codigo "; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$codigo= $registro[0]+1;
	
	echo $codigo;
?>