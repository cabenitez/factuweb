<?
if($cod_marca){
	include("conexion.php");
	$consulta = "SELECT * FROM variedad where cod_grupo = $grupo and cod_marca = $cod_marca order by cod_variedad"; // consulta sql 
	//echo $consulta;
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_variedad' id='lista_variedad' class='caja' onkeyup='pasar_foco_art_1(event)'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		do{
				$codigo=$registro[0];
				$nombre=$registro[3];
				echo "<option value=$codigo title='$nombre'>$codigo</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}else{
	echo"<select name='lista_variedad' id='lista_variedad' class='caja'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		echo "<option value='nulo'>-- seleccione marca --</option>";
	echo"</select>";
}
?>