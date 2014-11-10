<? 
$idnombre = $_POST["idnombre"]; 					// toma la variable de la url q vino de ajax.js
$nombre = $_POST["nombre"]; 						// toma la variable de la url q vino de ajax.js
$comp = $_POST["comp"]; 							// toma la variable de la url q vino de ajax.js
$requiere_cuit = $_POST["requiere_cuit"]; 			// toma la variable de la url q vino de ajax.js


if($nombre){
	include("conexion.php");
	$nombre = strtoupper($nombre);
	$consulta = "SELECT * FROM iva where nombre = '$nombre'"; 					// consulta sql
    $result = mysql_query($consulta);            								// hace la consulta
   	$nfilas = mysql_num_rows ($result);          								//indica la cantidad de resultados
    $registro = mysql_fetch_row($result);        								// toma el registro
    if ($nfilas == 0){     														// si existe el usuario inicia la sesion
		$consulta = "call alta_cond_iva($idnombre, '$comp','$nombre','$requiere_cuit')"; 	// llama al procedimiento almacecnado
		$result = mysql_query($consulta);        								// hace la consulta
		echo "Condici&oacute;n de IVA Registrada!!";
	}else{
		echo "ERROR: La Condici&oacute;n de IVA ya existe";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_condicion_iva.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_cond_iva";
	$plantilla = "alta_condicion_iva.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>