<?
session_start();   															 // Iniciar sesión
$usuario_anular = $_SESSION['user_usuario']; 						 //usuario conectado

$vendedor = $_POST["vendedor"]; // toma la variable de la url q vino de ajax.js
$fecha_desde = $_POST["fecha_desde"]; 	// toma la variable de la url q vino de ajax.js
$fecha_hasta = $_POST["fecha_hasta"]; 	// toma la variable de la url q vino de ajax.js
if($vendedor){
	include("conexion.php");
	$nfilas = 0;
	$consulta = "SELECT * FROM comision_vendedor WHERE cod_vendedor = $vendedor AND fecha_desde >= $fecha_desde AND fecha_hasta <= $fecha_hasta ";
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			$dia=substr($fecha,0,2);
			$mes=substr($fecha,3,2);
			$ano=substr($fecha,-4);
			$fecha = $ano.$mes.$dia;
			$consulta = "call liquidar_comision_vendedor($vendedor,$fecha_desde,$fecha_hasta,$fecha)"; // llama al procedimiento almacecnado
			
			if(	$result = mysql_query($consulta)){            					// hace la consulta
				echo"ok";
			}else{
				echo"error";
			}		
    }else{
			echo"error";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('comision_vendedor.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="comisiones";
	$plantilla = "comision_vendedor.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>