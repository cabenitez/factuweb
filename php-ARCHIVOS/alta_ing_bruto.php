<? 
$nombre = $_POST["nombre"]; 		// toma la variable de la url q vino de ajax.js
$tasa = $_POST["tasa"]; 			// toma la variable de la url q vino de ajax.js
$provincia = $_POST["provincia"]; 	// toma la variable de la url q vino de ajax.js

if($nombre){
	include("conexion.php");
	$nombre = strtoupper($nombre);

	$consulta_p = "SELECT cod_prov, cod_pais FROM provincia where nombre = '$provincia'"; // consulta sql                  where nombre = '$nombre'
	$result_p = mysql_query($consulta_p);            // hace la consulta
   	$registro_p = mysql_fetch_row($result_p);        // toma el registro
	$cod_provincia=$registro_p[0];
	$cod_pais=$registro_p[1];

	$consulta = "SELECT * FROM ing_bruto where nombre = '$nombre' and cod_prov = $cod_provincia and cod_pais = $cod_pais"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    $registro = mysql_fetch_row($result);        // toma el registro
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$consulta = "call alta_ing_bruto('$nombre', $tasa, $cod_provincia, $cod_pais)"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
		echo "Impuesto Registrado!!";
	}else{
		echo "ERROR: El impuesto ya existe";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_ing_bruto.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_alicuotas";
	$plantilla = "alta_ing_bruto.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>