<?
include("conexion.php");
if($codigo){
	$consulta = "SELECT * FROM categoria order by descripcion"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	echo"<select name='lista_cat' id='lista_cat' class='select_1' onKeyUp='pasar_foco_rem_vta_10a(event)'>"; 
		do{
				$cod_categoria=$registro[0];
				$nombre=$registro[1];
				if ( $codigo == $cod_categoria){
					echo "<option selected value=$cod_categoria>$nombre</option>";
				}
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
}
?>