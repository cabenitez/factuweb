<?
$codigo_cat = $_POST["codigo_cat"]; // toma la variable de la url q vino de ajax.js
if($codigo_cat){
	include("conexion.php");
	$precio_cat = number_format($precio_cat,2,'.','');
	$consulta = "call alta_prod_por_cat($codigo_cat,$codigo_prod,$variedad,$marca,$grupo,$precio_cat)"; // llama al procedimiento almacecnado
	$result = mysql_query($consulta);        // hace la consulta
	//echo $consulta;
}
?>