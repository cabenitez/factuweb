<?php
$nombre = isset($_POST["nombre"])?$_POST["nombre"]:null; // toma la variable de la url q vino de ajax.js

if($nombre){
	include("conexion.php");
	$nombre = strtoupper($nombre);
	$consulta = "SELECT * FROM pais where nombre = '$nombre'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    $registro = mysql_fetch_row($result);        // toma el registro
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$consulta = "call alta_pais('$nombre')"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
		echo "Pais Registrado!!";
	}else{
		echo "ERROR: El pais ya existe";
	}
}else{
	require("smarty.php");  					 // requiere smatry.php
		
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_zonas_geo";
	$plantilla = "alta_pais.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
}
?>