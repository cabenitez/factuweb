<?
// echo error_reporting(E_ALL);
//________________________configuracion para imprimir_________________________________________________________________________________
 include("conexion_cups.php"); 							    						// incluye la pagina de conexion con CUPS
 $ipp->setPrinterURI($impresora); 													// nombre de la impresora tal como lo detecta CUPS
 $ipp->setRawText(); 
 $ipp->setCopies($cant_copias);				  										// indica la cantidad de copias
 $ipp->setDocumentName("COMPROBANTE Nº $num_sucursal - $num_devolucion");											// nombre del documento a imprimir
 $ipp->setJobName('COMPROBANTE Nº $num_sucursal - $num_devolucion',true);

 $hora_actual = date("H:i:s");
//_________________________Cuerpo de la Factura_______________________________________________________________________________________
  $factura=" \t\t\t DEVOLUCION \r";   					//Numero de Factura   

 $factura.="\t\t\t\t\t\t      $num_sucursal - $num_devolucion \r\n";   					//Numero de Factura   
 $factura.="\t\t\t\t\t\t      FECHA: $fecha \r\n"; 										// Fecha 
 $factura.="\t\t\t\t\t\t      HORA: $hora_actual \r\n"; 							// Hora 
 $factura.="VENDEDOR: $vendedor - $nombre_vendedor \t\t      FECHA CARGA: $fecha_carga \r\n\n"; 														//  Nombre Cliente
 
 $factura.="CODIGO \r ";												//  Codigo de Articulo
 $factura.="\t    CANT. \r"; 												//  Cantidad de Articulo
 $factura.="\t\t  DESCRIPCION \r\n"; 						//  Descripcion de Articulo  

 $factura.=$detalle;													// Lineas del detalle de la factura
 $factura.="\t\t\t     TOTAL APROX. + IVA: $precio_total \r";					 			//  Total Factura

//_________________________Envia el trabajo a Imprimir_______________________________________________________________________________________
 
 $ipp->setData($factura);									//  Toma la cadena para imprimir
 $ipp->printJob();											//  Imprime el trabajo
 $ipp->setBinary(); 										// resetea al uso normal 

 
?>