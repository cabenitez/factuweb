<?
// echo error_reporting(E_ALL);
//________________________configuracion para imprimir_________________________________________________________________________________
 include("conexion_cups.php"); 							    				// incluye la pagina de conexion con CUPS
 $ipp->setPrinterURI($impresora); 											// nombre de la impresora tal como lo detecta CUPS
 $ipp->setRawText(); 
 $ipp->setCopies($cant_copias);				  								// indica la cantidad de copias
 $ipp->setDocumentName("Factura Nº $num_sucursal - $num_factura");			// nombre del documento a imprimir
 $ipp->setJobName('Factura Nº $num_sucursal - $num_factura',true);

//_________________________Cuerpo de la Factura_______________________________________________________________________________________
 $factura=" \t\t\t PRESUPUESTO \r";   										//Numero de Factura   

 $factura.="\t\t\t\t\t\t      $num_sucursal - $num_factura \r\n";   		//Numero de Factura   
 $factura.="\t\t\t\t\t\t      FECHA: $fecha \r\n"; 							// Fecha 
 $factura.="\t\t\t\t\t\t      HORA: $hora_actual \r\n"; 					// Hora 
 
  if($cod_cliente == 'no_cliente'){
 		$cod_cliente=""; 													//  Nº Cliente
 }

 $factura.="CLIENTE: $cod_cliente - $razon \r"; 							//  Nombre Cliente
 $factura.="\t\t\t\t\t\t      REMITO: $numero_rem \r\n"; 				//  Nº VENDEDOR
 $factura.="DIRECCION: $dir \r"; 											//  Domicilio Cliente
 $factura.="\t\t\t\t\t\t      VENDEDOR: $vendedor \r\n"; 					//  Nº VENDEDOR
 $factura.="LOCALIDAD: $localidad \r"; 										//  CP - Localidad Cliente
 $factura.="\t\t\t\t\t\t      FLETERO: $repartidor \r\n\n"; 				//  Nº FLETERO 
 
 $factura.="  CODIGO \r ";													//  Codigo de Articulo
 $factura.="\t    CANT. \r"; 												//  Cantidad de Articulo
 $factura.="\t\t  DESCRIPCION \r"; 											//  Descripcion de Articulo  
 $factura.="\t\t\t\t\t     % BON. \r";										//  % Bonificacion 
 $factura.="\t\t\t\t\t\t    $ BON. \r";										//  importe  Bonificacion 
 $factura.="\t\t\t\t\t\t\t    P.UNIT \r ";							    	//  Precio Unitario 
 $factura.="\t\t\t\t\t\t\t\t      IMPORTE \r\n\n ";							//  Precio total  

 $factura.=$detalle;														// Lineas del detalle de la factura
 
 $total_factura = number_format($total_factura,2,'.','');
 $factura.="$observacion \t\t\t     TOTAL GENERAL: $total_factura \r";		//  Total Factura

//_________________________Envia el trabajo a Imprimir_______________________________________________________________________________________
 $ipp->setData($factura);													//  Toma la cadena para imprimir
 $ipp->printJob();															//  Imprime el trabajo
 $ipp->setBinary(); 														// resetea al uso normal 

 
?>