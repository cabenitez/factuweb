<? 
session_start();   // Iniciar sesión
$usuario_rem = $_SESSION['user_usuario']; //usuario conectado


$id = $_POST["id"]; 																	  // toma la variable de la url q vino de ajax.js
if($id){ 
	// id categoria
	$id_cat = $_POST["id_cat"]; 														  // toma la variable de la url q vino de ajax.js
	// codigo del talonario
	if(empty($codigo_tal)){
		$codigo_tal= "A";
	}else{
		$codigo_tal= $_POST["codigo_tal"]; 	// toma la variable de la url q vino de ajax.js
	}

	include('conexion.php');
	$consulta_ = "select * from pedidos where id_dep = $id and tipo = 'A'"; 		        // consulta sql,       tipo='A' -> ARTICULO
	$result_ = mysql_query($consulta_);            										  	// hace la consulta
	$registro_ = mysql_fetch_row($result_);        							  		
	$nfilas_ = mysql_num_rows ($result_); 			         							  	//indica la cantidad de resultados
	//echo $nfilas.'<br>';	   						 							    			
	if($nfilas_ > 0){																		// obtiene la cantidad de articulos del pedido
		$error = false;
		do{ 																			  	// obtengo los resultados 
			$id= $registro_[0]; 					
			$nombre= $registro_[1]; 					
			$id_dep= $registro_[2]; 					
			$codigo_art= $registro_[3]; 					
			$cant_art= $registro_[4]; 					
			$peso= $registro_[5]; 					
			$tipo= $registro_[6]; 					
			$estado= $registro_[7]; 			
			
			$importe_art= 0; 										
			$bonif_art = $peso; 
			
			//------------------------------------------- verifica si el articulo es algun codigo especial ------------------------------------------------//
			$consulta2 = "SELECT * FROM art_especial where codigo = $codigo_art"; 
			$result2 = mysql_query($consulta2);            			// hace la consulta
			$registro2 = mysql_fetch_row($result2);        			// toma el registro
			$nfilas2 = mysql_num_rows ($result2);          		//indica la cantidad de resultados
			if ($nfilas2 > 0){     						 		// si ya existe el articulo
				$tipo_art_esp = $registro2[1]; 					   			
				$valor_art_esp = $registro2[2];			 										
			
				$siguiente = false;  									// variable q controla si se lee un nuevo registro
				if($tipo_art_esp == 'DE'){								// DESCUENTO
					$bonif_art = $valor_art_esp; 						
					$siguiente = true;
				}
				
				if($tipo_art_esp == 'SC'){								// SIN CARGO
					$bonif_art = 100; 						
					$siguiente = true;
				}

				if($tipo_art_esp == 'NC'){								// NO COMPRA
						$error = true;
						echo 'MOTIVO: '.$valor_art_esp;
						break;								
				}
				
				if($siguiente){ 										// lee el siguiente registro 
					$registro_ = mysql_fetch_row($result_);      							  		
					$id= $registro_[0]; 					
					$nombre= $registro_[1]; 					
					$id_dep= $registro_[2]; 					
					$codigo_art= $registro_[3]; 					
					$cant_art= $registro_[4]; 					
					$peso= $registro_[5]; 					
					$tipo= $registro_[6]; 					
					$estado= $registro_[7]; 			
				}
			}
			
			//----------------------------------- Obtengo la descripcion --------------------------------------// 
			$consulta2 = "SELECT descripcion FROM producto where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $codigo_art"; // obtiene el numero del talonario
			$result2 = mysql_query($consulta2);            			// hace la consulta
			$registro2 = mysql_fetch_row($result2);        			// toma el registro
			$desc_art = $registro2[0]; 					   			// OK
			
			//----------------------------------- Obtengo el precio --------------------------------------// 
			$consulta2 = "SELECT precio_vta FROM prod_por_categ where cod_categoria = $id_cat and concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $codigo_art"; // obtiene el numero del talonario
			$result2 = mysql_query($consulta2);            			// hace la consulta
			$registro2 = mysql_fetch_row($result2);        			// toma el registro
			$precio_art = $registro2[0]; 					   		// OK

			//-----------------------------------Obtengo el numero de Filas --------------------------------------// 
			$consulta = "SELECT max(num_talonario) FROM talonario where cod_talonario = '$codigo_tal'"; // obtiene el numero del talonario
			$result = mysql_query($consulta);            // hace la consulta
			$registro = mysql_fetch_row($result);        // toma el registro
			$max_num_tal= $registro[0]; 		// OK

			//-----------------------------------Obtengo el numero max de iteraciones ----------------------------// 
			$consulta = "SELECT max_iter FROM talonario where num_talonario = $max_num_tal AND cod_talonario = '$codigo_tal'"; 			
			$result = mysql_query($consulta);          
			$registro = mysql_fetch_row($result);       
			$max_iter= $registro[0];
			
			//-----------------------------------Obtengo la cantidad de articulos --------------------------------// 
			$consulta = "SELECT count(linea) FROM factura_vta_tmp where usuario = '$usuario_rem'";		
			$result = mysql_query($consulta);            
			$registro = mysql_fetch_row($result);        
			$num_iter = $registro[0];		
			
			//-----------------------------------Obtengo la cantidad de articulos--------------------------------------// 
			$consulta = "SELECT * FROM factura_vta_tmp where usuario = '$usuario_rem' and cod_prod = $codigo_art and bonificacion = 100";
			$result = mysql_query($consulta);            
			$nfilas = mysql_num_rows ($result);          		//indica la cantidad de resultados
			if ($nfilas > 0){     						 		// si ya existe el articulo
					echo "ERROR: El aticulo ya ha sido agregado";
			}else{
				if($num_iter < $max_iter){																	// verifica que las lineas sean menor al max	
					$consulta = "SELECT max(linea) FROM factura_vta_tmp where usuario = '$usuario_rem'"; 	// asigna el numero siguiente al mayor
					$result = mysql_query($consulta);          
					$registro = mysql_fetch_row($result);       
					$linea = $registro[0] + 1;		
					
					$consulta = "call alta_factura_vta_tmp('$usuario_rem', $codigo_art,'$desc_art',$cant_art,$precio_art,$bonif_art,$importe_art,$linea)"; // llama al procedimiento almacecnado
					$result = mysql_query($consulta);        
					//echo $consulta;
				}else{
					echo "ERROR: Limite exedido, Maximo $max_iter iteraciones por Factura '$codigo_tal'";
				}	
			}	

		}while($registro_ = mysql_fetch_array($result_));
		
		if(!$error){ 				// si no ocurrio ningun error
			echo 'ok';
		}
			
	}		
}
?>