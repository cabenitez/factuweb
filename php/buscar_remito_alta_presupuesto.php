<? 
$codigo = $_GET["codigo"]; // toma la variable de la url q vino de ajax.js
if($codigo){ 
	include("conexion.php");
	$consulta = "SELECT * FROM remito_vta WHERE num_remito = $codigo and pendiente = 'S'"; // busca en la tabla remitos a clientes
	$result = mysql_query($consulta);            // hace la consulta
	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        		// toma el registro
	//===========================================================================================================================	
	// si es un remito a un CLIENTE =============================================================================================	
	if ($nfilas > 0){ 
		$lugar= $registro[2];
		if($lugar == ""){
			$lugar= "no";
		}
		
		$hora= $registro[3];
		if($hora == ""){
			$hora= "no";
		}

		$cod_cliente= $registro[4];
		$cod_categoria= $registro[11];
		$vendedor= $registro[12];
		$repartidor= $registro[13];
		
		$obs= $registro[14];
		if($obs == ""){
			$obs="no";
		}
			$consulta = "SELECT * FROM cliente WHERE cod_cliente  = $cod_cliente"; // busca en la tabla remitos a clientes
			$result = mysql_query($consulta);            // hace la consulta
			$registro = mysql_fetch_row($result);        		// toma el registro
		$razon= $registro[6];
		$dir= $registro[10];
				$cod_localidad= $registro[2];
				$cod_provincia= $registro[3];
				$cod_iva= $registro[15]; //_________________________condicion de iva
				$cuit= $registro[11];

				if($cuit == ""){
					$cuit1="no";
					$cuit2="no";
					$cuit3="no";
				}else{
					$cuit1=substr($cuit,0,2);
					$cuit2=substr($cuit,2,-1);
					$cuit3=substr($cuit,-1);
				}	
					$consulta = "SELECT nombre FROM localidad WHERE cod_localidad  = $cod_localidad";
					$result = mysql_query($consulta);            // hace la consulta
					$registro = mysql_fetch_row($result);        		// toma el registro
		$localidad= $registro[0];
					
					$consulta = "SELECT nombre FROM provincia WHERE cod_prov  = $cod_provincia"; 
					$result = mysql_query($consulta);            // hace la consulta
					$registro = mysql_fetch_row($result);        		// toma el registro
		$provincia= $registro[0];
					
					$consulta = "SELECT cod_iva FROM iva WHERE cod_iva  = $cod_iva"; 
					$result = mysql_query($consulta);            // hace la consulta
					$registro = mysql_fetch_row($result);        		// toma el registro
		$iva= $registro[0];
		if($iva == ""){
			$iva="no";
		}
		//-----------------------------------Obtengo el numero de Factura y el tipo-------------------------------// 
		/*
		$consulta ="select tipo_talonario.cod_talonario,tipo_talonario.descripcion from cliente inner join (iva inner join tipo_talonario on tipo_talonario.cod_talonario = iva.cod_talonario) on iva.cod_iva = cliente.cod_iva where cliente.cod_cliente = $cod_cliente"; // obtiene el tipo de talonario
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        		// toma el registro
		$codigo_tal = $registro[0]; 					
		$descripcion_tt = $registro[1]; // OK
		
		$consulta = "SELECT max(num_talonario) FROM talonario where cod_talonario = '$codigo_tal'"; // obtiene el numero del talonario
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$numero_tal= $registro[0]; 		// OK
				
		$consulta = "SELECT n_sucursal,sig_num, ultimo_num FROM talonario where num_talonario = $numero_tal and cod_talonario = '$codigo_tal'"; // obtiene el numero de sucursal
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$num_sucursal = $registro[0]; 	// OK
		$num_factura = $registro[1];
		$ultimo_num = $registro[2];
		
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
				* /

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
					
		}
		*/
		$error="0";
	//---------------------------------------------------------------------------//
		header('Content-Type: text/xml'); 			// encabezado obligatorio XML
		echo "<remitos>\n"; 						// etiqueta superior
			//echo '<codigo_tal>' . $codigo_tal . '</codigo_tal>';   // etiqueta mas la variable - CONVIENE LLAMAR A LA ETIQUETA DEL MISMO NOMBRE Q LA VARIABLE
			//echo '<numero_tal>' . $numero_tal . '</numero_tal>';   
			//echo '<num_sucursal>' . $num_sucursal . '</num_sucursal>';
			//echo '<num_factura>' . $num_factura . '</num_factura>';  
			//echo '<descripcion_tt>' . $descripcion_tt . '</descripcion_tt>';
			echo '<num_remito>' . $codigo . '</num_remito>';   
			echo '<cod_cliente>' . $cod_cliente . '</cod_cliente>';
			echo '<lugar>' . $lugar . '</lugar>'; 
			echo '<hora>' . $hora . '</hora>'; 
			echo '<vendedor>' . $vendedor . '</vendedor>';  
			echo '<repartidor>' . $repartidor . '</repartidor>';
			echo '<obs>' . $obs . '</obs>';   
			echo '<razon>' . $razon . '</razon>';
			echo '<dir>' . $dir . '</dir>';
			echo '<cuit1>' . $cuit1 . '</cuit1>';
			echo '<cuit2>' . $cuit2 . '</cuit2>';
			echo '<cuit3>' . $cuit3 . '</cuit3>';
			echo '<cod_categoria>' . $cod_categoria . '</cod_categoria>';
			echo '<localidad>' . $localidad . '</localidad>';
			echo '<provincia>' . $provincia . '</provincia>';
			echo '<iva>' . $iva . '</iva>';
			$tipo="cliente";
			echo '<tipo>' . $tipo . '</tipo>';
			echo '<error>' . $error . '</error>';
		echo "</remitos>";
	//===========================================================================================================================
	// si es un remito a un NO CLIENTE ==========================================================================================
	}else{
		$consulta = "SELECT * FROM remito_vta_no_cliente WHERE num_remito = $codigo AND pendiente = 'S'";  // busca en la tabla remitos a NO clientes
		$result = mysql_query($consulta);            // hace la consulta
		$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
		$registro = mysql_fetch_row($result);        		// toma el registro

		if ($nfilas > 0){	
				$lugar= $registro[2];
				if($lugar == ""){
					$lugar= "no";
				}
				
				$hora= $registro[3];
				if($hora == ""){
					$hora= "no";
				}

				$razon= $registro[6];
				$dir= $registro[7];
				$localidad= $registro[8];
				$provincia= $registro[9];
				if($provincia == ""){
					$provincia="no";
				}
				$iva= $registro[10]; // COND_IVA
				$cuit= $registro[11];
					$cuit1=substr($cuit,0,2);
					$cuit2=substr($cuit,2,-1);
					$cuit3=substr($cuit,-1);
				if($cuit == "undefined"){
					$cuit1="no";
					$cuit2="no";
					$cuit3="no";
				}	
				$categoria= $registro[12];
				$vendedor= $registro[13];
				$repartidor= $registro[14];
				$obs= $registro[15];
				
				if($obs == ""){
					$obs="no";
				}
				$zona= $registro[16];
		/*
		$consulta = "select tipo_talonario.cod_talonario,tipo_talonario.descripcion from iva inner join tipo_talonario on tipo_talonario.cod_talonario = iva.cod_talonario where cod_iva = $iva"; // obtiene el codigo del talonario
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$codigo_tal = $registro[0]; 			// OK
		$descripcion_tt = $registro[1]; 		// OK

		$consulta = "SELECT max(num_talonario) FROM talonario where cod_talonario = '$codigo_tal'"; // obtiene el numero del talonario
		$result = mysql_query($consulta);       // hace la consulta
		$registro = mysql_fetch_row($result);   // toma el registro
		$numero_tal= $registro[0]; 				// OK
			
		$consulta = "SELECT n_sucursal,sig_num, ultimo_num FROM talonario where num_talonario = $numero_tal and cod_talonario = '$codigo_tal'"; // obtiene el numero de sucursal
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$num_sucursal = $registro[0]; 	// OK
		$num_factura = $registro[1];
		$ultimo_num = $registro[2];
		
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
				* /
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
		//---------------------------------------------------------------------------//
	
	
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

	// Completo con ceros para mostrar ******************************************************************************************************
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
		$descripcion_tt ="FACTURA B";
		
		
		
		if ($num_factura > $ultimo_num){			//control para que no se facture un numero que exeda el talonario
					$error="3";
		}else{
					$error="0";
		}
		*/		
		$error="0";
				//$bonif= $registro[0]; se busca encada articulo
				header('Content-Type: text/xml'); 			// encabezado obligatorio XML
				echo "<remitos>\n"; 						// etiqueta superior
					//echo '<codigo_tal>' . $codigo_tal . '</codigo_tal>';   // etiqueta mas la variable - CONVIENE LLAMAR A LA ETIQUETA DEL MISMO NOMBRE Q LA VARIABLE
					//echo '<numero_tal>' . $numero_tal . '</numero_tal>';   
					//echo '<num_sucursal>' . $num_sucursal . '</num_sucursal>';
					//echo '<num_factura>' . $num_factura . '</num_factura>';  
					//echo '<descripcion_tt>' . $descripcion_tt . '</descripcion_tt>';
					echo '<num_remito>' . $codigo . '</num_remito>';   // etiqueta mas la variable - CONVIENE LLAMAR A LA ETIQUETA DEL MISMO NOMBRE Q LA VARIABLE
					echo '<lugar>' . $lugar . '</lugar>';
					echo '<hora>' . $hora . '</hora>';
					echo '<vendedor>' . $vendedor . '</vendedor>'; 
					echo '<repartidor>' . $repartidor . '</repartidor>';
					echo '<obs>' . $obs . '</obs>';
					echo '<razon>' . $razon . '</razon>';
					echo '<dir>' . $dir . '</dir>';
					echo '<cuit1>' . $cuit1 . '</cuit1>';
					echo '<cuit2>' . $cuit2 . '</cuit2>';
					echo '<cuit3>' . $cuit3 . '</cuit3>';
					echo '<cod_categoria>' . $categoria . '</cod_categoria>';
					echo '<localidad>' . $localidad . '</localidad>';
					echo '<provincia>' . $provincia . '</provincia>';
					echo '<iva>' . $iva . '</iva>';
					echo '<zona>' . $zona . '</zona>';
					
					$tipo="no_cliente";
					echo '<tipo>' . $tipo . '</tipo>';
					echo '<error>' . $error . '</error>';
				echo "</remitos>";
		}else{
			header('Content-Type: text/xml'); 			// encabezado obligatorio XML
			echo "<remitos>\n"; 						// etiqueta superior
				$error="1";
				echo '<error>' . $error . '</error>';
			echo "</remitos>";	
		}
	}
}else{ // en caso de que oprima F2 para levantar el pop up
	require("smarty.php");  									// requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; 									//crea una instancia
	$smarty->display('buscar_remito_alta_presupuesto.tpl');     //define la plantilla que utilizara
}	
?>
