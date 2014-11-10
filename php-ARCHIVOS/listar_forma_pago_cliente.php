<?
include("conexion.php");
	$consulta = "SELECT * FROM forma_pago order by descripcion"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_forma_pago' id='lista_forma_pago' class='caja' onKeyUp='pasar_foco_clie_19a(event)'>"; 
		do{
				$cod_fp=$registro[0];
				$nombre=$registro[1];
				echo "<option value=$cod_fp>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";

?>