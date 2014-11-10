<?
$codigo = $_POST["codigo"]; 					// toma la variable de la url q vino de ajax.js
$marca = $_POST["marca"]; 					// toma la variable de la url q vino de ajax.js
$grupo = $_POST["grupo"]; 					// toma la variable de la url q vino de ajax.js

if($codigo){
	include("conexion.php");
	$consulta = "SELECT cod_marca FROM variedad where cod_variedad = $codigo and cod_marca = $marca and cod_grupo = $grupo"; 	// consulta sql
	$result = mysql_query($consulta);            								// hace la consulta
	$registro = mysql_fetch_row($result);       								// toma el registro
	$cod_m= $registro[0];
	
	$consulta = "SELECT * FROM marca where cod_grupo = $grupo order by cod_marca"; 						// consulta sql 
	$result = mysql_query($consulta);            								// hace la consulta
	$registro = mysql_fetch_row($result);        								// toma el registro
	echo"<select name='lista_marca_mod' id='lista_marca_mod' class='caja'  onKeyUp='pasar_foco_vari_8(event,this.value)'>"; 
		do{
				$cod=$registro[0];
				$nombre=$registro[2];
				if ( $cod == $cod_m){
					echo "<option selected value=$cod>$nombre</option>";
				}else{
					echo "<option value=$cod>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); 							// obtengo los resultados 
	echo"</select>";
}
//--------------------------------//
if($cod_grupo){
	include("conexion.php");
	$consulta = "SELECT * FROM marca where cod_grupo = $cod_grupo"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_marca_mod' id='lista_marca_mod' class='caja'  onKeyUp='pasar_foco_vari_8(event,this.value)'>"; 
		do{
				$codigo=$registro[0];
				$nombre=$registro[2];
				echo "<option value=$codigo>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>