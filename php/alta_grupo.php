<? 
$codigo = $_POST["codigo"]; // toma la variable de la url q vino de ajax.js
$nombre = $_POST["nombre"]; // toma la variable de la url q vino de ajax.js

if($nombre && $codigo){
	include("conexion.php");
	$nombre = strtoupper($nombre);
	$consulta = "SELECT * FROM grupo where cod_grupo = $codigo or descripcion = '$nombre'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    $registro = mysql_fetch_row($result);        // toma el registro
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$consulta = "call alta_grupo($codigo,'$nombre')"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
		echo "Grupo Registrado!!";
	}else{
		echo "ERROR: El Grupo ya existe";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_grupo.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_articulo";
	$plantilla = "alta_grupo.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>