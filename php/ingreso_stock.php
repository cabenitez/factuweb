<? 
session_start();   										// Iniciar sesión
$usuario_stock = $_SESSION['user_usuario']; 	//usuario conectado
												
$registrar = $_POST["registrar"]; 		// toma la variable de la url q vino de ajax.js
if($registrar == 'ok'){ 
		include("conexion.php");

		$dia_stock=date("d",time());  //asigna una cadena a la variable "dia"
		$mes_stock=date("m",time());  //asigna una cadena a la variable "mes"
		$ano_stock=date("Y",time());  //asigna una cadena a la variable "año"
		$fecha_stock="$ano_stock$mes_stock$dia_stock";

		$consulta = "select * from stock_inicial";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
		$result = mysql_query($consulta);            // hace la consulta
		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
				$consulta = "call alta_ingreso_stock($fecha_stock,'$usuario_stock')"; 				
				if ($result == mysql_query($consulta)){
						echo "ok";
				}
		}else{
			echo "error_existe";
		}
				
}else{ 
		require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 //crea una instancia

		include("conexion.php");
		$consulta = "select * from stock_inicial";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
		$result = mysql_query($consulta);            // hace la consulta
		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			//$smarty->display('ingreso_stock.tpl');   //define la plantilla que utilizara
			$plantilla = "ingreso_stock.tpl";
		}else{
			//$smarty->display('error_ingreso_stock.tpl');   //define la plantilla que utilizara
			$plantilla = "error_ingreso_stock.tpl";
		}

	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="stock";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	
	
}
?>