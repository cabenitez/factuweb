<?
// verifica si se hizo click en un pedido odb
$id = $_POST["id"]; 															// toma la variable de la url q vino de ajax.js
if($id){ 
	include('conexion.php');
	$consulta = "select codigo from pedidos where id = $id and tipo = 'P'"; 	// consulta sql
	$result = mysql_query($consulta);            								// hace la consulta
	$registro = mysql_fetch_row($result);        							  		
	$cod= $registro[0]; 					
	echo $cod;
}
?>