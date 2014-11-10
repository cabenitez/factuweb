<?
	include("conexion.php");
	$consulta = "SELECT cod_cliente, orden FROM cliente where cod_zona = $cod_zona and orden > 0 order by orden"; // consulta sql 
	$result = mysql_query($consulta);            			// hace la consulta
   	$nfilas = mysql_num_rows ($result);          			//indica la cantidad de resultados
	
	if ($nfilas > 0){     						 			
		$registro = mysql_fetch_row($result);        		// toma el registro
		$orden_inicial=$registro[1]; 						//obtengo el primer numero de orden
		
		//obtengo el segundo registro y de ahi en adelante asigno incrementando el orden 
		while($registro = mysql_fetch_row($result)){
				++$orden_inicial;
				$cod_cliente_a_mod=$registro[0];
				$consulta2 = "call ordenar_orden_cliente($orden_inicial,$cod_cliente_a_mod);"; 
				$result2 = mysql_query($consulta2);
		}
		echo "ok";
	}	
?>