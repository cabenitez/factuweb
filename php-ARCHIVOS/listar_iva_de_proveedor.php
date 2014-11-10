<?
if($cod_proveedor){
	include("conexion.php");
	
	$consulta = "SELECT cond_iva FROM proveedor where cod_proveedor = $cod_proveedor"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_iva= $registro[0];

	$consulta = "select * from iva where cuit = 'S' order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_iva_mod' id='lista_iva_mod' class='caja'  onKeyUp='pasar_foco_prove_29(event)'>";
		do{
				$codigo=$registro[0];
				$nombre=$registro[2];
				if ( $codigo == $cod_iva){
					echo "<option selected value=$codigo>$nombre</option>";
				}else{
					echo "<option value=$codigo>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>