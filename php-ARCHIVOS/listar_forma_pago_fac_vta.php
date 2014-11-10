<?
include("conexion.php");
if($codigo){
	$consulta = "SELECT cod_fp FROM cliente where cod_cliente = $codigo"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_forma_pago = $registro[0];
	
	$consulta = "SELECT * FROM forma_pago order by descripcion"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_forma_pago' id='lista_forma_pago' class='select_1' onKeyUp='pasar_foco_fac_vta_15(event)'>"; 
		do{
				$cod_fp=$registro[0];
				$nombre=$registro[1];
				if ( $cod_fp == $cod_forma_pago){
					echo "<option selected value=$cod_fp>$nombre</option>";
				}else{
					echo "<option value=$cod_fp>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}else{
	$consulta = "SELECT * FROM forma_pago order by descripcion"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_forma_pago' id='lista_forma_pago' class='select_1' onKeyUp='pasar_foco_fac_vta_15(event)'>"; 
		do{
				$cod_fp=$registro[0];
				$nombre=$registro[1];
				echo "<option value=$cod_fp>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>