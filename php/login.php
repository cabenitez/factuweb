<?php
session_start();   // Iniciar sesión
include("conexion.php");

$usuario = $_POST["usuario"]; // toma la variable de la url q vino de ajax.js
$clave = $_POST["clave"]; // toma la variable de la url q vino de ajax.js
 
if($usuario & $clave){
	//echo $clave;
	// de javascript viene la clave encritada en md5 - cuando se registran los usuarios se encripta con md5 pero en PHP
	$consulta = "SELECT * FROM usuario where usuario = '$usuario' and clave = '$clave'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    $registro = mysql_fetch_row($result);        // toma el registro

    if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		$usuario = $registro[1];                 // toma el campo del registro
		$nombre = $registro[3];                  // toma el campo  del registro
		$activo = $registro[32];                  // toma el campo  del registro
		if($activo == 'S'){
			session_name($nombre_sesion);  			 // crea una sesion con el nombre definido en conexion.php
			session_start(); 						 // inicia sesion
			//session_register($nombre_sesion); 		 // registra una sesion con la variable "usuario"
			$_SESSION["user_usuario"] = $usuario;                 		// toma el campo nombre de la BD
			$_SESSION["clave_usuario"] = $clave;                 		// toma el campo nombre de la BD
			$_SESSION["nombre_usuario"] = $nombre;                     // toma el campo nombre de la BD 
			$_SESSION["hora_entrada"] = date(h.':'.i.':'.s);
			//INSERT INTO auditoria VALUES(tabla,'cod_iva','',new.cod_iva,NOW(),USER(),'INSERT');
			
			
			//$consulta_audit = "INSERT INTO auditoria VALUES('-','-','-','-','$fecha_hora','$usuario@localhost','LOGIN')";  // consulta sql
			//if($result_audit = mysql_query($consulta_audit)){            								// hace la consulta
						echo 'usuario_valido';   				  										// si no existe el usuario
			//}

		}else{
	   		echo 'El Usuario fu&eacute; dado de Baja';     // si no existe el usuario
		}	
	}else{ 
	   	echo 'El Usuario no esta registrado';     // si no existe el usuario
	}
}else{ 
     echo 'Debe completar los campos';            // si los campos estan vacios} 
}
?>