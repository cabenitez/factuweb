<?
include("conexion.php");
if($codigo){
	$consulta = "SELECT cod_categoria FROM cliente where cod_cliente = $codigo"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_cat= $registro[0];
	
	$consulta = "SELECT * FROM categoria order by descripcion"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_cat' id='lista_cat' class='select_1' onKeyUp='pasar_foco_rem_vta_10a(event)'>"; 
		do{
				$cod_categoria=$registro[0];
				$nombre=$registro[1];
				if ( $cod_cat == $cod_categoria){
					echo "<option selected value=$cod_categoria>$nombre</option>";
				}else{
					echo "<option value=$cod_categoria>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}else{
	$consulta = "SELECT * FROM categoria order by descripcion"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_cat' id='lista_cat' class='select_1' onKeyUp='pasar_foco_rem_vta_10a(event)'>"; 
		do{
				$cod_categoria=$registro[0];
				$nombre=$registro[1];
				echo "<option value=$cod_categoria>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}	
?>