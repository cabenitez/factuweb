<?
if($cod_grupo){
	include("conexion.php");
	$consulta = "SELECT * FROM marca where cod_grupo = $cod_grupo"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_marca' id='lista_marca' class='caja' onkeyup='listar_vari_de_marca(event,this.value)'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		do{
				$codigo=$registro[0];
				$grupo=$registro[1];
				$nombre=$registro[2];
				echo "<option value=$codigo id=$grupo title='$nombre'>$codigo</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}else{
	echo"<select name='lista_marca' id='lista_marca' class='caja'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		echo "<option value='nulo'>-- seleccione grupo --</option>";
	echo"</select>";
}
?>