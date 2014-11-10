<?  
$codigo = $_POST["codigo"]; 					// toma la variable de la url q vino de ajax.js
if($codigo){
	$variedad = $_POST["variedad"]; 			// toma la variable de la url q vino de ajax.js
	$marca = $_POST["marca"]; 					// toma la variable de la url q vino de ajax.js
	$grupo = $_POST["grupo"]; 					// toma la variable de la url q vino de ajax.js
	$desc = $_POST["desc"]; 					// toma la variable de la url q vino de ajax.js
	$precio_costo = $_POST["precio_costo"]; 	// toma la variable de la url q vino de ajax.js
	$envase = $_POST["envase"]; 				// toma la variable de la url q vino de ajax.js
	$stock_actual = $_POST["stock_actual"]; 	// toma la variable de la url q vino de ajax.js
	$stock_min = $_POST["stock_min"]; 			// toma la variable de la url q vino de ajax.js
	$stock_max = $_POST["stock_max"]; 			// toma la variable de la url q vino de ajax.js
	$foto = $_POST["foto"]; 					// toma la variable de la url q vino de ajax.js
	$proveedor = $_POST["proveedor"]; 			// toma la variable de la url q vino de ajax.js
	$medida = $_POST["medida"]; 				// toma la variable de la url q vino de ajax.js
	$cod_medida = $_POST["cod_medida"]; 		// toma la variable de la url q vino de ajax.js
	$porc_vta = $_POST["porc_vta"]; 			// toma la variable de la url q vino de ajax.js
	$porc_trans = $_POST["porc_trans"]; 		// toma la variable de la url q vino de ajax.js
	$unidad_bulto = $_POST["unidad_bulto"]; 	// toma la variable de la url q vino de ajax.js
	$peso = $_POST["peso"]; 					// toma la variable de la url q vino de ajax.js
	$iva = $_POST["iva"]; 					// toma la variable de la url q vino de ajax.js
	
	include("conexion.php");
	$desc = strtoupper($desc);
	//---------------------------------------------------------------------------------------------------------------------------------------------//
	$consulta = "call alta_producto($codigo,$variedad,$marca,$grupo,'$desc',$precio_costo,'$envase',$stock_actual,$stock_min,$stock_max,'N',$proveedor,$medida,$cod_medida,$porc_vta ,$porc_trans,$unidad_bulto,$peso,$iva)"; // llama al procedimiento almacecnado
	//echo $consulta;
	if($result = mysql_query($consulta)){        // hace la consulta
		echo "ok";
	}
}else{
	require("smarty.php");  // requiere la pag "smarty.php" para crear una instancia de Smarty 
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_articulo.tpl');     //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_articulo";
	$plantilla = "alta_articulo.tpl";
	require("validar_permiso.php");	 
}
?>