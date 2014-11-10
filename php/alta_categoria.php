<? 
$nombre = $_POST["nombre"]; // toma la variable de la url q vino de ajax.js

if($nombre){
	include("conexion.php");
	$nombre = strtoupper($nombre);
	$consulta = "SELECT * FROM categoria where descripcion = '$nombre'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    //$registro = mysql_fetch_row($result);        // toma el registro
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		$consulta = "call alta_categoria('$nombre')"; // llama al procedimiento almacecnado
		$result = mysql_query($consulta);        // hace la consulta
		
        // registro el precio para cada articulo en la categoria
		$consulta2 = "SELECT cod_categoria FROM categoria where descripcion = '$nombre'"; // consulta sql
		$result2 = mysql_query($consulta2);            // hace la consulta
		$registro2 = mysql_fetch_row($result2);        // toma el registro
		$codigo_cat = $registro2[0];
        
		$consulta3 = "SELECT cod_prod, cod_variedad, cod_marca, cod_grupo  FROM producto"; // consulta sql
		$result3 = mysql_query($consulta3);            // hace la consulta

		while($registro3 = mysql_fetch_array($result3)){ 	// obtengo los resultados 
			$cod_prod = $registro3[0];
			$cod_variedad = $registro3[1];
			$cod_marca = $registro3[2];
			$cod_grupo = $registro3[3];
			$consulta4 = "call alta_prod_por_cat($codigo_cat,$cod_prod,$cod_variedad,$cod_marca,$cod_grupo,0)"; // llama al procedimiento almacecnado
			$result4 = mysql_query($consulta4);        // hace la consulta
		
		}		
		// FIN DE registro el precio para cada articulo en la categoria
		
		//echo $consulta;
		echo "Categoria Registrada!!";
	}else{
		echo "ERROR: La Categoria ya existe";
	}
}
else{
	require("smarty.php");  // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; //crea una instancia
	//$smarty->display('alta_categoria.tpl');   //define la plantilla que utilizara

	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="abm_categoria";
	$plantilla = "alta_categoria.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>