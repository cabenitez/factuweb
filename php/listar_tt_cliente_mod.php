<?
if($cod_cliente){
	include("conexion.php");
	$consulta = "SELECT cod_talonario FROM cliente where cod_cliente = $cod_cliente "; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_tal= $registro[0];
	
	$consulta = "SELECT * FROM tipo_talonario where descripcion like '%fac%' or descripcion like '%FAC%' order by descripcion"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_tt_mod' id='lista_tt_mod' class='caja'  onKeyUp='pasar_foco_clie_27_mod(event,this.value)'>"; 
		do{
				$codigo=$registro[0];
				$nombre=$registro[1];
				if ( $codigo == $cod_tal){
					echo "<option selected value=$codigo>$nombre</option>";
				}else{
					echo "<option value=$codigo>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>