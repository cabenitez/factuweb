<?
if($cod_cliente){
	include("conexion.php");
	
	$consulta = "SELECT cod_flero FROM cliente where cod_cliente = $cod_cliente"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_ven= $registro[0];
	
	$consulta = "SELECT * FROM fletero order by cod_flero"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_rep_mod' id='lista_rep_mod' class='caja'  onKeyUp='pasar_foco_clie_26_mod(event,this.value)'>"; 
		do{
				$codigo=$registro[0];
				$nombre=$registro[2];
				if ( $codigo == $cod_ven){
					echo "<option selected value=$codigo title='$nombre'>$codigo</option>";
				}else{
					echo "<option value=$codigo title='$nombre'>$codigo</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>