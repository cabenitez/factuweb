<? 
$n_pedido = $_POST["n_pedido"]; 								// toma la variable de la url q vino de ajax.js

if($n_pedido){
	include("conexion.php"); 
	$consulta = "call marcar_pedido_como_facturado($n_pedido)"; // llama al procedimiento almacecnado 
	if($result = mysql_query($consulta)){        				// hace la consulta
		echo "ok";
	}else{
		echo "error" ;
	}	
}
?>