<? 
include("conexion.php");
$consulta = "SELECT * FROM localidad"; // consulta sql
$result = mysql_query($consulta);            // hace la consulta
$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
if ($nfilas > 0){     						 // si existen paises
	$nombre_zona = $_POST["nombre_zona"]; // toma la variable de la url q vino de ajax.js
	$nombre_loca = $_POST["nombre_loca"]; // toma la variable de la url q vino de ajax.js
	$porc_vta = $_POST["porc_vta"]; // toma la variable de la url q vino de ajax.js
	$porc_trans = $_POST["porc_trans"]; // toma la variable de la url q vino de ajax.js
	$nombre_zona = strtoupper($nombre_zona);
	if($nombre_loca){
		$consulta = "SELECT * FROM localidad where nombre = '$nombre_loca'"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$cod_loca= $registro[0];
		$cod_prov= $registro[1];
		$cod_pais= $registro[2];
		$consulta = "SELECT * FROM zona where nombre = '$nombre_zona' and cod_localidad = $cod_loca"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados

		if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
			$consulta = "call alta_zona($cod_loca,$cod_prov,$cod_pais,'$nombre_zona',$porc_vta,$porc_trans)"; // llama al procedimiento almacecnado
			$result = mysql_query($consulta);            // hace la consulta
			echo "Zona Registrada!!";
		}else{
			echo "ERROR: la Zona ya existe";
		}
	}else{
		require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
		$smarty = new ClaseSmarty; //crea una instancia
		
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_zonas_geo";
		$plantilla = "alta_zona.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	}
}else{
	echo "<div align='center' class='advertencia'>Imposible registrar zonas, antes debe registrar una localidad</div>";
}	
?>