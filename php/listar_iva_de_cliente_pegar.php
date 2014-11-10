<?
if($cod_cliente){
	include("conexion.php");
	
	$consulta = "SELECT cod_iva FROM cliente where cod_cliente = $cod_cliente"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_iva= $registro[0];

	$consulta = "select * from iva order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            	 // hace la consulta
	$registro = mysql_fetch_row($result);        	 // toma el registro
	echo"<select name='lista_iva' id='lista_iva' class='caja'  onKeyUp='pasar_foco_clie_6(event)'>"; 
	do{
			$cod=$registro[0];
			$nombre=$registro[2];
			$cuit=$registro[3];				
			if ( $cod == $cod_iva){
				echo "<option selected value=$cod id=$cuit >$nombre</option>";
			}else{
				echo "<option value=$cod id=$cuit >$nombre</option>";
			}
	}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>