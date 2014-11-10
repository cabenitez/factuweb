<?  
$nombre = $_POST["nombre"]; 					// toma la variable de la url q vino de ajax.js
if($nombre){
	$tel = $_POST["tel"]; 			// toma la variable de la url q vino de ajax.js
	$mail = $_POST["mail"]; 					// toma la variable de la url q vino de ajax.js
	$nombre = strtoupper($nombre);

	include("conexion.php");
	
	//---------------------------------------------------------------------------------------------------------------------------------------------//
	$consulta = "call alta_persona_agenda('$nombre','$tel','$mail')"; // llama al procedimiento almacecnado
	//echo $consulta;
	if($result = mysql_query($consulta)){        // hace la consulta
		echo "ok";
	}
}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="utilidades";
	$plantilla = "agenda.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
}
?>