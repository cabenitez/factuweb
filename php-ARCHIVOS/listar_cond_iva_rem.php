<?
if($cod_iva){
	include("conexion.php");
	
	$consulta = "select * from iva order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            	 // hace la consulta
	$registro = mysql_fetch_row($result);        	 // toma el registro
	echo"<select name='lista_iva' disabled='disabled' id='lista_iva' class='caja'  onKeyUp='pasar_foco_rem_vta_5(event)'>";
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
}else{
	include("conexion.php");
	$consulta = "select * from iva order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_iva'  id='lista_iva' class='caja'onKeyUp='pasar_foco_rem_vta_5(event)'>"; 
		do{
				$codigo=$registro[0];
				$nombre=$registro[2];
				$cuit=$registro[3];
				echo "<option value=$codigo id=$cuit >$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>