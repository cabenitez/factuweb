<? 
	session_start();   										// Iniciar sesión
	$usuario_fac = $_SESSION['user_usuario']; 	//usuario conectado

	$fecha_carga_act = $_POST["fecha"]; 		// toma la variable de la url q vino de ajax.js
		
	include("conexion.php");
	
	//	vacia la tabla temporal en caso de que haya quedado pendiente una factura en una sesion anterior o un caso externo
	$consulta = "call vaciar_tabla_fac_vta_tmp('$usuario_fac')";
	$result = mysql_query($consulta);            // hace la consulta

	require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; 				 //crea una instancia
	$smarty->assign('dia',date("d",time()));  //asigna una cadena a la variable "dia"
	$smarty->assign('mes',date("m",time()));  //asigna una cadena a la variable "mes"
	$smarty->assign('ano',date("Y",time()));  //asigna una cadena a la variable "año"
	//$smarty->display('alta_factura_vta.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="factura_vta";
	$plantilla = "alta_factura_vta_sis_preventa.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

?>