<?
	include("conexion.php");
	$codigo = $_GET["codigo"]; // toma la variable de la url q vino de ajax.js

	$consulta = "select max(fecha_hasta) from comision_vendedor where cod_vendedor = $codigo "; //group by fecha_hasta limit 1,1 consulta sql 
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro 
	$nfilas = mysql_num_rows ($result);          					
	$error = 1;
	
	if ($nfilas > 0){												// si existen facturas obtiene el mayor
		$fecha=$registro[0];
		$ano = substr($fecha,0,4); 
		$mes = substr($fecha,4,2);
		$dia = substr($fecha,-2);
		$error = 0;
	}else{
		$consulta = "select min(fecha) from(
						select fecha from factura_vta where cod_vendedor = $codigo 
						union
						select fecha from factura_vta_no_cliente where cod_vendedor = $codigo 
					)as asdsad group by fecha limit 1"; 

		$result = mysql_query($consulta);            
		$registro = mysql_fetch_row($result);        
		$nfilas = mysql_num_rows ($result);          					
		
		if ($nfilas > 0){												// si existen facturas obtiene el mayor
			$fecha=$registro[0];
			$ano = substr($fecha,0,4); 
			$mes = substr($fecha,4,2);
			$dia = substr($fecha,-2);
			$error = '0';
		}
	}

		
		//***********************************************************************		
	if($error == 0){	
		header('Content-Type: text/xml'); 			// encabezado obligatorio XML
		echo "<comision>\n"; 						// etiqueta superior
			echo '<dia>' . $dia . '</dia>';   // etiqueta mas la variable - CONVIENE LLAMAR A LA ETIQUETA DEL MISMO NOMBRE Q LA VARIABLE
			echo '<mes>' . $mes . '</mes>';   
			echo '<ano>' . $ano . '</ano>';
			echo '<error>' . $error . '</error>';
		echo "</comision>";
	}else{
		header('Content-Type: text/xml'); 			// encabezado obligatorio XML
		echo "<comision>\n"; 						// etiqueta superior
			echo '<error>' . $error . '</error>';
		echo "</comision>";	
	}

?>