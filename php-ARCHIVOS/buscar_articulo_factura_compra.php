<? 
$codigo = $_GET["codigo"]; // toma la variable de la url q vino de ajax.js
$categoria = $_GET["categoria"]; // toma la variable de la url q vino de ajax.js
if($codigo){
	include("conexion.php");
	$consulta = "SELECT * FROM producto WHERE concat(cod_grupo, cod_marca, cod_variedad, cod_prod) = $codigo and activo = 'S'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        		// toma el registro
	if ($nfilas > 0){     						 		// si existe el usuario inicia la sesion
		$desc_art= $registro[4];
		$precio_art= $registro[5];
		
		header('Content-Type: text/xml'); 			// encabezado obligatorio XML
		echo "<articulos>\n"; 						// etiqueta superior
			echo '<desc_art>' . $desc_art . '</desc_art>';
			echo '<precio_art>' . $precio_art . '</precio_art>';         
			$error="0";
			echo '<error>' . $error . '</error>';
		echo "</articulos>";
	}else{
		header('Content-Type: text/xml'); 			// encabezado obligatorio XML
		echo "<articulos>\n"; 						// etiqueta superior
			$error="1";
			echo '<error>' . $error . '</error>';
		echo "</articulos>";	
	}
}else{
	require("smarty.php");  									// requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; 									//crea una instancia
	$smarty->display('buscar_articulo_factura_compra_pop_up.tpl');     //define la plantilla que utilizara
}	
?>