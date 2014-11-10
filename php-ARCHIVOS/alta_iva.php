<? 
$nombre = $_POST["nombre"]; // toma la variable de la url q vino de ajax.js
$tasa = $_POST["tasa"]; // toma la variable de la url q vino de ajax.js
if($nombre){
	include("conexion.php");
	$nombre = strtoupper($nombre);
	$consulta = "SELECT * FROM alicuota_iva where nombre = '$nombre'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$consulta = "call alta_iva('$nombre',$tasa)"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
		echo "Impuesto Registrado!!";
	}else{
		echo "ERROR: El impuesto ya existe";
	}
}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_iva.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_alicuotas";
	$plantilla = "alta_iva.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
}
?>