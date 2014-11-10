<? 
$codigo = $_GET["codigo"]; // toma la variable de la url q vino de ajax.js
if($codigo){
	include("conexion.php");
	$consulta = "SELECT * FROM cliente WHERE cod_cliente = $codigo and activo = 'S'"; // consulta sql 
    $result = mysql_query($consulta);            // hace la consulta
	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        		// toma el registro
	
	if ($nfilas > 0){     						 		// si existe el usuario inicia la sesion
		$razon= $registro[6];
		$dir= $registro[10];
		$cod_zona=$registro[1];
		$cod_loca=$registro[2]; 
		$cod_prov=$registro[3]; 
		$cod_pais=$registro[4]; 
		$cond_iva=$registro[15];
		$cuit=$registro[11];
			$cuit1=substr($cuit,0,2);
			$cuit2=substr($cuit,2,-1);
			$cuit3=substr($cuit,-1);
		//$cod_categoria=$registro[16];
		$vendedor=$registro[17];
		//$repartidor=$registro[18];
		
		$consulta = "SELECT nombre FROM localidad WHERE cod_localidad = $cod_loca"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$localidad = $registro[0];
		
		$consulta = "SELECT nombre FROM provincia WHERE cod_prov = $cod_prov"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$provincia = $registro[0];
		
		//********************* BUSCA SI EL CLIENTE TIENE SALDO ***********************************//
		$consulta_importe_pagado = "select sum(cc_vta.importe)as importe_pagado from cc_vta  where cod_cliente = $codigo;"; // consulta sql
		$result_importe_pagado = mysql_query($consulta_importe_pagado);            // hace la consulta
		$registro_importe_pagado = mysql_fetch_row($result_importe_pagado);        // toma el registro
		$importe_pagado = $registro_importe_pagado[0];
		
		$consulta_importe_imputado = "select  sum(cc_vta_detalle.importe)as importe_imputado from cliente inner join (factura_vta inner join cc_vta_detalle 
						on cc_vta_detalle.n_factura = factura_vta.n_factura and cc_vta_detalle.cod_talonario = factura_vta.cod_talonario and cc_vta_detalle.num_talonario = factura_vta.num_talonario)
						on factura_vta.cod_cliente = cliente.cod_cliente  and factura_vta.cod_zona= cliente.cod_zona and factura_vta.cod_localidad = cliente.cod_localidad 
						and factura_vta.cod_prov = cliente.cod_prov and factura_vta.cod_pais = cliente.cod_pais where cliente.cod_cliente = $codigo;"; // consulta sql
		$result_importe_imputado = mysql_query($consulta_importe_imputado);            // hace la consulta
		$registro_importe_imputado = mysql_fetch_row($result_importe_imputado);        // toma el registro
		$importe_imputado = $registro_importe_imputado[0];
								
		//$saldo = abs($importe_pagado - $importe_imputado);
		$saldo = $importe_pagado - $importe_imputado;
		$saldo = number_format($saldo,2,'.','');
		

		
		
		$consulta_t ="SELECT * FROM recibos_por_cliente where cod_cliente = $codigo and cod_zona=$cod_zona and cod_localidad= $cod_loca and cod_prov=$cod_prov and cod_pais = $cod_pais order by num_talonario desc";
		$result_t = mysql_query($consulta_t);            // hace la consulta
		$nfilas_t = mysql_num_rows ($result_t);          //indica la cantidad de resultados
		$registro_t = mysql_fetch_row($result_t);        // toma el registro
		if ($nfilas_t > 0){     						 // si existe el usuario inicia la sesion
				$codigo_tal=$registro_t[5];
				$numero_tal=$registro_t[6];
		
		
				//-----------------------------------Obtengo el numero de Factura y el tipo-------------------------------// 

				$consulta = "SELECT n_sucursal,sig_num, ultimo_num FROM talonario where cod_talonario = '$codigo_tal' and num_talonario = $numero_tal"; // obtiene el numero de sucursal
				$result = mysql_query($consulta);            // hace la consulta
				$registro = mysql_fetch_row($result);        // toma el registro
				$num_sucursal = $registro[0]; 	// OK
				$num_recibo = $registro[1];
				$ultimo_num = $registro[2]; 
				
				$nfilas = 0;
				$consulta = "SELECT num_recibo FROM cc_vta where cod_talonario = '$codigo_tal' and num_talonario = $numero_tal"; 				// verifica si se han hecho facturas a un cliente
				$result = mysql_query($consulta);            					
				$nfilas = mysql_num_rows ($result);          					
				if ($nfilas > 0){												// si existen facturas obtiene el mayor
					$consulta = "SELECT max(num_recibo) FROM cc_vta where cod_talonario = '$codigo_tal' and num_talonario = $numero_tal"; 
					$result = mysql_query($consulta);            
					$registro = mysql_fetch_row($result);        
					$num_recibo = $registro[0]+1;
				}
				
					
		/*		
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
		*/
				
				
				// Completo con ceros para mostrar **********************************************
				$len_numero_tal=strlen($numero_tal); // completo el numero del remito con ceros
				while ($len_numero_tal < 4){
					$ceros.="0";
					$len_numero_tal++;
				}
				$numero_tal=$ceros.$numero_tal;
		
				$len_num_recibo=strlen($num_recibo); // completo el numero del remito con ceros
				while ($len_num_recibo < 8){
					$ceros1.="0";
					$len_num_recibo++;
				}
				$num_recibo=$ceros1.$num_recibo;
				
				$len_num_sucursal=strlen($num_sucursal); // completo el numero de la sucursal con ceros
				while ($len_num_sucursal < 4){
					$ceros_2.="0";
					$len_num_sucursal++;
				}
				$num_sucursal=$ceros_2.$num_sucursal;
				
				if ($num_recibo < $ultimo_num){			//control para que no se facture un numero que exeda el talonario
							$error="0";
							//****************************************************************************************//		
							header('Content-Type: text/xml'); 			// encabezado obligatorio XML
							echo "<clientes>\n"; 						// etiqueta superior
								echo '<codigo_tal>' . $codigo_tal . '</codigo_tal>';   // etiqueta mas la variable - CONVIENE LLAMAR A LA ETIQUETA DEL MISMO NOMBRE Q LA VARIABLE
								echo '<numero_tal>' . $numero_tal . '</numero_tal>';   
								echo '<num_sucursal>' . $num_sucursal . '</num_sucursal>';
								echo '<num_factura>' . $num_recibo . '</num_factura>';  
								//echo '<descripcion_tt>' . $descripcion_tt . '</descripcion_tt>';
			
								echo '<razon>' . $razon . '</razon>';  
								echo '<dir>' . $dir . '</dir>';         
								echo '<localidad>' . $localidad . '</localidad>'; 
								echo '<provincia>' . $provincia . '</provincia>';
								echo '<cond_iva>' . $cond_iva . '</cond_iva>';
								if($cuit1 != ""){
									$cuit="con";
									echo '<cuit>' . $cuit . '</cuit>';
									//-----------------------------------				
									echo '<cuit1>' . $cuit1 . '</cuit1>';
									echo '<cuit2>' . $cuit2 . '</cuit2>';
									echo '<cuit3>' . $cuit3 . '</cuit3>';
								}else{
									$cuit="sin";
									echo '<cuit>' . $cuit . '</cuit>';
								}
								echo '<vendedor>' . $vendedor . '</vendedor>';    
								echo '<saldo>' . $saldo . '</saldo>';
								//echo '<cod_categoria>' . $cod_categoria . '</cod_categoria>';
					
								$error="0";
								echo '<error>' . $error . '</error>';
							echo "</clientes>";
				}else{
							header('Content-Type: text/xml'); 			// encabezado obligatorio XML
							echo "<clientes>\n"; 						// etiqueta superior
								$error="3";								// error de q NO existe un talonario asignado al cliente
								echo '<error>' . $error . '</error>';
							echo "</clientes>";	
				}
		
		}else{
				header('Content-Type: text/xml'); 			// encabezado obligatorio XML
				echo "<clientes>\n"; 						// etiqueta superior
					$error="4";								// error de q NO existe un talonario asignado al cliente
					echo '<error>' . $error . '</error>';
				echo "</clientes>";	
		}
		
	}else{
		header('Content-Type: text/xml'); 			// encabezado obligatorio XML
		echo "<clientes>\n"; 						// etiqueta superior
			$error="1";								// error de q NO existe el cliente
			echo '<error>' . $error . '</error>';
		echo "</clientes>";	
	}
}else{
	require("smarty.php");  									// requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; 									//crea una instancia
	$smarty->display('buscar_cliente_alta_remito.tpl');     //define la plantilla que utilizara
}	
?>