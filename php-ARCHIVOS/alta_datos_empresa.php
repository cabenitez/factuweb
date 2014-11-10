<? 
$razon = $_POST["razon"]; 		// toma la variable de la url q vino de ajax.js
if($razon){
	$dueno = $_POST["dueno"]; 			// toma la variable de la url q vino de ajax.js
	$cuit = $_POST["cuit"]; 			// toma la variable de la url q vino de ajax.js
	$ing_bruto = $_POST["ing_bruto"]; 			// toma la variable de la url q vino de ajax.js
	$iva = $_POST["iva"]; 				// toma la variable de la url q vino de ajax.js
	$dir = $_POST["dir"]; 				// toma la variable de la url q vino de ajax.js
	$pais = $_POST["pais"]; 			// toma la variable de la url q vino de ajax.js
	$prov = $_POST["prov"]; 			// toma la variable de la url q vino de ajax.js
	$localidad = $_POST["localidad"]; 	// toma la variable de la url q vino de ajax.js
	$tel = $_POST["tel"]; 				// toma la variable de la url q vino de ajax.js
	$fax = $_POST["fax"]; 				// toma la variable de la url q vino de ajax.js
	$cel = $_POST["cel"]; 				// toma la variable de la url q vino de ajax.js
	$web = $_POST["web"]; 				// toma la variable de la url q vino de ajax.js
	$mail = $_POST["mail"]; 			// toma la variable de la url q vino de ajax.js
	$fecha_empresa = $_POST["fecha"]; 			// toma la variable de la url q vino de ajax.js
	
	include("conexion.php");
	//$razon = strtoupper($razon);
	//$dueno = strtoupper($dueno);	
	//$dir = strtoupper($dir);	
	//$web = strtoupper($web);	
	//$mail = strtoupper($mail);
	$logo = "N";
	$fondo = "N";
	
	// en caso de que se este modificando los datos de la empresa obtengo los campos logo y fondo
	$consulta="select logo, imagen_fondo from empresa";
	$result = mysql_query($consulta);            // hace la consulta
	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	//echo $nfilas;
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		$logo = $registro[0]; 
		$fondo = $registro[1]; 
	}
	
	//---------------------------------------------------------------------------------------------------------------------------------------------//
	$consulta ="TRUNCATE TABLE empresa"; 	 // vacia la tanbla empresa para registrarla nuevamente
	$result = mysql_query($consulta);        // hace la consulta	
	
	$consulta = "call alta_empresa('$razon','$dueno',$cuit,'$ing_bruto','$iva',$fecha_empresa,'$tel','$fax','$cel','$dir','$pais','$prov','$localidad','$web','$mail','$logo','$fondo')"; // llama al procedimiento almacecnado
	$result = mysql_query($consulta);        // hace la consulta
	//echo $consulta;
}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_datos_empresa.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="datos_empresa";
	$plantilla = "alta_datos_empresa.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>
