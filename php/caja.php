<? 
$importe = $_POST["importe"]; // toma la variable de la url q vino de ajax.js
$obs = $_POST["obs"]; // toma la variable de la url q vino de ajax.js
include("conexion.php");

if($importe){
	$dia=date("d",time());  //asigna una cadena a la variable "dia"
	$mes=date("m",time());  //asigna una cadena a la variable "mes"
	$ano=date("Y",time());  //asigna una cadena a la variable "año"
	$fecha_caja = $ano.$mes.$dia;


	$obs = strtoupper($obs);
	$consulta = "call alta_caja($fecha_caja,$importe,'$obs')"; // llama al procedimiento almacecnado
	
	if(	$result = mysql_query($consulta)){            					// hace la consulta
		echo "Caja Inicial Registrada!!";
	}else{
		echo "ERROR: No se pudo registrar la Caja Inicial";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	$smarty->assign('fecha',$fecha);  //asigna una cadena a la variable "nombre"
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_forma_pago";
	$plantilla = "caja.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>