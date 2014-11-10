<? 
$nombre = $_POST["nombre"]; // toma la variable de la url q vino de ajax.js
$obs = $_POST["obs"]; // toma la variable de la url q vino de ajax.js
if($nombre){
	include("conexion.php");
	$nombre = strtoupper($nombre);
	$obs = strtoupper($obs);
	$nfilas = 0;
	$consulta = "SELECT * FROM forma_pago where descripcion = '$nombre'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    $registro = mysql_fetch_row($result);        // toma el registro
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$consulta = "call alta_fp('$nombre','$obs')"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
		echo "Forma de Pago Registrada!!";
	}else{
		echo "ERROR: La Forma de Pago  ya existe";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_forma_pago.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_forma_pago";
	$plantilla = "alta_forma_pago.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>