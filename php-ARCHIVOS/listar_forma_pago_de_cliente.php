<?
if($cod_cliente){
	include("conexion.php");
	
	$consulta = "SELECT cod_fp FROM cliente where cod_cliente = $cod_cliente"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_fp= $registro[0];
	
	$consulta = "SELECT * FROM forma_pago order by descripcion"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_forma_pago_mod' id='lista_forma_pago_mod' class='caja'  onKeyUp='pasar_foco_clie_27_mod(event)'>"; 
		do{
				$codigo=$registro[0];
				$nombre=$registro[1];
				if ( $codigo == $cod_fp){
					echo "<option selected value=$codigo>$nombre</option>";
				}else{
					echo "<option value=$codigo>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>