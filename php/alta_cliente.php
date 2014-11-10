<? 
$codigo = $_POST["codigo"]; 		// toma la variable de la url q vino de ajax.js

if($codigo){
	$razon = $_POST["razon"]; 			// toma la variable de la url q vino de ajax.js
	$cuit = $_POST["cuit"]; 			// toma la variable de la url q vino de ajax.js
	$iva = $_POST["iva"]; 				// toma la variable de la url q vino de ajax.js
	$dir = $_POST["dir"]; 				// toma la variable de la url q vino de ajax.js
	$pais = $_POST["pais"]; 			// toma la variable de la url q vino de ajax.js
	$prov = $_POST["prov"]; 			// toma la variable de la url q vino de ajax.js
	$localidad = $_POST["localidad"]; 	// toma la variable de la url q vino de ajax.js
	$zona = $_POST["zona"]; 	// toma la variable de la url q vino de ajax.js
	$tel = $_POST["tel"]; 				// toma la variable de la url q vino de ajax.js
	$fax = $_POST["fax"]; 				// toma la variable de la url q vino de ajax.js
	$cel = $_POST["cel"]; 				// toma la variable de la url q vino de ajax.js
	$web = $_POST["web"]; 				// toma la variable de la url q vino de ajax.js
	$mail = $_POST["mail"]; 			// toma la variable de la url q vino de ajax.js
	$contacto = $_POST["contacto"]; 	// toma la variable de la url q vino de ajax.js
	$lim_cred = $_POST["lim_cred"]; 	// toma la variable de la url q vino de ajax.js
	$categoria = $_POST["categoria"]; 	// toma la variable de la url q vino de ajax.js
	$cod_vendedor = $_POST["vendedor"]; 	// toma la variable de la url q vino de ajax.js
	$cod_repartidor = $_POST["repartidor"]; 	// toma la variable de la url q vino de ajax.js
	$cod_fp = $_POST["fp"]; 	// toma la variable de la url q vino de ajax.js
	include("conexion.php");
	$razon = strtoupper($razon);
	$dir = strtoupper($dir);	
	$web = strtoupper($web);	
	$mail = strtoupper($mail);
	
	//---------------------//
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
	
	//---------------------//
	$consulta = "SELECT cod_zona FROM zona where nombre = '$zona'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_zona= $registro[0];
	
	//---------------------//
	$consulta = "SELECT cod_talonario FROM iva where cod_iva = '$iva'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_tal= $registro[0];
	
	//---------------------//
	$consulta = "SELECT cod_categoria FROM categoria where descripcion = '$categoria'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_categoria= $registro[0];
	
	//---------------------------------------------------------------------------------------------------------------------------------------------//
	$consulta = "SELECT cod_cliente FROM cliente where cod_cliente  = '$codigo'"; // consulta sql
    //if (!empty($cuit)){
	// 	$consulta = $consulta. " " . "or cuit = $cuit"; 
	//}
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    
	if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$consulta = "call alta_cliente($codigo,'$razon','$cuit','$dir','$tel','$fax','$cel','$contacto','$web','$mail','$lim_cred',$iva,$cod_zona,$cod_loca,$cod_prov,$cod_pais,$cod_categoria,$cod_vendedor,$cod_repartidor,'$cod_tal',$cod_fp)"; // llama al procedimiento almacecnado
		//echo $consulta;
		$result = mysql_query($consulta);        // hace la consulta
		echo "Cliente Registrado!!";
	}else{
		echo "ERROR: El Cliente ya existe";
	}
}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_cliente.tpl');   //define la plantilla que utilizara

	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_cliente";
	$plantilla = "alta_cliente.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>