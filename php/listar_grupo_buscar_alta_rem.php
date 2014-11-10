<?
	include("conexion.php");
	$consulta = "select DISTINCT grupo.cod_grupo, grupo.descripcion from grupo inner join (marca inner join (variedad inner join producto on producto.cod_variedad = variedad.cod_variedad)on variedad.cod_marca = marca.cod_marca) on marca.cod_grupo = grupo.cod_grupo"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro
	
	echo"<select name='lista_grupo' id='lista_grupo' class='caja' onKeyUp='pasar_foco_rem_vta_bus_6(event)'>"; 
		echo "<option value='TODOS'>TODOS</option>";
		do{
			$codigo= $registro[0];
			$nombre= $registro[1];
			echo "<option value=$codigo>$nombre</option>";
		}while($registro = mysql_fetch_row($result)); // obtengo los resultados 
	echo"</select>";
?>