<?
// echo error_reporting(E_ALL);
//________________________configuracion para imprimir_________________________________________________________________________________
 include("conexion_cups.php"); 							    						// incluye la pagina de conexion con CUPS
 $ipp->setPrinterURI($impresora); 													// nombre de la impresora tal como lo detecta CUPS
 $ipp->setRawText(); 
 $ipp->setCopies($cant_copias);				  										// indica la cantidad de copias
 $ipp->setDocumentName("Remito Nº $num_sucursal - $num_remito");											// nombre del documento a imprimir
 $ipp->setJobName('Remito Nº $num_sucursal - $num_remito',true);


//_________________________Cuerpo de la Factura_______________________________________________________________________________________
 $remito="\n\n\t\t\t\t\t\t $num_sucursal - $num_remito \r\n";   					//Numero de Factura   

 $remito.="\t\t\t\t\t\t\t    $fecha \r\n"; 										// Fecha 
  
 $remito.="\t\t\t\t\t\t      Hora: $hora_actual \r\n\n\n\n\n"; 							// Hora 
 
 $remito.="\t  $razon \r"; 														//  Nombre Cliente

 if($cod_cliente != 'no_cliente'){
 		$remito.="\t\t\t\t\t\t\t\t        $cod_cliente \r"; 								//  Nº Cliente
 }
 
 $remito.="\n\t  $dir \r"; 															
 $remito.="\t\t\t\t\t   $localidad \r"; 													
 $remito.="\t\t\t\t\t\t\t\t   $provincia \r\n"; 													
 
 $remito.="\t  $nombre_iva \r"; 													
 $remito.="\t\t\t\t\t   $cuit \r"; 													
 
 $remito.="\n\n\t  $repartidor - $fletero_nombre \r\n"; 											//  Nº FLETERO 
 
 $remito.="\t  $fletero_domicilio\r"; 											
 $remito.="\t\t\t\t\t   $fletero_localidad \r";										
 $remito.="\t\t\t\t\t\t\t\t   $fletero_provincia \r\n"; 							
 
 $remito.="\t  $fletero_camion\r"; 							
 $remito.="\t\t\t\t\t\t   $fletero_patente \r\n";										
 
 $remito.="\t  $fletero_cod_iva \r"; 	
 $remito.="\t\t\t\t\t\t   $fletero_cuit \r"; 							
						
 $remito.="\n\n\t  $vendedor - $vendedor_nombre \r\n"; 											//  Nº VENDEDOR 
 
 $remito.="\n\n\n\r";
 
 $remito.= $detalle;													// Lineas del detalle de la factura
 $remito.="\n\n\r\t\t\t\t $observacion \n\n\n\n\r";												// espacios para imprimir la linea de totales 
 $remito.="\t\t\t\t\t\t\t\t  $total_remito \r";					 			//  Total Factura

//_________________________Envia el trabajo a Imprimir_______________________________________________________________________________________
 $ipp->setData($remito);									//  Toma la cadena para imprimir
 $ipp->printJob();											//  Imprime el trabajo
 $ipp->setBinary(); 										// resetea al uso normal 

 
?>