<? 
// TIPO =	P: pedidos		V: vendedor		C: cliente	 A:articulo

$actualizar = $_POST["actualizar"]; 			// toma la variable de la url q vino de ajax.js
if($actualizar){ 
	$ruta = "./pedidos/";						// variable con la cadena q indica la ruta de los pedidos
	$dir = opendir($ruta);						// abre el directorio de pedidos
	$cant_archivos = 0;
	include('conexion.php');
	
	//********************************************************************************************************************
	function idSig(){																	// FUNCION que Obtiene el siguiente id de pedido
		$consulta_max = "select count(id)+1 from pedidos"; 								// consulta sql
		$result_max = mysql_query($consulta_max);            							// hace la consulta
		$registro_max = mysql_fetch_row($result_max);        							// toma el registro
		return $registro_max[0]; 					
	}
	//********************************************************************************************************************

	while ( $archivo=readdir($dir)) {			// lee el directorio y muestra los nombres de los archivos
		$ok = substr($archivo,0,3); 			// en caso de q el nombre empiese con OK_ no lo muestra, porque q ya se guardo en la base de datos anteriormente
		//$ext = filetype ($archivo);
		
		if ($archivo != "." && $archivo != ".." && $ok != 'OK_') { 
					//********************************************************************************************************************
					// guarda en la base de datos todos los archivos *.odb
					//********************************************************************************************************************
					$cant_archivos ++;
					$n_archivo = substr($archivo,7,4); 										 // saca la extension
					$nfilas = 0;
					$consulta = "SELECT * FROM pedidos where codigo = $n_archivo and tipo = 'P'"; // consulta sql
					$result = mysql_query($consulta);            							  // hace la consulta
					$nfilas = mysql_num_rows ($result);          							  //indica la cantidad de resultados
					$registro = mysql_fetch_row($result);        							  // toma el registro
					if ($nfilas == 0){     						 							  // si existe el usuario inicia la sesion
						$id_fila = idSig();													  // llama a la funcion para obtener el sig id
						$consulta = "call alta_pedido_odb($id_fila,'<b>Pedido N&ordm; $n_archivo</b>',0,$n_archivo,0,0,'P','-')";    // llama al procedimiento almacecnado
						$result = mysql_query($consulta);        							  // hace la consulta
					
						//********************************************************************************************************************
						// lee los archivos y guarda su contenido en la BD
						//********************************************************************************************************************
						$arch = fopen ($ruta.$archivo,"r");										  // abre el archivo
						while ($fila = fgetcsv ($arch, 1000, ",")) {							  // lee TODAS LAS LINEAS del archivo *.CSV y estrae los campos
								$n_pedido = $fila[0];
								$cod_cliente = $fila[1];
								$cod_art = $fila[2];
								$cant_art = $fila[3];
								$peso_art = $fila[4];
								$id_vendedor = $fila[5];
								//********************************************************************************************************************
								// guarda en la BD todos los VENDEDORES de cada pedido *.odb
								$nfilas = 0;
								$consulta = "SELECT * FROM pedidos where codigo = $id_vendedor and tipo = 'V' and id_dep = $id_fila"; 
								$result = mysql_query($consulta);            							  
								$nfilas = mysql_num_rows ($result);          							  
								if ($nfilas == 0){     						 							  
									/*
									$consulta2 = "SELECT nombre FROM vendedor where cod_vendedor = $id_vendedor"; 	
									$result2 = mysql_query($consulta2);            							  		
									$registro2 = mysql_fetch_row($result2);        							  		
									$nombre_vendedor= $id_vendedor.'-'.$registro2[0]; 					
									*/
									$id_sig = idSig();					// llama a la funcion para obtener el sig id
									
									$consulta3 = "call alta_pedido_odb($id_sig,'Vendedor N&ordm; $id_vendedor',$id_fila,$id_vendedor,0,0,'V','-')";    // llama al procedimiento almacecnado
									$result3 = mysql_query($consulta3);        							  // hace la consulta
								}
								//********************************************************************************************************************
								// guarda en la BD todos los CLIENTES de cada pedido *.odb
								$nfilas = 0;
								$consulta = "SELECT * FROM pedidos where codigo = $cod_cliente and tipo = 'C' and id_dep = $id_sig"; // consulta sql
								$result = mysql_query($consulta);            							  // hace la consulta
								$nfilas = mysql_num_rows ($result);          							  //indica la cantidad de resultados
								if ($nfilas == 0){     						 							  // si existe el usuario inicia la sesion
									/*
									$consulta2 = "SELECT razon_social FROM cliente where cod_cliente = $cod_cliente"; // consulta sql
									$result2 = mysql_query($consulta2);            							  // hace la consulta
									$registro2 = mysql_fetch_row($result2);        							  // toma el registro
									$nombre_cliente= $cod_cliente.' - '.$registro2[0]; 					
									*/
									$consulta1 = "SELECT id FROM pedidos where codigo = $n_archivo and tipo = 'P'"; // consulta sql
									$result1 = mysql_query($consulta1);            							  // hace la consulta
									$registro1 = mysql_fetch_row($result1);        							  // toma el registro
									$id_pedido = $registro1[0]; 					
	
									$consulta2 = "SELECT id FROM pedidos where codigo = $id_vendedor and tipo = 'V' and id_dep = $id_pedido"; // consulta sql
									$result2 = mysql_query($consulta2);            							  // hace la consulta
									$registro2 = mysql_fetch_row($result2);        							  // toma el registro
									$id_sig = $registro2[0]; 					
									
									
									$id_sig_cliente = idSig();					// llama a la funcion para obtener el sig id
	
									$consulta3 = "call alta_pedido_odb($id_sig_cliente,'Ped. $n_pedido: Cliente N&ordm; $cod_cliente',$id_sig,$cod_cliente,0,0,'C','-')";    // llama al procedimiento almacecnado
									$result3 = mysql_query($consulta3);        							  // hace la consulta
								}
								//********************************************************************************************************************
								// guarda en la BD todos los ARTICULOS de cada pedido *.odb
								/*
								$consulta2 = "SELECT descripcion FROM producto where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = $cod_art"; // consulta sql
								$result2 = mysql_query($consulta2);            							  // hace la consulta
								$registro2 = mysql_fetch_row($result2);        							  // toma el registro
								$nombre_articulo= $cod_art.' - '.$registro2[0]; 					
								*/
								$nombre_articulo= 'Art. '.$cod_art.' - Cant: '.number_format($cant_art,2,'.','');
								$id_sig_articulo = idSig();					// llama a la funcion para obtener el sig id
	
								$consulta3 = "call alta_pedido_odb($id_sig_articulo,'$nombre_articulo',$id_sig_cliente,$cod_art,$cant_art,$peso_art,'A','-')";    // llama al procedimiento almacecnado
								$result3 = mysql_query($consulta3);        							  // hace la consulta
								
						} // end while
						fclose ($arch);																		// cierra el archivo
						//********************************************************************************************************************
						// renombra los archivos *.odb
						//********************************************************************************************************************
   						  $dia = date("d",time());  //asigna una cadena a la variable "dia"
						  $mes = date("m",time());  //asigna una cadena a la variable "mes"
						  $ano = date("Y",time());  //asigna una cadena a la variable "año"

						  $fecha = $dia."_".$mes."_".$ano."_";										// maqueta la fecha para imprimir

					   rename($ruta.$archivo,$ruta.'OK_'.$fecha.$archivo); 							  // renombra el archivo *.odb para saber q ya se guardao en la BD
					   
					} 							// end if ($nfilas == 0){
		} 										// end if ($archivo != "." && $archivo != ".." && $ok != 'OK_') {
	} 											// end while
	if($cant_archivos == 0){																	// en caso de q no existan pedidos nuevos muestra el mensaje
		echo 'NO hay pedidos nuevos!!';
	}
	
	closedir($dir);																				// cierra el directorio de pedidos	

}else{ 
	
	//	vacia la tabla temporal en caso de que haya quedado pendiente una factura en una sesion anterior o un caso externo
	//$consulta = "call vaciar_tabla_fac_vta_tmp('$usuario_fac')";
	//$result = mysql_query($consulta);            									// hace la consulta

	require("smarty.php");  				 										// requiere la pag "include.php" para crear una instancia de Smarty
	$smarty = new ClaseSmarty; 				 										//crea una instancia
	$smarty->assign('dia',date("d",time()));  										//asigna una cadena a la variable "dia"
	$smarty->assign('mes',date("m",time()));  										//asigna una cadena a la variable "mes"
	$smarty->assign('ano',date("Y",time()));  										//asigna una cadena a la variable "año"
	//$smarty->display('alta_factura_vta.tpl');   									//define la plantilla que utilizara
	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//
	$modulo="factura_vta";
	$plantilla = "leer_arch_pedidos.tpl";
	include("validar_permiso.php");	
	//=============CONTROL DE PERMISO PARA EL ACCESO AL MODULO=============//

}
?>