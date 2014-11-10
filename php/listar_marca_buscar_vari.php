<?
if($cod_grupo){
	include("conexion.php");
	$consulta = "SELECT * FROM marca"; // consulta sql 
	if($cod_grupo != "TODOS"){
			$consulta .=" where cod_grupo = $cod_grupo";
	}
	
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_marca' id='lista_marca' class='caja' onkeyup='pasar_foco_vari_4(event)'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		echo "<option value='TODOS'>TODOS</option>";
		do{
				$codigo=$registro[0];
				$nombre=$registro[2];
				echo "<option value=$codigo>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}else{
	echo"<select name='lista_marca' id='lista_marca' class='caja'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		echo "<option value='TODOS'>TODOS</option>";
	echo"</select>";
}
?>