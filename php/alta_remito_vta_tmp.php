<? 
session_start();   // Iniciar sesión
$usuario_rem = $_SESSION['user_usuario']; //usuario conectado

$codigo_art = $_POST["codigo_art"]; 	// toma la variable de la url q vino de ajax.js
if($codigo_art){
	include("conexion.php");
	
	//$numero_rem = $_POST["numero_rem"]; 	// toma la variable de la url q vino de ajax.js
	$desc_art = $_POST["desc_art"]; 	// toma la variable de la url q vino de ajax.js
	$cant_art = $_POST["cant_art"]; 	// toma la variable de la url q vino de ajax.js
	$precio_art = $_POST["precio_art"]; // toma la variable de la url q vino de ajax.js
	$bonif_art = $_POST["bonif_art"]; 	// toma la variable de la url q vino de ajax.js

	$consulta = "SELECT * FROM tipo_talonario where descripcion LIKE '%rem%' or descripcion like '%REM%'";  // obtiene el cod del remito
    $result = mysql_query($consulta);           														   
   	$registro = mysql_fetch_row($result);        															
	$cod_tt= $registro[0];
	
	$consulta = "SELECT max(num_talonario) FROM talonario where cod_talonario = '$cod_tt'"; 		// obtiene el numero del remito
    $result = mysql_query($consulta);            
   	$registro = mysql_fetch_row($result);       
	$max_num_tal= $registro[0];
	
	$consulta = "SELECT max_iter FROM talonario where num_talonario = $max_num_tal AND cod_talonario = '$cod_tt'"; 			// obtiene el numero max de iteraciones
    $result = mysql_query($consulta);          
   	$registro = mysql_fetch_row($result);       
	$max_iter= $registro[0];

	$consulta = "SELECT count(linea) FROM remito_vta_tmp where usuario = '$usuario_rem'";		// obtiene la cantidad de articulos
	$result = mysql_query($consulta);            
	$registro = mysql_fetch_row($result);        
	$num_iter = $registro[0];		

	$consulta = "SELECT * FROM remito_vta_tmp where usuario = '$usuario_rem' and cod_prod = $codigo_art";		// obtiene la cantidad de articulos
	$result = mysql_query($consulta);            
	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	if ($nfilas > 0){     						 		// si ya existe el articulo
			echo "ERROR: El aticulo ya ha sido agregado";
	}else{
		if($num_iter < $max_iter){																	// verifica que las lineas sean menor al max	
			$consulta = "SELECT max(linea) FROM remito_vta_tmp where usuario = '$usuario_rem'"; 	// asigna el numero siguiente al mayor
			$result = mysql_query($consulta);          
			$registro = mysql_fetch_row($result);       
			$linea = $registro[0] + 1;		
			
			//////////////////**************** V2 ******************///////////////////////////////
			$consulta = "SELECT cod_iva FROM producto where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $codigo_art"; // % DE IVA
			$result = mysql_query($consulta);            
			$registro = mysql_fetch_row($result);        
			$cod_iva = $registro[0];
			
			$consulta_iva = "SELECT tasa FROM alicuota_iva where cod_iva = $cod_iva"; // % DE IVA
			$result_iva = mysql_query($consulta_iva);            
			$registro_iva = mysql_fetch_row($result_iva);        
			$tasa_iva = $registro_iva[0];
			//////////////////**************** V2 ******************///////////////////////////////

			$consulta = "call alta_remito_vta_tmp('$usuario_rem', $codigo_art,'$desc_art',$cant_art,$precio_art,$bonif_art,$importe_art,$linea,$tasa_iva)"; // llama al procedimiento almacecnado
			$result = mysql_query($consulta);        
			//echo $consulta;
		}else{
			echo "ERROR: Limite exedido, Maximo $max_iter iteraciones por Remito";
		}	
	}	
}
?>