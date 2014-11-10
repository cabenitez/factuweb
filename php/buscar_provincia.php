<? 
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	$smarty->display('buscar_provincia.tpl');   //define la plantilla que utilizara

?>