<?  
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//	
	require("smarty.php");  // requiere la pag "smarty.php" para crear una instancia de Smarty 
	$smarty = new ClaseSmarty; //crea una instancia
	$modulo="utilidades";
	$plantilla = "auditoria.tpl";
	require("validar_permiso.php");	 
?>