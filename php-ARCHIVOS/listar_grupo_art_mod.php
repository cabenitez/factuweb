<?
if($codigo){
	include("conexion.php");
	
	$consulta = "SELECT cod_grupo FROM producto where cod_prod = $codigo and cod_variedad = $variedad and cod_marca = $marca and cod_grupo = $grupo"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_g= $registro[0];
	
	$consulta = "SELECT * FROM grupo order by cod_grupo"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_grupo_mod' id='lista_grupo_mod' class='caja' onKeyUp='listar_marca_de_grupo_mod(event,this.value)'>"; 
		do{
				$cod=$registro[0];
				$nombre=$registro[1];
				if ( $cod == $cod_g){
					echo "<option selected value=$cod title='$nombre'>$cod</option>";
				}else{
					echo "<option value=$cod title='$nombre'>$cod</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>