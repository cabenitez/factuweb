<?
if($cod_pais){
	include("conexion.php");
	$consulta = "SELECT * FROM provincia where cod_pais = $cod_pais order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_provincia' id='lista_provincia' class='caja' onkeyup='listar_loca_de_prov(event,this.value)'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		do{
				$codigo=$registro[0];
				$nombre=$registro[2];
				echo "<option value=$codigo>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}else{
	echo"<select name='lista_provincia' id='lista_provincia' class='caja'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		echo "<option value='nulo'>-- seleccione pais --</option>";
	echo"</select>";
}
?>