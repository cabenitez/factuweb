<?
	include("conexion.php");
	$consulta = "SELECT * FROM producto"; // consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro

	echo"<select name='lista_articulo' id='lista_articulo' class='caja'onKeyUp='pasar_foco_cat_buscar2(event)'>"; 
		echo "<option value='todos'>TODOS</option>";
		do{
				$codigo=$registro[0];
				echo "<option value=$codigo>$codigo</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	
	echo"</select>";
	//echo "<label class='botones'> $marca - $modelo</label>";
?>