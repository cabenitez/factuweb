<?  
session_start();   // Iniciar sesión

$db = $_POST["db"]; 					// toma la variable de la url q vino de ajax.js
if($db){
	$_SESSION["base_datos"] = $db;

}else{
	require("smarty.php");  // requiere la pag "smarty.php" para crear una instancia de Smarty 
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_articulo.tpl');     //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="utilidades";
	$plantilla = "cambiar_base_datos.tpl";
	require("validar_permiso.php");	 
}
?>