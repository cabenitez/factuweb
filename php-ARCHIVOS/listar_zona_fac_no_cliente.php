<?
include("conexion.php");
if($codigo){
	$consulta = "select cod_zona, zona.nombre, zona.cod_localidad, localidad.nombre from zona inner join localidad where localidad.cod_localidad=zona.cod_localidad order by zona.nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_zona' id='lista_zona' disabled='disabled' class='caja' onKeyUp='pasar_foco_rem_vta_4a(event)'>"; 
		do{
				$cod_zona=$registro[0];
				$nombre=$registro[1];
				$cod_loca=$registro[2];
				$nombre_loca=$registro[3];
				if ( $cod_zona == $codigo){
					echo "<option selected value=$cod_zona id=$nombre title='$nombre_loca'>$nombre</option>";
				}else{
					echo "<option value=$cod_zona id=$nombre title='$nombre_loca'>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>