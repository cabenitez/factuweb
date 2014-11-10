<? 
session_start();   									// Iniciar sesión
$usuario_presu = $_SESSION['user_usuario']; 	// usuario conectado

$codigo = $_GET["codigo"]; // toma la variable de la url q vino de ajax.js
if($codigo){
	include("conexion.php");
	//---------------------VACIA TABLA TEMPORAL DE ARTICULOS-----------------------------------------------------------------//
	$consulta = "call vaciar_tabla_presupuesto_vta_tmp('$usuario_presu')";
	$result = mysql_query($consulta);
	
	$consulta = "SELECT * FROM cliente WHERE cod_cliente = $codigo and activo = 'S'"; // consulta sql
    $result = mysql_query($consulta);            // hace la consulta
	$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        		// toma el registro
	
	if ($nfilas > 0){     						 		// si existen Usuarios
		$razon= $registro[6];
		$dir= $registro[10];
		$cod_loca=$registro[2];
		$cod_prov=$registro[3]; 
		$cond_iva=$registro[15];
		$cuit=$registro[11];
			$cuit1=substr($cuit,0,2);
			$cuit2=substr($cuit,2,-1);
			$cuit3=substr($cuit,-1);
		$cod_categoria=$registro[16];
		$vendedor=$registro[17];
		$repartidor=$registro[18];
		
		$consulta = "SELECT nombre FROM localidad WHERE cod_localidad = $cod_loca"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$localidad = $registro[0];
		
		$consulta = "SELECT nombre FROM provincia WHERE cod_prov = $cod_prov"; // consulta sql
		$result = mysql_query($consulta);            // hace la consulta
		$registro = mysql_fetch_row($result);        // toma el registro
		$provincia = $registro[0];
		/*
		//-----------------------------------Obtengo el numero de Factura y el tipo-------------------------------// 
		$consulta ="select tipo_talonario.cod_talonario,tipo_talonario.descripcion from cliente inner join (iva inner join tipo_talonario on tipo_talonario.cod_talonario = iva.cod_talonario) on iva.cod_iva = cliente.cod_iva where cliente.cod_cliente = $codigo"; // obtiene el tipo de talonario
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
					$error="0";
		}
		*/
		$error="0";
		//***********************************************************************		
		header('Content-Type: text/xml'); 			// encabezado obligatorio XML
		echo "<clientes>\n"; 						// etiqueta superior
			//echo '<codigo_tal>' . $codigo_tal . '</codigo_tal>';   // etiqueta mas la variable - CONVIENE LLAMAR A LA ETIQUETA DEL MISMO NOMBRE Q LA VARIABLE
			//echo '<numero_tal>' . $numero_tal . '</numero_tal>';   
			//echo '<num_sucursal>' . $num_sucursal . '</num_sucursal>';
			//echo '<num_factura>' . $num_factura . '</num_factura>';  
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
			echo '<repartidor>' . $repartidor . '</repartidor>';
			echo '<cod_categoria>' . $cod_categoria . '</cod_categoria>';

			echo '<error>' . $error . '</error>';
		echo "</clientes>";
	}else{
		header('Content-Type: text/xml'); 			// encabezado obligatorio XML
		echo "<clientes>\n"; 						// etiqueta superior
			$error="1";								// el cliente no existe
			echo '<error>' . $error . '</error>';
		echo "</clientes>";	
	}
}else{
	require("smarty.php");  									// requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; 									//crea una instancia
	$smarty->display('buscar_cliente_alta_remito.tpl');     //define la plantilla que utilizara
}	
?>