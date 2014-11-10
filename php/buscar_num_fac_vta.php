<?  /*
		include("conexion.php");

		$consulta = "SELECT cod_talonario FROM tipo_talonario where descripcion like '%F%B%'"; // obtiene el codigo del talonario
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$codigo_tal = $registro[0]; 			// OK
	
		$consulta = "SELECT max(num_talonario) FROM talonario where cod_talonario = $codigo_tal"; // obtiene el numero del talonario
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$numero_tal= $registro[0]; 		// OK
			
		$consulta = "SELECT n_sucursal FROM talonario where num_talonario = $numero_tal"; // obtiene el numero de suursal
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$num_sucursal = $registro[0]; 	// OK
		//----------------------------------------------------------------------------//
		$nfilas = 0;
		$consulta = "SELECT n_factura FROM factura_vta"; 				// verifica si se han hecho facturas a un cliente
		$result = mysql_query($consulta);            					
		$nfilas = mysql_num_rows ($result);          					
	
		if ($nfilas > 0){												// si existen facturas
			$consulta = "SELECT max(n_factura) FROM factura_vta"; 
			$result = mysql_query($consulta);            
			$registro = mysql_fetch_row($result);        
			$num_factura = $registro[0]+1;
		}else{															// si no existen facturas todavia
			$consulta = "SELECT sig_num FROM talonario where cod_talonario = $codigo_tal AND  num_talonario = $numero_tal"; // obtiene el numero del talonario
			$result = mysql_query($consulta);            // hace la consulta
			$registro = mysql_fetch_row($result);        // toma el registro
			$num_factura = $registro[0];
		}
		//---------------------------------------------------------------------------//
	
	// Completo con ceros para mostrar ******************************************************************************************************
		$len_num_factura=strlen($num_factura); // completo el numero del remito con ceros
		while ($len_num_factura < 8){
			$ceros.="0";
			$len_num_factura++;
		}
		$num_factura=$ceros.$num_factura;
		
		$len_num_sucursal=strlen($num_sucursal); // completo el numero de la sucursal con ceros
		while ($len_num_sucursal < 4){
			$ceros_2.="0";
			$len_num_sucursal++;
		}
		$num_sucursal=$ceros_2.$num_sucursal;
		$descripcion_tt ="FACTURA B";				

				//$bonif= $registro[0]; se busca encada articulo
				header('Content-Type: text/xml'); 			// encabezado obligatorio XML
				echo "<factura>\n"; 						// etiqueta superior
					echo '<codigo_tal>' . $codigo_tal . '</codigo_tal>';   // etiqueta mas la variable - CONVIENE LLAMAR A LA ETIQUETA DEL MISMO NOMBRE Q LA VARIABLE
					echo '<numero_tal>' . $numero_tal . '</numero_tal>';   
					echo '<num_sucursal>' . $num_sucursal . '</num_sucursal>';
					echo '<num_factura>' . $num_factura . '</num_factura>';  
					echo '<descripcion_tt>' . $descripcion_tt . '</descripcion_tt>';
				echo "</factura>";
				*/
?>
