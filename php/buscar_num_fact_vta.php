<? 
		$cond_iva = $_GET["cond_iva"]; // toma la variable de la url q vino de ajax.js ** Obtiene el tipo de comprobante **
		include("conexion.php");

		//-----------------------------------Obtengo el numero de Factura y el tipo-------------------------------// 
		$consulta ="select * from iva inner join tipo_talonario on tipo_talonario.cod_talonario = iva.cod_talonario where iva.cod_iva = $cond_iva"; // obtiene el tipo de talonario
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        		// toma el registro
		$codigo_tal = $registro[4]; 					
		$descripcion_tt = $registro[5]; // OK
		
		$consulta = "SELECT max(num_talonario) FROM talonario where cod_talonario = '$codigo_tal'"; // obtiene el numero del talonario
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$numero_tal= $registro[0]; 		// OK
				
		$consulta = "SELECT n_sucursal FROM talonario where num_talonario = $numero_tal and cod_talonario = '$codigo_tal'"; // obtiene el numero de sucursal
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$num_sucursal = $registro[0]; 	// OK

		//----------------------------si no existen facturas todavia------------------------------------------------//
		$consulta = "SELECT sig_num,ultimo_num FROM talonario where cod_talonario = '$codigo_tal' AND  num_talonario = $numero_tal"; // obtiene el numero del talonario
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$num_factura = $registro[0];
		$ultimo_num = $registro[1];
		
		$nfilas = 0;
		/*
		$consulta = " SELECT MAX(numero) FROM (SELECT MAX(n_factura)as numero FROM factura_vta where cod_talonario = '$codigo_tal'
					  UNION
					  SELECT MAX(n_factura)as numero FROM factura_vta_no_cliente where cod_talonario = '$codigo_tal'
					  ) as n_fact";				
		$result = mysql_query($consulta);            					
		$nfilas = mysql_num_rows ($result);          					
		$registro = mysql_fetch_row($result);        
		if ($nfilas > 0){												// si existen facturas obtiene el mayor
				$num_factura = $registro[0]+1;
		}
*/
		
		$consulta = "SELECT n_factura FROM factura_vta where cod_talonario = '$codigo_tal'"; 				// verifica si se han hecho facturas a un cliente
		$result = mysql_query($consulta);            					
		$nfilas = mysql_num_rows ($result);          					
		if ($nfilas > 0){												// si existen facturas obtiene el mayor
			$consulta = "SELECT max(n_factura) FROM factura_vta where cod_talonario = '$codigo_tal'"; 
			$result = mysql_query($consulta);            
			$registro = mysql_fetch_row($result);        
			$num_factura1 = $registro[0]+1;
		}
		
		$nfilas2 = 0;
		$consulta2 = "SELECT n_factura FROM factura_vta_no_cliente where cod_talonario = '$codigo_tal'"; 				// verifica si se han hecho facturas a un NO cliente
		$result2 = mysql_query($consulta2);            					
		$nfilas2 = mysql_num_rows ($result2);          					
		if ($nfilas2 > 0){												// si existen facturas obtiene el mayor
			$consulta2 = "SELECT max(n_factura) FROM factura_vta_no_cliente where cod_talonario = '$codigo_tal'"; 
			$result2 = mysql_query($consulta2);            
			$registro2 = mysql_fetch_row($result2);        
			$num_factura2 = $registro2[0]+1;
		}
		
		if($num_factura2 > $num_factura || $num_factura1 > $num_factura){
			if($num_factura2 > $num_factura1){
				$num_factura = $num_factura2;
			}else{
				$num_factura = $num_factura1;
			}
		}
		
		
		
		// BUSCA SI EL NUMERO DE FACTURA NO PERTENECE A UNA NUMERACION ANULADA //
		function buscar_numero($cod_tal,$num_tal, $num_fac){
			$consulta3 = "SELECT * FROM factura_anulada_numeracion where cod_talonario = '$cod_tal' AND num_talonario = $num_tal AND n_factura=$num_fac"; 
			$result3 = mysql_query($consulta3);            
			$nfilas3 = mysql_num_rows ($result3);          					
			if ($nfilas3 > 0){
				return (buscar_numero($cod_tal,$num_tal,$num_fac + 1));
			}else{ 
				return($num_fac);
			}
			
		}

		$num_factura = buscar_numero($codigo_tal,$numero_tal, $num_factura);
 


				
		
		
		// Completo con ceros para mostrar **********************************************
		$len_numero_tal=strlen($numero_tal); // completo el numero del remito con ceros
		while ($len_numero_tal < 4){
			$ceros.="0";
			$len_numero_tal++;
		}
		$numero_tal=$ceros.$numero_tal;

		$len_num_factura=strlen($num_factura); // completo el numero del remito con ceros
		while ($len_num_factura < 8){
			$ceros1.="0";
			$len_num_factura++;
		}
		$num_factura=$ceros1.$num_factura;
		
		$len_num_sucursal=strlen($num_sucursal); // completo el numero de la sucursal con ceros
		while ($len_num_sucursal < 4){
			$ceros_2.="0";
			$len_num_sucursal++;
		}
		$num_sucursal=$ceros_2.$num_sucursal;



		if ($num_factura > $ultimo_num){			//control para que no se facture un numero que exeda el talonario
					$error="3";
		}else{
					$error="0";
		}


	//---------------------------------------------------------------------------//
		header('Content-Type: text/xml'); 			// encabezado obligatorio XML
		echo "<facturas>\n"; 						// etiqueta superior
			echo '<codigo_tal>' . $codigo_tal . '</codigo_tal>';   // etiqueta mas la variable - CONVIENE LLAMAR A LA ETIQUETA DEL MISMO NOMBRE Q LA VARIABLE
			echo '<numero_tal>' . $numero_tal . '</numero_tal>';   
			echo '<num_sucursal>' . $num_sucursal . '</num_sucursal>';
			echo '<num_factura>' . $num_factura . '</num_factura>';  
			echo '<descripcion_tt>' . $descripcion_tt . '</descripcion_tt>';
			
			echo '<error>' . $error . '</error>';
		echo "</facturas>";

?>