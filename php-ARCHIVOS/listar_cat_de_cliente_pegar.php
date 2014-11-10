<?
if($cod_cliente){
	include("conexion.php");
	
	$consulta = "SELECT cod_categoria FROM cliente where cod_cliente = $cod_cliente"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_cat= $registro[0];
	
	$consulta = "SELECT * FROM categoria order by descripcion"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_cat' id='lista_cat' class='caja'  onKeyUp='pasar_foco_clie_17(event)'>"; 
		do{
				$codigo=$registro[0]; 
				$nombre=$registro[1];
				if ( $codigo == $cod_cat){
					echo "<option selected value=$codigo>$nombre</option>";
				}else{
					echo "<option value=$codigo>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>