<?
$codigo = $_POST["codigo"]; // toma la variable de la url q vino de ajax.js
$dni = $_POST["dni"]; // toma la variable de la url q vino de ajax.js
$nombre = $_POST["nombre"]; // toma la variable de la url q vino de ajax.js
$dir = $_POST["dir"]; // toma la variable de la url q vino de ajax.js
$pais = $_POST["pais"]; // toma la variable de la url q vino de ajax.js
$prov = $_POST["prov"]; // toma la variable de la url q vino de ajax.js
$localidad = $_POST["localidad"]; // toma la variable de la url q vino de ajax.js
$tel = $_POST["tel"]; // toma la variable de la url q vino de ajax.js

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
	
	$consulta = "SELECT * FROM vendedor where cod_vendedor = $codigo or dni = $dni"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    $registro = mysql_fetch_row($result);        // toma el registro
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$consulta = "call alta_vendedor($codigo,$dni,'$nombre','$dir','$tel',$cod_loca,$cod_prov,$cod_pais)"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
		
		//echo $consulta;
		echo "Vendedor Registrado!!";
	}else{
		echo "ERROR: El Vendedor ya existe";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_vendedor.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_vendedor";
	$plantilla = "alta_vendedor.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>