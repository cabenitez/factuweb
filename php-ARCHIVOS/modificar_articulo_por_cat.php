<?
$codigo_cat = $_POST["codigo_cat"]; // toma la variable de la url q vino de ajax.js
if($codigo_cat){
	$codigo_prod_orig = $_POST["codigo_prod_orig"]; // toma la variable de la url q vino de ajax.js
	$variedad_orig = $_POST["variedad_orig"]; // toma la variable de la url q vino de ajax.js
	$marca_orig = $_POST["marca_orig"]; // toma la variable de la url q vino de ajax.js
	$grupo_orig = $_POST["grupo_orig"]; // toma la variable de la url q vino de ajax.js
	
	include("conexion.php");
	$consulta = "call modificar_prod_por_cat($codigo_cat,$codigo_prod,$variedad,$marca,$grupo,$precio_cat,$codigo_prod_orig,$variedad_orig,$marca_orig,$grupo_orig)"; // llama al procedimiento almacecnado
	$result = mysql_query($consulta);        // hace la consulta
	//echo $consulta;
}
?>