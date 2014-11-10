<? 
$codigo = $_POST["codigo"]; 		// toma la variable de la url q vino de ajax.js
$razon = $_POST["razon"]; 			// toma la variable de la url q vino de ajax.js
$cuit = $_POST["cuit"]; 			// toma la variable de la url q vino de ajax.js
$ing_bruto = $_POST["ing_bruto"]; 	// toma la variable de la url q vino de ajax.js
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
$contacto = $_POST["contacto"]; 	// toma la variable de la url q vino de ajax.js
$lim_cred = $_POST["lim_cred"]; 	// toma la variable de la url q vino de ajax.js
$agente = $_POST["agente"]; 		// toma la variable de la url q vino de ajax.js

if($codigo){
	include("conexion.php");
	$razon = strtoupper($razon);
	$dir = strtoupper($dir);	
	$web = strtoupper($web);	
	$mail = strtoupper($mail);		
	$contacto = strtoupper($contacto);	
	$consulta = "SELECT cod_pais FROM pais where pais.nombre = '$pais'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_pais= $registro[0];
	
	$consulta = "SELECT cod_prov FROM provincia where provincia.nombre = '$prov'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_prov= $registro[0];
	
	$consulta = "SELECT cod_localidad FROM localidad where localidad.nombre = '$localidad'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_loca= $registro[0];
	
	$consulta = "SELECT cod_proveedor FROM proveedor where cod_proveedor = '$codigo' or cuit = $cuit"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$consulta = "call alta_proveedor($codigo,'$razon',$cuit,'$ing_bruto','$dir','$tel','$fax','$cel','$contacto','$web','$mail','$lim_cred','$agente','$iva',$cod_loca,$cod_prov,$cod_pais)"; // llama al procedimiento almacecnado
		//echo $consulta;
		$result = mysql_query($consulta);        // hace la consulta
		echo "Proveedor Registrado!!";
	}else{
		echo "ERROR: El Proveedor ya existe";
	}
}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_proveedor.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_proveedor";
	$plantilla = "alta_proveedor.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>