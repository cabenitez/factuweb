<?
if($cod_cliente){
	include("conexion.php");
	
	$movimiento = 0;
	$consulta = "SELECT n_factura FROM factura_vta where cod_cliente = $cod_cliente"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	if($nfilas > 0){
		$movimiento = 1;
	}
	
	$consulta2 = "SELECT num_remito FROM remito_vta where cod_cliente = $cod_cliente"; // consulta sql
	$result2 = mysql_query($consulta2);            // hace la consulta
   	$nfilas2 = mysql_num_rows ($result2);          //indica la cantidad de resultados
	if($nfilas2 > 0){
		$movimiento = 1;
	}

	
	$consulta = "SELECT cod_iva FROM cliente where cod_cliente = $cod_cliente"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_iva= $registro[0];

	$consulta = "select * from iva order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            	 // hace la consulta
	$registro = mysql_fetch_row($result);        	 // toma el registro
	if($movimiento == 0){
		echo"<select name='lista_iva_mod' id='lista_iva_mod' class='caja'  onKeyUp='pasar_foco_clie_2_a_mod(event)'>";
	}else{
		echo"<select name='lista_iva_mod' id='lista_iva_mod' class='caja'  disabled='disabled' onKeyUp='pasar_foco_clie_2_a_mod(event)'>";
	}	
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