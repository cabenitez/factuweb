<? 
include("conexion.php");
$consulta = "SELECT * FROM provincia"; // consulta sql
$result = mysql_query($consulta);            // hace la consulta
$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
if ($nfilas > 0){     						 // si existen paises
	$nombre_loca = $_POST["nombre_loca"]; // toma la variable de la url q vino de ajax.js
	$cp_loca = $_POST["cp_loca"]; // toma la variable de la url q vino de ajax.js
	$nombre_prov = $_POST["nombre_prov"]; // toma la variable de la url q vino de ajax.js
	$nombre_loca = strtoupper($nombre_loca);
	if($nombre_loca){
		$consulta = "SELECT * FROM provincia where nombre = '$nombre_prov'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_prov= $registro[0];
		$cod_pais= $registro[1];
		
		$consulta = "SELECT * FROM localidad where nombre = '$nombre_loca' and cod_prov = $cod_prov"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados

		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			$consulta = "call alta_localidad($cod_prov,$cod_pais,'$nombre_loca',$cp_loca)"; // llama al procedimiento almacecnado
			$result = mysql_query($consulta);            // hace la consulta
			echo "Localidad Registrada!!";
		}else{
			echo "ERROR: la Localidad ya existe";
		}
	}else{
		require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; //crea una instancia

		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_zonas_geo";
		$plantilla = "alta_localidad.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}
}else{
	echo "<div align='center' class='advertencia'>Imposible registrar localidades, antes debe registrar una provincia</div>";
}	
?>