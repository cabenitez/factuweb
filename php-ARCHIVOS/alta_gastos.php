<? 
//variables="fecha="+txtano.value+txtmes.value+txtdia.value+"&hora="+txthora.value+"&desc="+txtdesc.value+"&importe="+txtimporte.value+"&obs="+txtobs.value;

$fecha_gasto = $_POST["fecha"]; // toma la variable de la url q vino de ajax.js
if($fecha_gasto){
	$hora = $_POST["hora"]; // toma la variable de la url q vino de ajax.js
	$desc = $_POST["desc"]; // toma la variable de la url q vino de ajax.js
	$importe = $_POST["importe"]; // toma la variable de la url q vino de ajax.js
	$iva = $_POST["iva"]; // toma la variable de la url q vino de ajax.js
	$otros_imp = $_POST["otros_imp"]; // toma la variable de la url q vino de ajax.js
	$total = $_POST["total"]; // toma la variable de la url q vino de ajax.js
	$obs = $_POST["obs"]; // toma la variable de la url q vino de ajax.js

	include("conexion.php");
	$desc = strtoupper($desc);
	$obs = strtoupper($obs);

	$consulta = "call alta_gasto($fecha_gasto,'$hora','$desc',$importe,$iva,$otros_imp,$total,'$obs')"; // llama al procedimiento almacecnado
	if($result = mysql_query($consulta)){        // hace la consulta
			echo "ok";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_forma_pago.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_forma_pago";
	$plantilla = "alta_gastos.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>