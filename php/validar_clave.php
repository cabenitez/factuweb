<?php
session_start();   // Iniciar sesión

$clave_usuario = $_POST["clave_usuario"]; // toma la variable de la url q vino de ajax.js
$user_usuario = $_SESSION['user_usuario']; 	//usuario conectado
 
if($user_usuario & $clave_usuario){
	include("conexion.php");
	
	// de javascript viene la clave encritada en md5 - cuando se registran los usuarios se encripta con md5 pero en PHP
	$consulta = "SELECT * FROM usuario where usuario = '$user_usuario' and clave = '$clave_usuario'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    $registro = mysql_fetch_row($result);        // toma el registro

    if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		echo 'OK';

	}else{ 
	   	echo 'La Clave es incorrecta';     // si no existe el usuario
	}
}
?>