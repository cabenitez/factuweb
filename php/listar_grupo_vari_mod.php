<?
$codigo = $_POST["codigo"]; 					// toma la variable de la url q vino de ajax.js
$marca = $_POST["marca"]; 					// toma la variable de la url q vino de ajax.js
$grupo = $_POST["grupo"]; 					// toma la variable de la url q vino de ajax.js

if($codigo){
	include("conexion.php");
	$consulta = "SELECT cod_grupo FROM variedad where cod_variedad = $codigo and cod_marca = $marca and cod_grupo = $grupo"; 	// consulta sql
	$result = mysql_query($consulta);            								// hace la consulta
	$registro = mysql_fetch_row($result);        								// toma el registro
	$cod_g= $registro[0];
	
	$consulta = "SELECT * FROM grupo order by cod_grupo"; 						// consulta sql 
	$result = mysql_query($consulta);            								// hace la consulta
	$registro = mysql_fetch_row($result);        								// toma el registro
	echo"<select name='lista_grupo_mod' id='lista_grupo_mod' class='caja'  onKeyUp='pasar_foco_vari_7(event,this.value)'>"; 
		do{
				$cod=$registro[0];
				$nombre=$registro[1];
				if ( $cod == $cod_g){
					echo "<option selected value=$cod>$nombre</option>";
				}else{
					echo "<option value=$cod>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); 							// obtengo los resultados 
	echo"</select>";
}
?>