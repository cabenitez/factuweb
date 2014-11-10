<?
session_start();   // Iniciar sesión
$usuario_sesion = $_SESSION['user_usuario']; //usuario conectado

$codigo = $_POST["codigo"]; 					// toma la variable de la url q vino de ajax.js
$valor = $_POST["valor"]; 					// toma la variable de la url q vino de ajax.js

if($codigo){
	include("conexion.php");
	
	$consulta = "SELECT abm_cliente FROM usuario where usuario = '$usuario_sesion'"; // consulta sql
    $result = mysql_query($consulta);          
   	$registro = mysql_fetch_row($result);       
	$permiso= $registro[0];
	if ($permiso == 'S'){     						 // si existe el usuario inicia la sesion
		$consulta = "call activar_desactivar_cliente($codigo, '$valor')";
		$result = mysql_query($consulta);            // hace la consulta
		//echo "Registro Eliminado!!";
	}else{
		echo "sin_permiso";
	}	
}


?>