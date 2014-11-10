<?
//		variables = "codigo="+codigo.value+"razon="+razon.value+"fecha_desde="+fecha_desde+"fecha_hasta="+fecha_hasta;
	require("smarty.php");  // requiere la pag "smarty.php" para crear una instancia de Smarty 
	$smarty = new ClaseSmarty; //crea una instancia
	$smarty->assign('dia',date("d",time()));  //asigna una cadena a la variable "nombre"
	$smarty->assign('mes',date("m",time()));  //asigna una cadena a la variable "nombre"
	$smarty->assign('ano',date("Y",time()));  //asigna una cadena a la variable "nombre"
	//$smarty->display('informe_comprascliente.tpl');   //define la plantilla que utilizara

	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="informes";
	$plantilla = "informe_caja_rentabilidad.tpl";
	require("validar_permiso.php");	 

?>
