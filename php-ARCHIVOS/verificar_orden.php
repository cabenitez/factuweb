<?
	//variables="cod_cliente="+id_Text+"&orden="+orden+"&cod_zona="+cod_zona;
	include("conexion.php");
	if (!empty($max)){
			$consulta = "SELECT max(orden) FROM cliente where cod_zona = $cod_zona"; // consulta sql 
			$result = mysql_query($consulta);            // hace la consulta
			$registro = mysql_fetch_row($result);        		// toma el registro
			$orden=$registro[0]+1;

			
			$consulta = "call alta_orden_cliente($cod_cliente,$orden)";
			if(	$result = mysql_query($consulta)){            					// hace la consulta
				echo $orden;
			}

	}else{
			$consulta = "SELECT * FROM cliente where cod_zona = $cod_zona and orden = $orden"; // consulta sql 
			$result = mysql_query($consulta);            // hace la consulta
			$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
			if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
				$consulta = "call corrimiento_orden_cliente($cod_zona,$orden)";
				if(	$result = mysql_query($consulta)){            					// hace la consulta
					$consulta = "call alta_orden_cliente($cod_cliente,$orden)";
					if(	$result = mysql_query($consulta)){            					// hace la consulta
						echo "ok";
					}
				}
			}else{
				$consulta = "call alta_orden_cliente($cod_cliente,$orden)";
				if(	$result = mysql_query($consulta)){            					// hace la consulta
					echo "ok";
				}
			}
	}	
?>