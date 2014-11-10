<?
include("conexion.php");
$codigo_articulo = $_POST["codigo_articulo"]; 					// toma la variable de la url q vino de ajax.js

$consulta_devolucion_detalle =  "select cod_prod from devolucion_detalle where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $codigo_articulo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
$result_devolucion_detalle = mysql_query($consulta_devolucion_detalle);            // hace la consulta
$nfilas_devolucion_detalle = mysql_num_rows ($result_devolucion_detalle);          //indica la cantidad de resultados

$consulta_factura_compra_detalle =  "select cod_prod from factura_compra_detalle where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $codigo_articulo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
$result_factura_compra_detalle = mysql_query($consulta_factura_compra_detalle);            // hace la consulta
$nfilas_factura_compra_detalle = mysql_num_rows ($result_factura_compra_detalle);          //indica la cantidad de resultados

$consulta_remito_vta_detalle =  "select cod_prod from remito_vta_detalle where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $codigo_articulo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
$result_remito_vta_detalle = mysql_query($consulta_remito_vta_detalle);            // hace la consulta
$nfilas_remito_vta_detalle = mysql_num_rows ($result_remito_vta_detalle);          //indica la cantidad de resultados

$consulta_factura_vta_detalle =  "select cod_prod from factura_vta_detalle where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $codigo_articulo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
$result_factura_vta_detalle = mysql_query($consulta_factura_vta_detalle);            // hace la consulta
$nfilas_factura_vta_detalle = mysql_num_rows ($result_factura_vta_detalle);          //indica la cantidad de resultados

$consulta_factura_vta_no_cliente_detalle =  "select cod_prod from factura_vta_no_cliente_detalle where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $codigo_articulo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
$result_factura_vta_no_cliente_detalle = mysql_query($consulta_factura_vta_no_cliente_detalle);            // hace la consulta
$nfilas_factura_vta_no_cliente_detalle = mysql_num_rows ($result_factura_vta_no_cliente_detalle);          //indica la cantidad de resultados


$consulta_remito_vta_detalle_no_cliente =  "select cod_prod from remito_vta_detalle_no_cliente where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $codigo_articulo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
$result_remito_vta_detalle_no_cliente = mysql_query($consulta_remito_vta_detalle_no_cliente);            // hace la consulta
$nfilas_remito_vta_detalle_no_cliente = mysql_num_rows ($result_remito_vta_detalle_no_cliente);          //indica la cantidad de resultados


$consulta_prod_por_categ =  "select cod_prod from prod_por_categ where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $codigo_articulo";	 // consulta en la base de datos si ya no se ha registrado el stock inicial
$result_prod_por_categ = mysql_query($consulta_prod_por_categ);            // hace la consulta
$nfilas_prod_por_categ = mysql_num_rows ($result_prod_por_categ);          //indica la cantidad de resultados
 
if ( $nfilas_devolucion_detalle == 0 && $nfilas_factura_compra_detalle == 0 && $nfilas_remito_vta_detalle == 0 && $nfilas_factura_vta_detalle == 0 && $nfilas_factura_vta_no_cliente_detalle == 0 && $nfilas_remito_vta_detalle_no_cliente == 0 ){ 
	echo "NO";
}else{
	echo "SI";
}

?>