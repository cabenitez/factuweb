<? 
//variables="accion="+accion+"&id_grupo="+id_grupo+"&id_categoria="+id_categoria+"&porcentaje="+document.getElementById(caja_nombre).value;

$accion = $_POST["accion"]; // toma la variable de la url q vino de ajax.js
$id_grupo = $_POST["id_grupo"]; // toma la variable de la url q vino de ajax.js
$id_categoria = $_POST["id_categoria"]; // toma la variable de la url q vino de ajax.js
$porcentaje = $_POST["porcentaje"]; // toma la variable de la url q vino de ajax.js

if($accion){
	include("conexion.php");
	if($accion == 'U'){
		$consulta = "call ajuste_precios_utilidad($id_grupo,$id_categoria,$porcentaje)"; // llama al procedimiento almacecnado
	}else{
		$consulta = "call ajuste_precios_manual($id_grupo,$id_categoria)"; // llama al procedimiento almacecnado
	}
	if($result = mysql_query($consulta)){        // hace la consulta
		echo "ok";
	}
	
}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_grupo.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_articulo";
	$plantilla = "ajuste_precios.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
}
?>