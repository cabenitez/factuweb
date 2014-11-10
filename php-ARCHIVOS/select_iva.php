<?
	include("conexion.php");
	$consulta = "select * from iva where cuit = 'S' order by nombre"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_iva' id='lista_iva' class='caja'onKeyUp='pasar_foco_prove_7(event)'>"; 
		do{
				$codigo=$registro[0];
				$nombre=$registro[2];
				echo "<option value=$codigo>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
?>