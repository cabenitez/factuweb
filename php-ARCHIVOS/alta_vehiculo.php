<? 
$codigo = $_POST["codigo"]; // toma la variable de la url q vino de ajax.js
$patente = $_POST["patente"]; // toma la variable de la url q vino de ajax.js
$patente_a = $_POST["patente_a"]; // toma la variable de la url q vino de ajax.js
$marca = $_POST["marca"]; // toma la variable de la url q vino de ajax.js
$modelo = $_POST["modelo"]; // toma la variable de la url q vino de ajax.js
$propio = $_POST["propio"]; // toma la variable de la url q vino de ajax.js

if($patente){
	include("conexion.php");
	$patente = strtoupper($patente);
	$patente_a = strtoupper($patente_a);
	$marca = strtoupper($marca);
	$modelo = strtoupper($modelo);
	$propio = strtoupper($propio);
	
	$consulta = "SELECT * FROM vehiculo where patente = '$patente' or cod_vehiculo = $codigo"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    $registro = mysql_fetch_row($result);        // toma el registro
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$consulta = "call alta_vehiculo($codigo,'$patente','$patente_a','$marca','$modelo','$propio')"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
		echo "Vehiculo Registrado!!";
	}else{
		echo "ERROR: El Vehiculo ya existe";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_vehiculo.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_vehiculo";
	$plantilla = "alta_vehiculo.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>