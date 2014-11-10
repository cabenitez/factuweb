<?
	include("conexion.php");
	$consulta = "SELECT * FROM cliente"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_cliente' id='lista_cliente' class='caja'onKeyUp='pasar_foco_ven_7(event)'>"; 
		echo "<option value='todos'>TODOS</option>";
		do{
				$codigo=$registro[0];
				echo "<option value=$codigo>$codigo</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	
	echo"</select>";
	//echo "<label class='botones'> $marca - $modelo</label>";
?>