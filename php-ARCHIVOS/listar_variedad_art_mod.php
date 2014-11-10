<?
if($codigo){
	include("conexion.php");
	
	$consulta = "SELECT cod_variedad FROM producto where cod_prod = $codigo and cod_variedad = $variedad and cod_marca = $marca and cod_grupo = $grupo"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_v= $registro[0];
	
	$consulta = "SELECT * FROM variedad order by cod_variedad"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_vari_mod' id='lista_vari_mod' class='caja'  onKeyUp='pasar_foco_art_1_mod(event,this.value)'>"; 
		do{
				$cod=$registro[0];
				$nombre=$registro[1];
				if ( $cod == $cod_v){
					echo "<option selected value=$cod>$cod</option>";
				}else{
					echo "<option value=$cod>$cod</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>