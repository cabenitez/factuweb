<?
if($cod_repartidor){
	include("conexion.php");

	$consulta = "SELECT cod_prov FROM fletero where cod_flero = $cod_repartidor"; // determina el codigo de la provincia del proveedor
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_prov= $registro[0];

	$consulta = "SELECT * FROM provincia order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_prov_mod' id='lista_prov_mod' class='caja'  onKeyUp='pasar_foco_prove_32(event,this.value)'>";
		do{
				$codigo=$registro[0];
				$nombre=$registro[2];
				if ( $codigo == $cod_prov){
					echo "<option selected value=$codigo>$nombre</option>";
				}else{
					echo "<option value=$codigo>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
if($cod_pais){
	include("conexion.php");
	$consulta = "SELECT * FROM provincia where cod_pais = $cod_pais"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_prov_mod' id='lista_prov_mod' class='caja'  onKeyUp='pasar_foco_prove_32(event,this.value)'>";
		do{
				$codigo=$registro[0];
				$nombre=$registro[2];
				echo "<option value=$codigo>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados
	echo"</select>";
}
?>