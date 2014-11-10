<? 
$codigo = $_POST["codigo"]; // toma la variable de la url q vino de ajax.js
$dni = $_POST["dni"]; // toma la variable de la url q vino de ajax.js
$nombre = $_POST["nombre"]; // toma la variable de la url q vino de ajax.js
$dir = $_POST["dir"]; // toma la variable de la url q vino de ajax.js
$pais = $_POST["pais"]; // toma la variable de la url q vino de ajax.js
$prov = $_POST["prov"]; // toma la variable de la url q vino de ajax.js
$localidad = $_POST["localidad"]; // toma la variable de la url q vino de ajax.js
$tel = $_POST["tel"]; // toma la variable de la url q vino de ajax.js
$cuit = $_POST["cuit"]; // toma la variable de la url q vino de ajax.js
$iva = $_POST["iva"]; // toma la variable de la url q vino de ajax.js
$vehiculo = $_POST["vehiculo"]; // toma la variable de la url q vino de ajax.js

if($codigo){
	include("conexion.php");
	$nombre = strtoupper($nombre);
	$dir = strtoupper($dir);
	
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
	
	$consulta = "SELECT cod_talonario FROM iva where cod_iva = '$iva'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_talonario = $registro[0];
	
	$consulta = "SELECT * FROM fletero where  cod_flero = $codigo or dni = $dni"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    $registro = mysql_fetch_row($result);        // toma el registro
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$consulta = "call alta_repartidor($codigo,$dni,'$nombre','$dir','$tel','$cuit',$cod_loca,$cod_prov,$cod_pais,$iva,'$cod_talonario')"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
		//echo $consulta;
		$consulta = "call alta_repartidor_x_vehi($codigo,$vehiculo)"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
		
		//echo $consulta;
		echo "Repartidor Registrado!!";
	}else{
		echo "ERROR: El Repartidor ya existe";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_repartidor.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_repartidor";
	$plantilla = "alta_repartidor.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>