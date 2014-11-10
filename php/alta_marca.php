<? 
include("conexion.php");
$consulta = "SELECT * FROM grupo"; 											// consulta sql
$result = mysql_query($consulta);            								// hace la consulta
$nfilas = mysql_num_rows ($result);          								//indica la cantidad de resultados
if ($nfilas > 0){     						 								// si existen paises
	$codigo = $_POST["codigo"]; 									// toma la variable de la url q vino de ajax.js
	if($codigo){
		$nombre = $_POST["nombre"]; 									// toma la variable de la url q vino de ajax.js
		$grupo = $_POST["grupo"]; 
		$nombre = strtoupper($nombre);
		
		$consulta = "call alta_marca($codigo,'$nombre',$grupo)"; 	// llama al procedimiento almacecnado
    	if(	$result = mysql_query($consulta)){            					// hace la consulta
			echo "Marca Registrada!!";
		}else{
			echo "ERROR: la Marca ya existe";
		}
	}else{
		require("smarty.php");  											// requiere la pag "smarty.php"
		$smarty = new ClaseSmarty; 											//crea una instancia
		//$smarty->display('alta_marca.tpl');   							//define la plantilla que utilizara
		
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_articulo";
		$plantilla = "alta_marca.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}
}else{
	echo "<div align='center' class='advertencia'>Imposible Registrar Marcas, antes debe registrar un Grupo</div>";
}	
?>