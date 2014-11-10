<? 
session_start();   // Iniciar sesión
$usuario_cc = $_SESSION['user_usuario']; //usuario conectado

$cod_tal = $_POST["cod_tal"]; 	// toma la variable de la url q vino de ajax.js

if($cod_tal){
	include("conexion.php"); 
	
	$num_tal = $_POST["num_tal"]; 	// toma la variable de la url q vino de ajax.js
	$n_factura = $_POST["n_factura"]; 	// toma la variable de la url q vino de ajax.js
	$importe_imp = $_POST["importe_imp"]; // toma la variable de la url q vino de ajax.js

	$consulta = "SELECT * FROM cc_vta_tmp where usuario = '$usuario_cc' and n_factura=$n_factura and cod_talonario='$cod_tal' and num_talonario = $num_tal "; // MONTO DE IMPUESTO INTERNO (MONTO FIJO)
	$result = mysql_query($consulta);            
	$registro = mysql_fetch_row($result);        
	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	if ($nfilas > 0){     						 		// si ya existe el articulo
		if($importe_imp > 0){
				echo $consulta = "call modificar_cc_tmp('$usuario_cc', $n_factura,'$cod_tal',$num_tal,$importe_imp)"; // llama al procedimiento almacecnado
		}else{
				$consulta = "call eliminar_cc_tmp('$usuario_cc', $n_factura,'$cod_tal',$num_tal)"; // llama al procedimiento almacecnado
		}		
	}else{
		$consulta = "call alta_cc_tmp('$usuario_cc', $n_factura,'$cod_tal',$num_tal,$importe_imp)"; // llama al procedimiento almacecnado

	}
	$result = mysql_query($consulta);        
}
?>