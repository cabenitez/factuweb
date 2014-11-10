<? 
session_start();   										// Iniciar sesión
$usuario_fac = $_SESSION['user_usuario']; 		//usuario conectado

$fecha_carga_act = $_POST["fecha"]; 					// toma la variable de la url q vino de ajax.js
		
include("conexion.php");

// factura para registrar 	*********************************************************************************************
$razon = $_POST["razon"]; 		// toma la variable de la url q vino de ajax.js
if($razon){ 
	$repartidor = $_POST["repartidor"]; 	// toma la variable de la url q vino de ajax.js
	
	$consulta = "SELECT * FROM cargas where cod_flero = $repartidor and fecha = $fecha_carga_act"; // consulta sql
	$result = mysql_query($consulta);            // hace la consulta
	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	if ($nfilas == 0){     						 // si existe el usuario inicia la sesion
				
				$fecha = $_POST["fecha"]; 				// toma la variable de la url q vino de ajax.js
				$lugar = $_POST["lugar"]; 				// toma la variable de la url q vino de ajax.js
				$hora = $_POST["hora"]; 				// toma la variable de la url q vino de ajax.js
				$cod_cliente = $_POST["cod_cliente"]; 	// toma la variable de la url q vino de ajax.js
				$numero_rem = $_POST["numero_rem"]; 	// toma la variable de la url q vino de ajax.js     puede ser: "sin_remito = 0";
				$categoria = $_POST["categoria"]; 		// toma la variable de la url q vino de ajax.js
				$dir = $_POST["dir"]; 					// toma la variable de la url q vino de ajax.js
				$localidad = $_POST["localidad"]; 		// toma la variable de la url q vino de ajax.js
				$provincia = $_POST["provincia"]; 		// toma la variable de la url q vino de ajax.js
				$cuit = $_POST["cuit"]; 				// toma la variable de la url q vino de ajax.js
				$vendedor = $_POST["vendedor"]; 		// toma la variable de la url q vino de ajax.js
				$obs = $_POST["obs"]; 					// toma la variable de la url q vino de ajax.js
				$zona = $_POST["zona"]; 				// toma la variable de la url q vino de ajax.js
				$forma_pago = $_POST["forma_pago"]; 	// toma la variable de la url q vino de ajax.js
				$hora_actual = $_POST["hora_actual"]; 	// toma la variable de la url q vino de ajax.js
			
				$tasa_iva = 0;
				//$tasa_iva = $_POST["tasa_iva"]; 				// toma la variable de la url q vino de ajax.js
				$tasa_perc_iva = $_POST["tasa_perc_iva"]; 		// toma la variable de la url q vino de ajax.js
				$tasa_img_bruto = $_POST["tasa_img_bruto"]; 	// toma la variable de la url q vino de ajax.js
				$monto_imp_int = $_POST["monto_imp_int"]; 		// toma la variable de la url q vino de ajax.js
			
				$lugar = strtoupper($lugar);
				$hora = strtoupper($hora);
				$razon = strtoupper($razon);
				$dir = strtoupper($dir);	
				$localidad = strtoupper($localidad);	
				$provincia = strtoupper($provincia);
				$obs = strtoupper($obs);
			
				// Obtiene el numero de factura *********************************************************************************************
				$cond_iva = $_POST["cond_iva"]; // toma la variable de la url q vino de ajax.js ** Obtiene el tipo de comprobante **
		
				//-----------------------------------Obtengo el numero de Factura y el tipo-------------------------------// 
				$consulta ="select * from iva inner join tipo_talonario on tipo_talonario.cod_talonario = iva.cod_talonario where iva.cod_iva = $cond_iva"; // obtiene el tipo de talonario
				$result = mysql_query($consulta);            // hace la consulta
				$registro = mysql_fetch_row($result);        		// toma el registro
				$cond_iva_nombre = $registro[2]; 					
				$codigo_tal = $registro[4]; 					
				$descripcion_tt = $registro[5]; // OK
				$cant_copias = $registro[6]; 	// OK
				
				$consulta = "SELECT max(num_talonario) FROM talonario where cod_talonario = '$codigo_tal'"; // obtiene el numero del talonario
				$result = mysql_query($consulta);            // hace la consulta
				$registro = mysql_fetch_row($result);        // toma el registro
				$numero_tal= $registro[0]; 		// OK
				
				$consulta = "SELECT n_sucursal, destino_impr FROM talonario where num_talonario = $numero_tal and cod_talonario = '$codigo_tal'"; // obtiene el numero de sucursal
				$result = mysql_query($consulta);            // hace la consulta
				$registro = mysql_fetch_row($result);        // toma el registro
				$num_sucursal = $registro[0]; 	// OK
				
				//================================ OBTIENE EL DESTINO DE IMPRESION==================================================================================//				
				$impresora= $registro[1]; 		// OK
				$posicion_comodin = strrpos ($impresora, "#"); 		
				$impresora = substr($impresora, 0,$posicion_comodin); 		// obtiene solo la info de la impresora
				$impresora = "/printers/".$impresora;
				//================================FIN =============================================================================================================//				
		
				//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
				//\\//\\//\\//\\//\\//\\//\\ FISCAL //\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
				//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
				
				$impresora_fiscal = 0; // OBTENER PARAMETRO DE TABLA TALONARIO 
				
				if($impresora_fiscal == 1){
					$array_fiscal = array();
					$i_fiscal = 1;
					$serie_fiscal = "27-0163848-435";
					$puerto_fiscal = "/dev/ttyS0";	//	dev/ttyS0 		-		COM1
					$velocidad_fiscal = 9600;					
				}

				//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
				//\\//\\//\\//\\//\\//\\//\\ FISCAL //\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
				//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
		
				$array_pdf_cod = array();
				$array_pdf_cant = array();
				$array_pdf_desc = array();
				$array_pdf_bon = array();
				$array_pdf_imp = array();
				$array_pdf_pu = array();
				$array_pdf_iva = array();
				$array_pdf_importe = array();
				
				$i_pdf = 1;
		
				//----------------------------si no existen facturas todavia------------------------------------------------//
				$consulta = "SELECT sig_num FROM talonario where cod_talonario = '$codigo_tal' AND  num_talonario = $numero_tal"; // obtiene el numero del talonario
				$result = mysql_query($consulta);            // hace la consulta
				$registro = mysql_fetch_row($result);        // toma el registro
				$num_factura = $registro[0];
				
				$nfilas = 0;
				/**************** MARGEN *********************/
				$margen = "\t\t\t";
				
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
			function buscar_numero($cod_tal,$num_tal, $num_fac,$fecha_anular){
				$consulta3 = "SELECT * FROM factura_anulada_numeracion where cod_talonario = '$cod_tal' AND num_talonario = $num_tal AND n_factura=$num_fac"; 
				$result3 = mysql_query($consulta3);            
				$nfilas3 = mysql_num_rows ($result3);          					
				$registro3 = mysql_fetch_row($result3);        // toma el registro
				
				if ($nfilas3 > 0){
					// REGISTRA UNA FACTURA CON LA NUMERACION, PERO COMO ANULADA
					$usuario_anular = $registro3[4];
					$consulta4 = "call alta_factura_vta_no_cliente($num_fac,$fecha_anular,'ANULADO','ANULADO','ANULADO','ANULADO',9999,'ANULADO','ANULADO','ANULADO',9999,'ANULADO',9999,9999,9999,'$cod_tal',$num_tal,9999,9999,9999,9999,9999,'$usuario_anular',9999)";
					mysql_query($consulta4);
					
					$consulta5 = "call alta_factura_vta_detalle_no_cliente($num_fac,1,1,1,1,1,1,1,'$cod_tal',$num_tal)"; 	 			
					$result5 = mysql_query($consulta5);        // hace la consulta

					return (buscar_numero($cod_tal,$num_tal,$num_fac + 1,$fecha_anular));
				}else{ 
					return($num_fac);
				}
				
			}
	
			$num_factura = buscar_numero($codigo_tal,$numero_tal, $num_factura,$fecha);

				
				
				// Obtengo el nombre de la forma de pago
				$consulta = "SELECT descripcion FROM forma_pago where cod_fp = $forma_pago"; // obtiene el numero de sucursal
				$result = mysql_query($consulta);            // hace la consulta
				$registro = mysql_fetch_row($result);        // toma el registro
				$forma_pago_nombre = $registro[0]; 	// OK
		
				
				
				//***********************************************************************************************************//
				//                            DATOS DEL CLIENTE Y DEL REMITO
				//***********************************************************************************************************//	
						//---------------------SI ES CLIENTE---------------------------------//
						if ($cod_cliente != "no_cliente"){ 
							$consulta = "SELECT cliente.cod_zona, cliente.cod_localidad, cliente.cod_prov, cliente.cod_pais, razon_social, direccion, localidad.nombre, localidad.cp  FROM cliente inner join (zona inner join localidad on localidad.cod_localidad = zona.cod_localidad) on zona.cod_zona = cliente.cod_zona where cod_cliente = $cod_cliente"; // consulta sql
							$result = mysql_query($consulta);            // hace la consulta
							$registro = mysql_fetch_row($result);        // toma el registro
							$cod_zona= $registro[0];
							$cod_localidad= $registro[1];
							$cod_prov= $registro[2];
							$cod_pais= $registro[3];
							$razon= $registro[4];
							$dir= $registro[5];
							$localidad= $registro[7]. " - ".$registro[6];
							
							$consulta = "call alta_factura_vta($num_factura,$fecha,'$lugar','$hora',$cod_cliente,$cod_zona,$cod_localidad,$cod_prov,$cod_pais,$numero_rem,'$codigo_tal',$numero_tal,$categoria,$vendedor,$repartidor,'$obs',$tasa_iva,$tasa_perc_iva,$tasa_img_bruto,$monto_imp_int,'$usuario_fac',$forma_pago)";
						    //echo $consulta;
						}
						//---------------------SI NO ES CLIENTE---------------------------------//
						if ($cod_cliente == "no_cliente"){
							$consulta = "call alta_factura_vta_no_cliente($num_factura,$fecha,'$lugar','$hora','$obs','$razon',$zona,'$dir','$localidad','$provincia',$cond_iva,'$cuit',$categoria,$vendedor,$repartidor,'$codigo_tal',$numero_tal,$numero_rem,$tasa_iva,$monto_imp_int,$tasa_perc_iva,$tasa_img_bruto,'$usuario_fac',$forma_pago)";
						}
						if($result = mysql_query($consulta)){        // hace la consulta
							//echo $consulta;
							
							//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
							//\\//\\//\\//\\//\\//\\//\\ FISCAL //\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
							//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\

							if($impresora_fiscal == 1){			    // si se definio la impresora fiscal
								$array_fiscal[$i_fiscal++] = "@PONEENCABEZADO|5|."; //SFyCSOL FACTURA $codigo_tal
								
								if($cuit != ""){
									$cuit_fiscal = "CUIT|$cuit";
								}else{
									$cuit_fiscal = "|";
								}
								if($numero_rem != 0){
									$remito_fiscal = $numero_rem;
								}else{
									$remito_fiscal = ""; 
								}
								
								$consulta_emp = "select cod_iva from empresa inner join iva on iva.nombre = empresa.iva"; // consulta sql
								$result_emp = mysql_query($consulta_emp);            // hace la consulta
								$registro_emp = mysql_fetch_row($result_emp);        // toma el registro
								$cond_iva_empresa = $registro_emp[0];
								
								include("equivalencia_cond_iva.php");

								$cond_iva_fiscal_empresa = equivalenciaCondIva($cond_iva_empresa);
								$cond_iva_fiscal_cliente = equivalenciaCondIva($cond_iva);
							
								$array_fiscal[$i_fiscal++] = "@FACTABRE|F|C|$codigo_tal|$cant_copias|F|10|$cond_iva_fiscal_empresa|$cond_iva_fiscal_cliente|$razon||$cuit_fiscal|N|$dir|||$remito_fiscal||C";
							}
							//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
							//\\//\\//\\//\\//\\//\\//\\ FISCAL //\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
							//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
							
							//***********************************************************************************************************//
							//                            DATOS DEL DETALLE
							//***********************************************************************************************************//	
							$consulta = "SELECT * FROM factura_vta_tmp where usuario = '$usuario_fac' ORDER BY linea";
							$result = mysql_query($consulta);            // hace la consulta
							$registro = mysql_fetch_row($result);        // toma el registro
							
							// parametros varios //
							$detalle="";
							$total_linea=35;							// Total de lineas que se pueden imprimir en la factura 
							$cant_linea=0; 
							$iva_importe_imprimir = array();			// Array de importes
							
							do{
								$cod_prod= $registro[1];
								$descripcion = $registro[2];
								$cantidad = $registro[3];
								$precio = $registro[4];
								$bonificacion  = $registro[5];
								$tasa_iva  = $registro[8];
										
								$consulta2 = "SELECT cod_prod, cod_variedad, cod_marca, cod_grupo, unidad_bulto FROM producto where concat(cod_grupo, cod_marca, cod_variedad, cod_prod) = $cod_prod";
								//echo $consulta2."<br>";
								$result2 = mysql_query($consulta2);            // hace la consulta
								$registro2 = mysql_fetch_row($result2);        // toma el registro
									
								$cod_producto = $registro2[0];
								$cod_variedad = $registro2[1];
								$cod_marca = $registro2[2];
								$cod_grupo  = $registro2[3];
								$unidad_bulto  = $registro2[4];
								
								//---------------------SI ES CLIENTE---------------------------------//
								if ($cod_cliente != "no_cliente"){ 
									$consulta3 = "call alta_factura_vta_detalle($num_factura,$cod_producto,$cod_variedad,$cod_marca,$cod_grupo,$cantidad,$precio,$bonificacion,'$codigo_tal',$numero_tal,$tasa_iva)"; 
								} 
								//---------------------SI NO ES CLIENTE------------------------------//
								if ($cod_cliente == "no_cliente"){ 
									$consulta3 = "call alta_factura_vta_detalle_no_cliente($num_factura,$cod_producto,$cod_variedad,$cod_marca,$cod_grupo,$cantidad,$precio,$bonificacion,'$codigo_tal',$numero_tal,$tasa_iva)"; 				
								}
								$result3 = mysql_query($consulta3);        // hace la consulta
							   //***********************************************************************************************************//
							   //                           DESCUENTA STOCK DE LA TABLA PRODUCTO
							   //***********************************************************************************************************//	
								$consulta_stock = "call descontar_stock($cod_producto,$cod_variedad,$cod_marca,$cod_grupo,$cantidad)"; 				
								$result_stock = mysql_query($consulta_stock);        // hace la consulta
								//echo $consulta_stock."<br>";
		
							   //***********************************************************************************************************//
							   //                            SI SE FACTURO UN REMITO CAMBIAR EL ESTADO
							   //***********************************************************************************************************//	
							   if($numero_rem != "0"){
								   if ($cod_cliente == "no_cliente"){
											$consulta5 = "call modificar_estado_remito_vta_no_cliente($numero_rem)";
									}
									if ($cod_cliente != "no_cliente"){ 
											$consulta5 = "call modificar_estado_remito_vta($numero_rem)";
									}
									$result5 = mysql_query($consulta5);            // hace la consulta
								}
							   
							   //***********************************************************************************************************//
							   //                            CARGA LA VARIABLE PARA ENVIAR A IMRIMIR
							   //***********************************************************************************************************//	
							   $cant_linea++;
							   
							   $importe_bonif=($precio*$bonificacion)/100;
							   $precio = $precio-$importe_bonif;
							   							  
							   $importe_sin_iva = ($cantidad * $precio)-$importe_bonif;
							   
							   if($codigo_tal == "B" || $codigo_tal == "X"){
									$precio = $precio + ($precio * $tasa_iva /100);   				// (*****/\/\***) //
									if ($cond_iva_nombre != 'MONOTRIBUTO'){
										$precio = $precio + ($precio * $tasa_img_bruto / 100 );
									}
								}

								$importe = $precio * $cantidad; 
							   	$importe_bonif = number_format($importe_bonif,2,'.','');
								$precio = number_format($precio,2,'.','');
								$importe = number_format($importe,2,'.','');

							    $detalle.= $margen."$cod_prod\r";													//  Codigo de Articulo
							    $detalle.= $margen."\t $cantidad \r"; 												//  Cantidad de Articulo
							    $detalle.= $margen."\t\t $descripcion \r"; 											//  Descripcion de Articulo  
							    $detalle.= $margen.$margen.$margen."\t\t\t $bonificacion \r";						//  % Bonificacion 
								$detalle.= $margen.$margen.$margen."\t\t\t\t $importe_bonif \r";					//  importe  Bonificacion 
							    $detalle.= $margen.$margen.$margen."\t\t\t\t\t $precio \r ";						//  Precio Unitario
 						    	$detalle.= $margen.$margen.$margen."\t\t\t\t\t\t $tasa_iva \r ";				  	//  Tasa IVA
							    $detalle.= $margen.$margen.$margen."\t\t\t\t\t\t\t $importe\r\n ";					//  Precio total  
		
								$total_importe = $total_importe + $importe; 										//  SUBTOTAL PARA X
							    $total_importe_sin_iva = $total_importe_sin_iva + $importe_sin_iva; 				//  

								//====PDF===//
								$i_pdf++;
								$array_pdf_cod[$i_pdf] = $cod_prod;
								$array_pdf_cant[$i_pdf] = $cantidad;
								$array_pdf_desc[$i_pdf] = $descripcion;
								$array_pdf_bon[$i_pdf] = $bonificacion;
								$array_pdf_imp[$i_pdf] = $importe_bonif;
								$array_pdf_pu[$i_pdf] = $precio;
								$array_pdf_iva[$i_pdf] = $tasa_iva;
								$array_pdf_importe[$i_pdf] = $importe;
								//====PDF===//
								
	
		
								
								//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
								//\\//\\//\\//\\//\\//\\//\\ FISCAL //\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
								//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\

								if($impresora_fiscal == 1){			    // si se definio la impresora fiscal
									$cantidad_fiscal = number_format($cantidad,3,'.','');
									$importe_fiscal = number_format($importe,2,'.','');
									$tasa_iva_fiscal = number_format($tasa_iva/100,4,'.','');
									$tav_fiscal = number_format(0,4,'.','');
									
									//La tasa de ajuste variable se usa cuando hay impuestos internos.
									//BI = Base Imponible
									//MII = Monto del Impuesto Interno
									//TAV = BI/(BI + MII)
									
									$array_fiscal[$i_fiscal++] = "@FACTITEM|$descripcion|$cantidad_fiscal|$importe_fiscal|$tasa_iva_fiscal|M|1|0||||$tav_fiscal|0";
								}								
								//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
								//\\//\\//\\//\\//\\//\\//\\ FISCAL //\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
								//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\

								$iva_importe_imprimir[$tasa_iva]  = $iva_importe_imprimir[$tasa_iva] + $importe;

						   }while($registro = mysql_fetch_array($result)); 	// obtengo los resultados 

						   
						   if($codigo_tal == "X"){
								$total_linea=21;							// Total de lineas que se pueden imprimir en la factura 
						   }
						   
						   while($cant_linea < $total_linea){
								$detalle.="\r\n";
								$cant_linea++;
						   }
						   
						   //***********************************************************************************************************//
						   //                            VACIAR TABLA DE ARTICULOS TEMPORAL
						   //***********************************************************************************************************//	
						   $consulta4 = "call vaciar_tabla_fac_vta_tmp('$usuario_fac')";
						   $result4 = mysql_query($consulta4);            // hace la consulta
						   
						  //----------------------------------------------------------------------------------------------------------------//				   
						   $len_num_factura=strlen($num_factura); 						// completo el numero de factura con ceros
						   while ($len_num_factura < 8){								// completo el numero de la factura con ceros
								$ceros.="0";
								$len_num_factura++;
						   }
						   $num_factura=$ceros.$num_factura;
							
						   $len_num_sucursal=strlen($num_sucursal); 					// completo el numero de la sucursal con ceros
						   while ($len_num_sucursal < 4){
								$ceros_2.="0";
								$len_num_sucursal++;
						   }
						   $num_sucursal=$ceros_2.$num_sucursal;
						  //----------------------------------------------------------------------------------------------------------------//				  
						  $hora_actual = date("H:i:s");

						  $dia = date("d",time());  //asigna una cadena a la variable "dia"
						  $mes = date("m",time());  //asigna una cadena a la variable "mes"
						  $ano = date("Y",time());  //asigna una cadena a la variable "año"

						  $fecha = "$dia/$mes/$ano";										// maqueta la fecha para imprimir
						  //----------------------------------------------------------------------------------------------------------------//
						  if($cuit != 'undefined'){
								  $cuit1=substr($cuit,0,2);
								  $cuit2=substr($cuit,2,-1);
								  $cuit3=substr($cuit,-1);
								  $cuit = "$cuit1-$cuit2-$cuit3"; 								// maqueta el cuit para imprimir
						  }else{
								  $cuit = " "; 								// maqueta el cuit para imprimir
						  }
						  
						  //----------------------------------------------------------------------------------------------------------------//
						  $len_numero_rem=strlen($numero_rem); 							// completo el numero de remito con ceros
						  
						  while ($len_numero_rem < 8){
								$ceros_3.="0";
								$len_numero_rem++;
						  }
						  
						  if($numero_rem != "00000000"){
								$numero_rem=$ceros_3.$numero_rem;
						  }else{
								$numero_rem=" ";
						  }
								
						  $observacion = $lugar." ".$hora." ".$obs; 				// toma la variable de la url q vino de ajax.js
						  
  						  //***********************************************************************************************************//
						  //                            ENVIA A IMPRIMIR
						  //***********************************************************************************************************//	
						  if($codigo_tal == 'X'){
							  include("imprimir_presupuesto.php");	 						// Incluye la pagina para imprimir las facturas
						  }else{ 
							  include("imprimir_factura_pdf.php");	 							// Incluye la pagina para imprimir las facturas
						  }
						   
						   echo "ok";  
						}	
	}else{
		echo 'existe_carga' ;  
	}			
}else{ // nueva factura - obtiene los parametros **************************************************************************************
	
	//	vacia la tabla temporal en caso de que haya quedado pendiente una factura en una sesion anterior o un caso externo
	$consulta = "call vaciar_tabla_fac_vta_tmp('$usuario_fac')";
	$result = mysql_query($consulta);            // hace la consulta

	require("smarty.php");  				 // requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; 				 //crea una instancia
	$smarty->assign('dia',date("d",time()));  //asigna una cadena a la variable "dia"
	$smarty->assign('mes',date("m",time()));  //asigna una cadena a la variable "mes"
	$smarty->assign('ano',date("Y",time()));  //asigna una cadena a la variable "año"
	//$smarty->display('alta_factura_vta.tpl');   //define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="factura_vta";
	$plantilla = "alta_factura_vta.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>
