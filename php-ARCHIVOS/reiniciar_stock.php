<? 
//session_start();   											// Iniciar sesión
//$usuario_stock = $_SESSION['user_usuario']; 			//usuario conectado
												
$reiniciar = $_POST["reiniciar"]; 								// toma la variable de la url q vino de ajax.js
if($reiniciar == 'ok'){ 
		include("conexion.php");

		$consulta = "update producto set stock_actual = 10";	// consulta en la base de datos si ya no se ha registrado el stock inicial
		$result = mysql_query($consulta);            			// hace la consulta
		
		$consulta = "select cod_prod from producto";	 		// consulta en la base de datos si ya no se ha registrado el stock inicial
		$result = mysql_query($consulta);            			// hace la consulta
		$nfilas = mysql_num_rows ($result);          			// indica la cantidad de resultados
		
		if ($nfilas > 0){     						 			// si existe el usuario inicia la sesion
			echo "Se ha reiniciado el Stock de $nfilas Articulos";
		}else{
			echo "ERROR: No se pudo reinicar el Stock";
		}
				
}else{ 
		require("smarty.php");  				 				// requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; 				 				// crea una instancia
		
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$plantilla = "reiniciar_stock.tpl"; 
		$modulo="stock";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
}
?>