<?
//fecha_dep & hora & banco_dep & trans & cta & titular & importe & obs

$fecha_dep = $_POST["fecha_dep"]; 	// toma la variable de la url q vino de ajax.js
if($fecha_dep){
	$hora_dep = $_POST["hora_dep"]; // toma la variable de la url q vino de ajax.js
	$banco = $_POST["banco"]; 		// toma la variable de la url q vino de ajax.js
	$trans = $_POST["trans"]; 		// toma la variable de la url q vino de ajax.js
	$cta = $_POST["cta"]; 			// toma la variable de la url q vino de ajax.js
	$titular = $_POST["titular"]; 	// toma la variable de la url q vino de ajax.js
	$importe = $_POST["importe"]; 	// toma la variable de la url q vino de ajax.js
	$obs = $_POST["obs"]; 			// toma la variable de la url q vino de ajax.js

	$hora_dep = strtoupper($hora_dep);
	$banco = strtoupper($banco);
	$trans = strtoupper($trans);
	$cta = strtoupper($cta);
	$titular = strtoupper($titular);
	$obs = strtoupper($obs);
	
	include("conexion.php");
	$consulta = "call alta_deposito_compra($fecha_dep,'$hora_dep','$banco','$trans','$cta','$titular', $importe,'$obs')"; 	// llama al procedimiento almacecnado
	if($result = mysql_query($consulta)){        // hace la consulta
		echo "ok";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="factura_compra";
	$plantilla = "alta_deposito_compra.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>