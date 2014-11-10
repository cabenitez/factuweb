<? 
include("conexion.php");
$consulta = "SELECT * FROM pais"; 											// consulta sql
$result = mysql_query($consulta);            								// hace la consulta
$nfilas = mysql_num_rows ($result);          								//indica la cantidad de resultados
if ($nfilas > 0){     						 								// si existen paises
	$nombre_prov = $_POST["nombre_prov"]; 									// toma la variable de la url q vino de ajax.js
	$nombre_pais = $_POST["nombre_pais"]; 									// toma la variable de la url q vino de ajax.js
	$nombre_prov = strtoupper($nombre_prov);
	if($nombre_prov){
		$consulta = "SELECT * FROM pais where nombre = '$nombre_pais'"; 	// consulta sql
		$result = mysql_query($consulta);            						// hace la consulta
		$registro = mysql_fetch_row($result);        						// toma el registro
		$cod_pais= $registro[0];
		
		$consulta = "SELECT * FROM provincia where nombre = '$nombre_prov' and cod_pais = $cod_pais"; // consulta sql
		$result = mysql_query($consulta);            						// hace la consulta
		$nfilas = mysql_num_rows ($result);          						//indica la cantidad de resultados

		if ($nfilas == 0){     						 
			$consulta = "call alta_provincia($cod_pais,'$nombre_prov')"; 	// llama al procedimiento almacecnado
    		$result = mysql_query($consulta);            					// hace la consulta
			echo "Provincia Registrada!!";
		}else{
			echo "ERROR: la Provincia ya existe";
		}
	}else{
		require("smarty.php");  											// requiere la pag "smarty.php"
		$smarty = new ClaseSmarty; 											//crea una instancia
		
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
		$modulo="abm_zonas_geo";
		$plantilla = "alta_provincia.tpl";
		include("validar_permiso.php");	
		//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

	}
}else{
	echo "<div align='center' class='advertencia'>Imposible Registrar Provincias, antes debe registrar un Pais</div>";
}	
?>