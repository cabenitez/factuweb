<? 
session_start();   										// Iniciar sesión
$usuario_rem = $_SESSION['user_usuario']; 	//usuario conectado
$usuario_fac = $usuario_rem;
include("conexion.php");

// SI SE VA A REGISTRAR UN REMITO 			*********************************************** 
$cod_cliente = $_POST["cod_cliente"]; 		// toma la variable de la url q vino de ajax.js
if($cod_cliente){ 
	//-------------------------------obtiene el numero de remito actual---------------------------------------------------------------//	
	$consulta = "SELECT * FROM tipo_talonario where descripcion LIKE '%rem%' or descripcion like '%REM%'";  // obtiene el cod del remito
    $result = mysql_query($consulta);           														   
   	$registro = mysql_fetch_row($result);        															
	$cod_tt= $registro[0]; 					// obtiene la letra que identifica al remito
	$cant_copias = $registro[2]; 			// OK
	
	$nfilas = 0;
	$consulta = "SELECT num_remito FROM remito_vta"; 				// verifica si se han hecho remitos a un cliente
    $result = mysql_query($consulta);            					
	$nfilas = mysql_num_rows ($result);          					
	
	$nfilas_no_cliente = 0;
	$consulta = "SELECT num_remito FROM remito_vta_no_cliente"; 	// verifica se se han hecho remitos a un no cliente
    $result = mysql_query($consulta);            					
	$nfilas_no_cliente = mysql_num_rows ($result);          		

	if ($nfilas > 0){												// si existen registros en la tabla remitos de clientes
		$consulta = "SELECT max(num_remito) FROM remito_vta"; 
    	$result = mysql_query($consulta);            
		$registro = mysql_fetch_row($result);        
		$num_remito = $registro[0]+1;
	}
	if ($nfilas_no_cliente > 0){									// si existen registros en la tabla remitos de no clientes
		$consulta = "SELECT max(num_remito) FROM remito_vta_no_cliente"; 
		$result = mysql_query($consulta);            
		$registro = mysql_fetch_row($result);        
		$num_remito_no_cliente = $registro[0]+1;
	}	
	if ($nfilas > 0 || $nfilas_no_cliente > 0){						// compara que tabla tiene mayor numero de remito
		if($nfilas_no_cliente > 0 && $num_remito_no_cliente > $num_remito){ 	
			$num_remito = $num_remito_no_cliente;
		}
	}	
	
	$consulta = "SELECT max(num_talonario) FROM talonario where cod_talonario = '$cod_tt'"; // obtiene el numero del talonario
    $result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro
	$numero_tal= $registro[0];
		
	$consulta = "SELECT n_sucursal,sig_num, destino_impr FROM talonario where num_talonario = $numero_tal and cod_talonario = '$cod_tt'"; // obtiene el numero de sucursal
    $result = mysql_query($consulta);            // hace la consulta
   	$registro = mysql_fetch_row($result);        // toma el registro
	$num_sucursal = $registro[0];
	if(empty($num_remito)){
		$num_remito = $registro[1];
	}
	
	//================================ OBTIENE EL DESTINO DE IMPRESION==================================================================================//				
	$impresora= $registro[2]; 		// OK
	$posicion_comodin = strrpos ($impresora, "#"); 		
	$impresora = substr($impresora, 0,$posicion_comodin); 		// obtiene solo la info de la impresora
	$impresora = "/printers/".$impresora;
	//================================FIN =============================================================================================================//				

	
	
	//-----------------------------------------------------------------------------------//	
	$fecha = $_POST["fecha"]; 				// toma la variable de la url q vino de ajax.js
	$lugar = $_POST["lugar"]; 				// toma la variable de la url q vino de ajax.js
	$hora = $_POST["hora"]; 				// toma la variable de la url q vino de ajax.js
	$cod_cliente = $_POST["cod_cliente"]; 	// toma la variable de la url q vino de ajax.js
	$categoria = $_POST["categoria"]; 		// toma la variable de la url q vino de ajax.js

	$razon = $_POST["razon"]; 				// toma la variable de la url q vino de ajax.js
	$dir = $_POST["dir"]; 					// toma la variable de la url q vino de ajax.js
	$localidad = $_POST["localidad"]; 		// toma la variable de la url q vino de ajax.js
	$provincia = $_POST["provincia"]; 		// toma la variable de la url q vino de ajax.js
	$iva = $_POST["iva"]; 					// toma la variable de la url q vino de ajax.js
	$cuit = $_POST["cuit"]; 				// toma la variable de la url q vino de ajax.js
	$vendedor = $_POST["vendedor"]; 		// toma la variable de la url q vino de ajax.js
	$repartidor = $_POST["repartidor"]; 	// toma la variable de la url q vino de ajax.js
	$obs = $_POST["obs"]; 					// toma la variable de la url q vino de ajax.js
	$zona = $_POST["zona"]; 					// toma la variable de la url q vino de ajax.js
	
	$lugar = strtoupper($lugar);
	$hora = strtoupper($hora);
	$razon = strtoupper($razon);
	$dir = strtoupper($dir);	
	$localidad = strtoupper($localidad);	
	$provincia = strtoupper($provincia);
	$iva = strtoupper($iva);
	$obs = strtoupper($obs);
	
	//***********************************************************************************************************//
	//                            DATOS DEL CLIENTE Y DEL REMITO
	//***********************************************************************************************************//	
	if ($cod_cliente != "no_cliente"){//---------------------CLIENTE
			$consulta = "SELECT cod_zona, cod_localidad, cod_prov, cod_pais FROM cliente where cod_cliente = $cod_cliente"; // consulta sql
			$result = mysql_query($consulta);            // hace la consulta
			$registro = mysql_fetch_row($result);        // toma el registro
			$cod_zona= $registro[0];
			$cod_localidad= $registro[1];
			$cod_prov= $registro[2];
			$cod_pais= $registro[3];
			$consulta = "call alta_remito_vta($num_remito,$fecha,'$lugar','$hora',$cod_cliente,$cod_zona,$cod_localidad,$cod_prov,$cod_pais,'$cod_tt',$numero_tal,$categoria,$vendedor,$repartidor,'$obs','S')";
	}
	if ($cod_cliente == "no_cliente"){//---------------------NO CLIENTE
			$consulta = "call alta_remito_vta_no_cliente($num_remito,$fecha,'$lugar','$hora','$cod_tt',$numero_tal,'$razon','$dir','$localidad','$provincia','$iva','$cuit',$categoria,$vendedor,$repartidor,'$obs',$zona,'S')";
	}
	$result = mysql_query($consulta);        // hace la consulta
	echo $consulta;
	
	//***********************************************************************************************************//
	//                            DATOS DEL DETALLE
	//***********************************************************************************************************//	
	$consulta = "SELECT * FROM remito_vta_tmp where usuario = '$usuario_rem' ORDER BY linea";
	$result = mysql_query($consulta);            // hace la consulta
	$registro = mysql_fetch_row($result);        // toma el registro

	$detalle="";
	$total_linea=35;							 // Total de lineas que se pueden imprimir en el remito
	$cant_linea=0; 

	do{
			$cod_prod= $registro[1];
			$descripcion = $registro[2];
			$cantidad = $registro[3];
			$precio = $registro[4];
			$bonificacion  = $registro[5];
						
			$consulta2 = "SELECT cod_variedad,cod_marca,cod_grupo,cod_prod FROM producto where concat(cod_grupo, cod_marca, cod_variedad, cod_prod) = $cod_prod";
			//echo $consulta2."<br>";
			$result2 = mysql_query($consulta2);            // hace la consulta
			$registro2 = mysql_fetch_row($result2);        // toma el registro
			$cod_variedad = $registro2[0];
			$cod_marca = $registro2[1];
			$cod_grupo  = $registro2[2];
			$cod_producto  = $registro2[3];
				
			if ($cod_cliente != "no_cliente"){//---------------------CLIENTE
				$consulta3 = "call alta_remito_vta_detalle($num_remito,$cod_producto,$cod_variedad,$cod_marca,$cod_grupo,$cantidad,$precio,$bonificacion)"; 
			}
			if ($cod_cliente == "no_cliente"){//---------------------NO CLIENTE
				$consulta3 = "call alta_remito_vta_detalle_no_cliente($num_remito,$cod_producto,$cod_variedad,$cod_marca,$cod_grupo,$cantidad,$precio,$bonificacion)"; 				
			}
			$result3 = mysql_query($consulta3);        // hace la consulta
			//echo $consulta3."<br>";
	
	
			// *********************************************************************************************************** //
			//                            CARGA LA VARIABLE PARA ENVIAR A IMRIMIR
			// *********************************************************************************************************** //	
			$consulta_iva = "SELECT tasa FROM alicuota_iva"; // consulta sql
			$result_iva = mysql_query($consulta_iva);            // hace la consulta
			$registro_iva = mysql_fetch_row($result_iva);        // toma el registro
			$tasa_iva = $registro_iva[0];
			
			$cant_linea++;
							   
			$importe_bonif=(($cantidad * $precio)*$bonificacion)/100;
			$importe_bonif=$importe_bonif; 
		    $importe=($cantidad * $precio)- $importe_bonif; 
			$importe = $importe + (($importe * $tasa_iva)/100);
			
			$detalle.="  $cod_prod \r ";												//  Codigo de Articulo
			$detalle.="\t    $cantidad \r"; 												//  Cantidad de Articulo
			$detalle.="\t\t  $descripcion \r"; 						//  Descripcion de Articulo  
			$detalle.="\t\t\t\t\t\t    $bonificacion \r";									//  importe  Bonificacion 
		    
			$importe_bonif = number_format($importe_bonif,2,'.','');
			$importe = number_format($importe,2,'.','');
			
			$detalle.="\t\t\t\t\t\t\t    $importe_bonif \r ";							    //  Precio Unitario 
		    $detalle.="\t\t\t\t\t\t\t\t      $importe \r\n ";						//  Precio total  
		
			$total_remito = $total_remito + $importe;
			$total_remito = number_format($total_remito,2,'.','');
			
	}while($registro = mysql_fetch_array($result)); 	// obtengo los resultados 
	
    while($cant_linea < $total_linea){
				$detalle.="\r\n";
				$cant_linea++;
    }
						   
	//***********************************************************************************************************//
	//                            VACIA TABLA DE ARTICULOS TEMPORAL
	//***********************************************************************************************************//	
	$consulta = "call vaciar_tabla_rem_vta_tmp('$usuario_rem')";
	$result = mysql_query($consulta);            // hace la consulta
					   
   // *********************************************************************************************************** //
   //                            ENVIA A IMPRIMIR
   // *********************************************************************************************************** //	
							
   $len_num_sucursal=strlen($num_sucursal); 					// completo el numero de la sucursal con ceros
   while ($len_num_sucursal < 4){
			$ceros_2.="0";
			$len_num_sucursal++;
   }
   $num_sucursal=$ceros_2.$num_sucursal;

  //----------------------------------------------------------------------------------------------------------------//				  
  $ano = substr($fecha,0,4); 
  $mes = substr($fecha,4,2);
  $dia = substr($fecha,-2);
  $fecha = "$dia/$mes/$ano";										// maqueta la fecha para imprimir
  //----------------------------------------------------------------------------------------------------------------//
  if($cuit != 'undefined'){
		  $cuit1=substr($cuit,0,2);
		  $cuit2=substr($cuit,2,-1);
		  $cuit3=substr($cuit,-1);
		  $cuit = "$cuit1-$cuit2-$cuit3"; 								// maqueta el cuit para imprimir
  }else{
		  $cuit = ""; 								// maqueta el cuit para imprimir
  }

  //----------------------------------------------------------------------------------------------------------------//
  $len_numero_rem=strlen($num_remito); 							// completo el numero de remito con ceros
  while ($len_numero_rem < 8){
   	    $ceros_3.="0";
		$len_numero_rem++;
  }
  $num_remito=$ceros_3.$num_remito;
			  
  $observacion = $lugar." ".$hora." ".$obs; 				// toma la variable de la url q vino de ajax.js
  
  //================INFO IVA =================//
  $consulta_iva= "SELECT * from iva where cod_iva = $iva"; // consulta sql
  $result_iva = mysql_query($consulta_iva);            // hace la consulta
  $registro_iva = mysql_fetch_row($result_iva);        // toma el registro
  $nombre_iva = $registro_iva[2];
  
  
  //================INFO REPARTIDOR =================//
  $consulta_fletero = "SELECT fletero.nombre, fletero.domicilio, localidad.nombre, provincia.nombre,concat(vehiculo.marca,' mod: ', vehiculo.modelo),vehiculo.patente, fletero.cuit, fletero.cod_iva   
  					from provincia inner join (localidad inner join (fletero inner join (fletero_por_vehiculo inner join vehiculo 
					on vehiculo.cod_vehiculo = fletero_por_vehiculo.cod_vehiculo)
					on fletero_por_vehiculo.cod_flero = fletero.cod_flero)
					on fletero.cod_localidad = localidad.cod_localidad)
					on localidad.cod_prov = provincia.cod_prov
					where fletero.cod_flero = $repartidor"; // consulta sql
  
  $result_fletero = mysql_query($consulta_fletero);            // hace la consulta
  $registro_fletero = mysql_fetch_row($result_fletero);        // toma el registro
  
  $fletero_nombre = $registro_fletero[0];
  $fletero_domicilio = $registro_fletero[1];
  $fletero_localidad = $registro_fletero[2];
  $fletero_provincia= $registro_fletero[3];
  $fletero_camion = $registro_fletero[4];
  $fletero_patente = $registro_fletero[5];
  
  $fletero_cuit = $registro_fletero[6];
  if($fletero_cuit != ''){
		  $fletero_cuit1=substr($fletero_cuit,0,2);
		  $fletero_cuit2=substr($fletero_cuit,2,-1);
		  $fletero_cuit3=substr($fletero_cuit,-1);
		  $fletero_cuit = "$fletero_cuit1-$fletero_cuit2-$fletero_cuit3"; 								// maqueta el cuit para imprimir
  }else{
		  $fletero_cuit = ""; 								// maqueta el cuit para imprimir
  }
  
  
  
  $fletero_cod_iva = $registro_fletero[7];
  $consulta_fletero = "SELECT * from iva where cod_iva = $fletero_cod_iva"; // consulta sql
  $result_fletero = mysql_query($consulta_fletero);            // hace la consulta
  $registro_fletero = mysql_fetch_row($result_fletero);        // toma el registro
  $fletero_cod_iva = $registro_fletero[2];
  
  
  //================INFO VENDEDOR =================//
  $consulta_vendedor = "SELECT vendedor.nombre   
  					from provincia inner join (localidad inner join vendedor 
					on vendedor.cod_localidad = localidad.cod_localidad)
					on localidad.cod_prov = provincia.cod_prov
					where vendedor.cod_vendedor = $vendedor"; // consulta sql
  
  $result_vendedor = mysql_query($consulta_vendedor);            // hace la consulta
  $registro_vendedor = mysql_fetch_row($result_vendedor);        // toma el registro
  
  $vendedor_nombre = $registro_vendedor[0];
  
  $hora_actual = date("H:i:s");
  
  //----------------------------------------------------------------------------------------------------------------//				  
  //include("imprimir_remito.php");	 						// Incluye la pagina para imprimir las facturas
	
}else{
	require("smarty.php");  // requiere la pag "smarty.php" para crear una instancia de Smarty 
	$smarty = new ClaseSmarty; //crea una instancia
	$smarty->assign('dia',date("d",time())); //asigna la variable "dia"
	$smarty->assign('mes',date("m",time())); //asigna la variable "mes"
	$smarty->assign('ano',date("Y",time())); //asigna la variable "año"

	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============// 
	$modulo="cta_cte";
	$plantilla = "asignacion_tal_recibo.tpl";
	require("validar_permiso.php");	 
}
?>
