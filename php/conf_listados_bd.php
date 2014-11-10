<? 
$filas = $_POST["filas"]; // toma la variable de la url q vino de ajax.js
$impresora = $_POST["impresora"]; // toma la variable de la url q vino de ajax.js
if($filas){
		include("conexion.php");
		$consulta = "call reiniciar_conf_listados()"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
		
		$consulta = "call actualizar_conf_listados($filas,'$impresora')"; // llama al procedimiento almacecnado
		//echo $consulta;
		$result = mysql_query($consulta);        // hace la consulta
		echo "Actualizacion Realizada!!";
}else{
		include("conexion.php");
		$consulta = "SELECT * FROM conf_listados"; 											// consulta sql
		$result = mysql_query($consulta);            								// hace la consulta
		$registro = mysql_fetch_row($result);        						// toma el registro
		$nfilas = mysql_num_rows ($result);          								//indica la cantidad de resultados
		if ($nfilas > 0){     						 								// si existen paises
			$lineas = $registro[0]; 									// toma la variable de la url q vino de ajax.js
		}else{
			$lineas = 10; 									// toma la variable de la url q vino de ajax.js
		}
				require("smarty.php");  											// requiere la pag "smarty.php"
				$smarty = new ClaseSmarty; 											//crea una instancia
				$smarty->assign('lineas',$lineas);  //asigna una cadena a la variable "nombre"
				//$smarty->display('conf_listados_bd.tpl');   							//define la plantilla que utilizara
				
				//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
				$modulo="conf_listados";
				$plantilla = "conf_listados_bd.tpl";
				include("validar_permiso.php");	
				//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>