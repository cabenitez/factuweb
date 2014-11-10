<? 
// Obtiene el numero de presupuesto (*1)	*********************************************************************************************
	include("conexion.php");
	
	$consulta = "SELECT * FROM tipo_talonario where descripcion LIKE '%presu%' or descripcion like '%PRESU%'";  // obtiene el cod del presupuesto
    $result = mysql_query($consulta);           														   
   	$registro = mysql_fetch_row($result);        															
	$cod_tt= $registro[0]; 					// obtiene la letra que identifica al presupuesto
		
	$nfilas = 0;
	$consulta = "SELECT n_presupuesto FROM presupuesto_vta"; 				// verifica si se han hecho presupuestos a un cliente
    $result = mysql_query($consulta);            					
	$nfilas = mysql_num_rows ($result);          					
	
	$nfilas_no_cliente = 0;
	$consulta = "SELECT n_presupuesto FROM presupuesto_vta_no_cliente"; 	// verifica se se han hecho presupuestos a un no cliente
    $result = mysql_query($consulta);            					
	$nfilas_no_cliente = mysql_num_rows ($result);          		

	if ($nfilas > 0){														// si existen registros en la tabla presupuestos de clientes
		$consulta = "SELECT max(n_presupuesto) FROM presupuesto_vta"; 
    	$result = mysql_query($consulta);            
		$registro = mysql_fetch_row($result);        
		$num_presu = $registro[0]+1;
	}
	if ($nfilas_no_cliente > 0){											// si existen registros en la tabla presupuestos de no clientes
		$consulta = "SELECT max(n_presupuesto) FROM presupuesto_vta_no_cliente"; 
		$result = mysql_query($consulta);            
		$registro = mysql_fetch_row($result);        
		$num_presu_no_cliente = $registro[0]+1;
	}	
	if ($nfilas > 0 || $nfilas_no_cliente > 0){								// compara que tabla tiene mayor numero de presupuestos
		if($nfilas_no_cliente > 0 && $num_presu_no_cliente > $num_presu){ 	
			$num_presu = $num_presu_no_cliente;
		}
	}	
	
	$consulta = "SELECT max(num_talonario) FROM talonario where cod_talonario = '$cod_tt'"; // obtiene el numero del talonario
    $result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro
	$numero_tal= $registro[0];
		
	$consulta = "SELECT n_sucursal,sig_num, ultimo_num FROM talonario where num_talonario = $numero_tal and cod_talonario = '$cod_tt' "; // obtiene el numero de sucursal
	$result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro
	$num_sucursal = $registro[0];
	if(empty($num_presu)){
		$num_presu = $registro[1];
	}
	$ultimo_num = $registro[2];
	
// Completo con ceros para mostrar ******************************************************************************************************
	$len_numero_tal=strlen($numero_tal); // completo el numero del presupuesto con ceros
	while ($len_numero_tal < 4){
		$ceros.="0";
		$len_numero_tal++;
	}
	$numero_tal=$ceros.$numero_tal;

	$len_num_presu=strlen($num_presu); // completo el numero del presupuesto con ceros
	while ($len_num_presu < 8){
		$ceros_1.="0";
		$len_num_presu++;
	}
	$num_presu=$ceros_1.$num_presu;
	
	$len_num_sucursal=strlen($num_sucursal); // completo el numero de la sucursal con ceros
	while ($len_num_sucursal < 4){
		$ceros_2.="0";
		$len_num_sucursal++;
	}
	$num_sucursal=$ceros_2.$num_sucursal;


	if ($num_presu > $ultimo_num){			//control para que no se facture un numero que exeda el talonario
					$error="1";
	}else{
					$error="0";
	}


	// Creo el XML **************************************************************************************************************************
	header('Content-Type: text/xml'); 			// encabezado obligatorio XML
	echo "<presupuestos>\n"; 						// etiqueta superior
	if($numero_tal != 0){
		echo '<codigo_tal>' . $cod_tt . '</codigo_tal>';   
		echo '<numero_tal>' . $numero_tal . '</numero_tal>';   
		echo '<numero_suc>' . $num_sucursal . '</numero_suc>';         
		echo '<numero_presu>' . $num_presu . '</numero_presu>';
		echo '<error>' . $error . '</error>';
	}else{
		$error_xml='ERROR';
		echo '<codigo_tal>' . $error_xml . '</codigo_tal>';   
		echo '<numero_tal>' . $error_xml . '</numero_tal>';   
		echo '<numero_suc>' . $error_xml . '</numero_suc>';         
		echo '<numero_presu>' . $error_xml . '</numero_presu>';
		echo '<error>' . $error . '</error>';
	}
	echo "</presupuestos>";
?>