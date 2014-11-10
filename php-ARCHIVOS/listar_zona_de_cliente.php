<?
if($cod_cliente){
	include("conexion.php");
	
	$consulta = "SELECT cod_zona FROM cliente where cod_cliente = $cod_cliente"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_zona= $registro[0];
	
	$consulta = "SELECT * FROM zona order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_zona_mod' id='lista_zona_mod' class='caja' onKeyUp='pasar_foco_clie_23_mod(event)'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		do{
				$codigo=$registro[0];
				$nombre=$registro[4];
				if ( $codigo == $cod_zona){
					echo "<option selected value=$codigo>$nombre</option>";
				}else{
					echo "<option value=$nombre>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
if($cod_loca){
	include("conexion.php");
	$consulta = "SELECT * FROM zona where cod_localidad = $cod_loca"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_zona=$registro[0];

	echo"<select name='lista_zona_mod' id='lista_zona_mod' class='caja' onKeyUp='pasar_foco_clie_23_mod(event)'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		do{
				$codigo=$registro[0];
				$nombre=$registro[4];
				echo "<option value=$nombre>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";

}
?>