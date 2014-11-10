<?
if($codigo){
	include("conexion.php");
	
	$consulta = "SELECT cod_proveedor FROM producto where cod_prod = $codigo and cod_variedad = $variedad and cod_marca = $marca and cod_grupo = $grupo"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_p= $registro[0];
	
	$consulta = "SELECT * FROM proveedor order by cod_proveedor"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_prov_mod' id='lista_prov_mod' class='caja'  onKeyUp='pasar_foco_art_4_mod(event,this.value)'>"; 
		do{
				$cod=$registro[0];
				$nombre=$registro[1];
				if ( $cod == $cod_p){
					echo "<option selected value=$cod>$nombre</option>";
				}else{
					echo "<option value=$cod>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>