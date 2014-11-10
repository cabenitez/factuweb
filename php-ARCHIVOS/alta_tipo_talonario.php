<? 
$codigo = $_POST["codigo"]; // toma la variable de la url q vino de ajax.js
$desc = $_POST["desc"]; 	// toma la variable de la url q vino de ajax.js
$cant = $_POST["cant"]; 	// toma la variable de la url q vino de ajax.js
if($codigo){
	include("conexion.php");
	$codigo = strtoupper($codigo);
	$desc = strtoupper($desc);
	$requiere_cuit = strtoupper($requiere_cuit);
	$nfilas = 0;
	$consulta = "SELECT * FROM tipo_talonario where cod_talonario  = '$codigo' or descripcion = '$desc'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    $registro = mysql_fetch_row($result);        // toma el registro
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$consulta = "call alta_tipo_talonario('$codigo','$desc',$cant)"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
		echo "Comprobante Registrado!!";
	}else{
		echo "ERROR: El Comprobante ya existe";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_tipo_talonario.tpl');   //define la plantilla que utilizara

	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_comprobante";
	$plantilla = "alta_tipo_talonario.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>