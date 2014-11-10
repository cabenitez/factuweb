<? 
//	codigo_art        desc_art        cant_art         precio_art       bonif_art        importe_art 


session_start();   // Iniciar sesión
$usuario_fac = $_SESSION['user_usuario']; //usuario conectado

$codigo_art = $_POST["codigo_art"]; 	// toma la variable de la url q vino de ajax.js
if($codigo_art){
	include("conexion.php");
	
	$desc_art = $_POST["desc_art"]; 		// toma la variable de la url q vino de ajax.js
	$cant_art = $_POST["cant_art"]; 		// toma la variable de la url q vino de ajax.js
	$precio_art = $_POST["precio_art"]; 	// toma la variable de la url q vino de ajax.js
	$bonif_art = $_POST["bonif_art"]; 		// toma la variable de la url q vino de ajax.js
	$importe_art = $_POST["importe_art"]; 	// toma la variable de la url q vino de ajax.js
	
	$consulta = "SELECT max(linea) FROM factura_compra_tmp where usuario = '$usuario_fac'"; 	// asigna el numero siguiente al mayor
	$result = mysql_query($consulta);          
	$registro = mysql_fetch_row($result);       
	$linea = $registro[0] + 1;		
			
	$consulta = "call alta_factura_compra_tmp('$usuario_fac', $codigo_art,'$desc_art',$cant_art,$precio_art,$bonif_art,$importe_art,$linea)"; // llama al procedimiento almacecnado
	$result = mysql_query($consulta);        
	//echo $consulta;
}
?>