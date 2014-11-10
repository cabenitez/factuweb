<?
if($cod_cond_iva){
	include("conexion.php");
	
	$consulta = "SELECT cod_talonario FROM iva where cod_iva = $cod_cond_iva"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_iva = $registro[0];
	//echo $consulta;
	$consulta = "SELECT * FROM tipo_talonario order by descripcion"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_comp_mod' id='lista_comp_mod' class='caja' onKeyUp='pasar_foco_cond_iva_5(event)'>"; //onKeyUp='pasar_foco_zona_mod_lista(event)'
		do{
				$codigo=$registro[0];
				$nombre=$registro[1];
				if ( $codigo == $cod_iva){
					echo "<option selected value=$codigo>$nombre</option>";
				}else{
					echo "<option value=$codigo>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>