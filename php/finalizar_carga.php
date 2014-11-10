<? 
session_start();   															 // Iniciar sesión
$usuario_carga = $_SESSION['user_usuario']; 						 //usuario conectado
$nombre_usuario_carga = $_SESSION["nombre_usuario"];                 // toma el campo nombre de la BD

$repartidor = $_POST["repartidor"]; // toma la variable de la url q vino de ajax.js
$hora_actual = $_POST["hora_actual"]; // toma la variable de la url q vino de ajax.js

if($repartidor){
	include("conexion.php");
	$fecha_actual=date("Y",time()).date("m",time()).date("d",time());
	
	$consulta = "SELECT * FROM cargas where cod_flero = $repartidor and fecha = $fecha_actual"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    $registro = mysql_fetch_row($result);        // toma el registro
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$consulta = "call finalizar_carga($repartidor,$fecha_actual,'$hora_actual','$usuario_carga')"; // llama al procedimiento almacecnado
		if($result = mysql_query($consulta)){        // hace la consulta
			$consulta = "SELECT nombre FROM fletero where cod_flero = $repartidor"; // consulta sql
			$result = mysql_query($consulta);            // hace la consulta
			$registro = mysql_fetch_row($result);        // toma el registro
			$nombre_fletero = $registro[0];
			
			// ================= Imprimir el Informe =========================== //
			include('imprimir_carga_articulos.php');
			include('imprimir_carga_caja.php');
			
			//$destino = 1;
			//include('exportar_carga_articulos.php');
			//include('exportar_carga_caja.php');
			
			echo "Carga Finalizada!!";
		}else{
			echo "ERROR: La Carga ya ha sido Finalizada";
		}	
	}else{
		echo "ERROR: La Carga ya ha sido Finalizada";
	}

}else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('finalizar_carga.tpl');   //define la plantilla que utilizara  
	
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="finalizar_carga";
	$plantilla = "finalizar_carga.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>