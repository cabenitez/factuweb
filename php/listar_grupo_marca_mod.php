<?
if($codigo){
	include("conexion.php");
	$grupo = $_POST["grupo"]; 							// toma la variable de la url q vino de ajax.js
	$consulta = "SELECT cod_grupo FROM marca where cod_marca = $codigo and cod_grupo = $grupo"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	$cod_g= $registro[0];
	
	$consulta = "SELECT * FROM grupo order by cod_grupo"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_grupo_mod' id='lista_grupo_mod' class='caja'  onKeyUp='pasar_foco_marca_6(event,this.value)'>"; 
		do{
				$cod=$registro[0];
				$nombre=$registro[1];
				if ( $cod == $cod_g){
					echo "<option selected value=$cod>$nombre</option>";
				}else{
					echo "<option value=$cod>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>