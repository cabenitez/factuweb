<?
	include("conexion.php");
	$consulta = "SELECT cod_usuario,usuario FROM usuario order by usuario"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='usuario' id='usuario' class='caja'onKeyUp='pasar_foco_auditoria_1(event)'>";  
		echo "<option value='TODOS'>TODOS</option>";
		do{
				$codigo=$registro[0];
				$nombre=$registro[1];
				echo "<option value=$codigo>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
?>