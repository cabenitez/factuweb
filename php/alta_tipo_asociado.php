<? 
$nombre = $_POST["nombre"]; // toma la variable de la url q vino de ajax.js

if($nombre){
	include("conexion.php");
	$nombre = strtoupper($nombre);
	$consulta = "SELECT letra FROM tipo_asociado where letra = '$nombre'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    $registro = mysql_fetch_row($result);        // toma el registro
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$consulta = "call alta_tipo_asociado('$nombre')"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
		echo "Tipo Asociado Registrado!!";
	}else{
		echo "ERROR: El Tipo Asociado ya existe";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	$smarty->display('alta_tipo_asociado.tpl');   //define la plantilla que utilizara
}
?>