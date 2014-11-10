<?
$sucursal = $_POST["sucursal"]; // toma la variable de la url q vino de ajax.js
$factura = $_POST["factura"]; // toma la variable de la url q vino de ajax.js
if($factura){
	include("conexion.php");
	$consulta = "SELECT * FROM factura_compra where n_factura = $factura and n_sucursal =  $sucursal"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
    if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
		echo "no_existe";
	}else{
		echo "existe";
	}
}


?>