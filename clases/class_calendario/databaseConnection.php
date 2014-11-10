<?php
	include("../conexion.php");
	
	$conn = mysql_connect($host, $usuario,$clave)or die ("No se puede conectar con el Servidor"); 
	mysql_select_db ($db,$coneccion)or die ("No se puede conectar con la Base de Datos");

	//$conn = mysql_connect('localhost', 'root', 'gmo285coreduos');
	//mysql_select_db('db_ele');
?>