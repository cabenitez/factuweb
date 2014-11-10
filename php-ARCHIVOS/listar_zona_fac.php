<?
include("conexion.php");
if($codigo){
	$consulta = "SELECT cod_zona FROM cliente where cod_cliente = $codigo"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_zona= $registro[0];
	
	$consulta = "select cod_zona, zona.nombre, zona.cod_localidad, localidad.nombre from zona inner join localidad where localidad.cod_localidad=zona.cod_localidad order by zona.nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_zona' id='lista_zona' disabled='disabled' class='caja' onKeyUp='pasar_foco_rem_vta_4a(event)'>"; 
		do{
				$codigo=$registro[0];
				$nombre=$registro[1];
				$cod_loca=$registro[2];
				$nombre_loca=$registro[3];
				if ( $cod_zona == $codigo){
					echo "<option selected value=$codigo id=$nombre title='$nombre_loca'>$nombre</option>";
				}else{
					echo "<option value=$codigo id=$nombre title='$nombre_loca'>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}else{
	include("conexion.php");
	$consulta = "select cod_zona, zona.nombre, zona.cod_localidad, localidad.nombre from zona inner join localidad where localidad.cod_localidad=zona.cod_localidad order by zona.nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_zona'  id='lista_zona' class='caja'onKeyUp='pasar_foco_rem_vta_4a(event)'>"; 
		do{
				$codigo=$registro[0];
				$nombre=$registro[1];
				$cod_loca=$registro[2];
				$nombre_loca=$registro[3];
				echo "<option value=$codigo id=$nombre title='$nombre_loca'>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>