<?
$fecha_carga = $_POST["fecha_carga"]; // toma la variable de la url q vino de ajax.js
$vendedor = $_POST["vendedor"]; // toma la variable de la url q vino de ajax.js

if($vendedor){
	include("conexion.php");
	$consulta = "select n_factura from factura_vta where fecha = $fecha_carga and cod_vendedor = $vendedor
				UNION
				select n_factura from factura_vta_no_cliente where fecha = $fecha_carga and cod_vendedor = $vendedor"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		echo 'existe';
	}
}
?>