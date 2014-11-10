<?
if($cod_cliente){
	include("conexion.php");
	
	$consulta = "SELECT cod_localidad FROM cliente where cod_cliente = $cod_cliente"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_loca= $registro[0];
	
	$consulta = "SELECT * FROM localidad order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_loca_mod' id='lista_loca_mod' class='caja' onKeyUp='pasar_foco_clie_22_mod(event,this.value)'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		do{
				$codigo=$registro[0];
				$nombre=$registro[3];
				if ( $codigo == $cod_loca){
					echo "<option selected value=$codigo>$nombre</option>";
				}else{
					echo "<option value=$codigo>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
if($cod_prov){
	include("conexion.php");
	$consulta = "SELECT * FROM localidad where cod_prov = $cod_prov"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_loca_mod' id='lista_loca_mod' class='caja' onKeyUp='pasar_foco_clie_22_mod(event,this.value)'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		do{
				$codigo=$registro[0];
				$nombre=$registro[3];
				echo "<option value=$codigo>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>