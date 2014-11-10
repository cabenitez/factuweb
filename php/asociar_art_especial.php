<? 
session_start();   										// Iniciar sesión
$usuario_fac = $_SESSION['user_usuario']; 	//usuario conectado
	
$codigo = $_POST["codigo"]; 									 // toma la variable de la url q vino de ajax.js
if($codigo){
	include("conexion.php");
	$consulta = "SELECT * FROM art_especial where codigo = $codigo"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$tipo = $_POST["tipo"]; 									 // toma la variable de la url q vino de ajax.js
		$valor = $_POST["valor"]; 									 // toma la variable de la url q vino de ajax.js
		$valor = strtoupper($valor);

		$consulta = "call alta_art_esp($codigo,'$tipo','$valor')"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
		echo 'OK';
	}
}else{
	include("conexion.php");
	
	require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; 				 //crea una instancia
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="factura_vta";
	$plantilla = "asociar_art_especial.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
}
?>