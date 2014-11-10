<?
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_cliente.tpl');   //define la plantilla que utilizara

	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_cliente";
	$plantilla = "constancia_inscripcion_afip.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

?>