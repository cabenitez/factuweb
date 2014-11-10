<?
$id = $_POST["id"]; 															// toma la variable de la url q vino de ajax.js
if($id){ 
	include('conexion.php');
	$consulta = "call marcar_pedido($id)"; 	// consulta sql
	if($result = mysql_query($consulta)){            // hace la consulta
		echo 'OK';
	}
}
?>