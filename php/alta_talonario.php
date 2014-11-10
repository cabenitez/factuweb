<?
$codigo_tt = $_POST["codigo_tt"]; // toma la variable de la url q vino de ajax.js
if($codigo_tt){
	$numero = $_POST["numero"]; 			// toma la variable de la url q vino de ajax.js
	$sucursal = $_POST["sucursal"]; 		// toma la variable de la url q vino de ajax.js
	$iteraciones = $_POST["iteraciones"]; 	// toma la variable de la url q vino de ajax.js
	$primer_num = $_POST["primer_num"]; 	// toma la variable de la url q vino de ajax.js
	$ultimo_num = $_POST["ultimo_num"]; 	// toma la variable de la url q vino de ajax.js
	$sig_num = $_POST["sig_num"]; 			// toma la variable de la url q vino de ajax.js
	$dia = $_POST["dia"]; 					// toma la variable de la url q vino de ajax.js
	$mes = $_POST["mes"]; 					// toma la variable de la url q vino de ajax.js
	$ano = $_POST["ano"]; 					// toma la variable de la url q vino de ajax.js
	$cai = $_POST["cai"]; 					// toma la variable de la url q vino de ajax.js
	$impr = $_POST["impr"]; 				// toma la variable de la url q vino de ajax.js
	include("conexion.php");
	$nfilas = 0;
	$consulta = "SELECT * FROM talonario where cod_talonario = '$codigo_tt' and num_talonario = $numero"; // consulta sql
    $result = mysql_query($consulta);       // hace la consulta
   	$nfilas = mysql_num_rows ($result);     //indica la cantidad de resultados
    $registro = mysql_fetch_row($result);   // toma el registro
    if ($nfilas == 0){     					// si existe el usuario inicia la sesion
		$fecha=$dia.$mes.$ano;
		$consulta = "call alta_talonario('$codigo_tt',$numero,$sucursal,$iteraciones,$primer_num,$ultimo_num,$sig_num,$fecha,'$impr','$cai')"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);   // hace la consulta
		//echo $consulta;
		echo "Talonario Registrado!!";
	}else{
		echo "ERROR: El Talonario ya existe";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_talonario.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_talonario";
	$plantilla = "alta_talonario.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>