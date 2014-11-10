<? 
$descuento = $_POST["descuento"]; // toma la variable de la url q vino de ajax.js 
$minimo = $_POST["minimo"]; // toma la variable de la url q vino de ajax.js
if($descuento){
		if ($descuento == 'cero'){
			$descuento = 0;
		}
		if ($minimo == 'cero'){
			$minimo = 0;
		}
		
		include("conexion.php");
		$consulta = "call reiniciar_regular_comision()"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
		
		$consulta = "call actualizar_regular_comision($descuento,$minimo)"; // llama al procedimiento almacecnado
		//echo $consulta;
		$result = mysql_query($consulta);        // hace la consulta
		echo "Actualizacion Realizada!!";
}else{
		include("conexion.php");
		$consulta = "SELECT * FROM regular_comision"; 					// consulta sql
		$result = mysql_query($consulta);            					// hace la consulta
		$registro = mysql_fetch_row($result);        					// toma el registro
		$nfilas = mysql_num_rows ($result);          					// indica la cantidad de resultados
		if ($nfilas > 0){     						 					// si existen paises
			$descuento = $registro[0]; 									// toma la variable de la url q vino de ajax.js
			$minimo = $registro[1]; 									// toma la variable de la url q vino de ajax.js
		}else{
			$descuento = 0; 											// toma la variable de la url q vino de ajax.js
			$minimo = 0; 												// toma la variable de la url q vino de ajax.js
		}
				require("smarty.php");  											// requiere la pag "smarty.php"
				$smarty = new ClaseSmarty; 											//crea una instancia
				$smarty->assign('descuento',$descuento);  //asigna una cadena a la variable "nombre"
				$smarty->assign('minimo',$minimo);  //asigna una cadena a la variable "nombre"
				//$smarty->display('regular_comision.tpl');   							//define la plantilla que utilizara
				
				//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
				$modulo="comisiones";
				$plantilla = "regular_comision.tpl";
				include("validar_permiso.php");	
				//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>