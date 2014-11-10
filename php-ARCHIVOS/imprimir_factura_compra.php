<?
// echo error_reporting(E_ALL);
//________________________configuracion para imprimir_________________________________________________________________________________
 include("conexion_cups.php"); 							    						// incluye la pagina de conexion con CUPS
 $ipp->setPrinterURI($impresora); 													// nombre de la impresora tal como lo detecta CUPS
 $ipp->setRawText(); 
 $ipp->setCopies($cant_copias);				  										// indica la cantidad de copias
 $ipp->setDocumentName("Factura Nº $num_sucursal - $num_factura");											// nombre del documento a imprimir
 $ipp->setJobName('Factura Nº $num_sucursal - $num_factura',true);


//_________________________Cuerpo de la Factura_______________________________________________________________________________________
 $factura_compra="\t\t  COMPROBANTE FACTURA COMPRA \r\n\n";   					//Numero de Factura   
 
 $factura_compra="$razon_social \t\t\t FECHA: $fecha \t\t  \r\n\n";   					//Numero de Factura   

 $factura_compra.="FACTURA: $sucursal - $factura        FECHA FACTURA: $fecha_factura \n\r";
 $factura_compra.="Usuario: $usuario_fac \n\n\r";	

 $factura_compra.="CODIGO\r";												//  Codigo de Articulo
 $factura_compra.="\t CANTIDAD \r"; 												//  Cantidad de Articulo
 $factura_compra.="\t\t  DESCRIPCION \r"; 						//  Descripcion de Articulo  
 $factura_compra.="\t\t\t\t\t  PRECIO \r";										//  % Bonificacion 
 $factura_compra.="\t\t\t\t\t\t  BONIF.\r";									//  importe  Bonificacion 
 $factura_compra.="\t\t\t\t\t\t\t\t    IMPORTE\r\n ";						//  Precio total  


 $factura_compra.= $detalle."\n\n\n";;													// Lineas del detalle de la factura

//$subtotal,$imp_int_ali,$imp_int_imp,$iva_ali,$iva_imp,$perc_iva_ali,$perc_iva_imp,$pib_ali,$pib_imp,$otros_ali,$otros_imp,$total

 $factura_compra.="SUBTOTAL\r";					 			    			//  Subtotal  
 $factura_compra.="\t    IMP. INTERNO \r";					 	    			//  D.G.R.
 $factura_compra.="\t\t\t   I.V.A. \r";					 	    			//  Subtotal
 $factura_compra.="\t\t\t\t   IVA PERCEPSION \r";					 				//  IVA
 $factura_compra.="\t\t\t\t\t\t   P.I.B. \r ";					 			//  Total Factura
 $factura_compra.="\t\t\t\t\t\t\t   OTROS \r ";					 			//  Total Factura
 $factura_compra.="\t\t\t\t\t\t\t\t     TOTAL \r \n";					 			//  Total Factura

 $factura_compra.="\t    $imp_int_ali %\r";					 			    			//  Subtotal  
 $factura_compra.="\t\t\t   $iva_ali %\r";					 	    			//  D.G.R.
 $factura_compra.="\t\t\t\t   $perc_iva_ali %\r";					 	    			//  Subtotal
 $factura_compra.="\t\t\t\t\t\t   $pib_ali %\r";					 				//  IVA
 $factura_compra.="\t\t\t\t\t\t\t   $otros_ali % \r \n";					 			//  Total Factura

 $factura_compra.="$subtotal \r";					 			    			//  Subtotal  
 $factura_compra.="\t    $imp_int_imp \r";					 	    			//  D.G.R.
 $factura_compra.="\t\t\t   $iva_imp \r";					 	    			//  Subtotal
 $factura_compra.="\t\t\t\t   $perc_iva_imp \r";					 				//  IVA
 $factura_compra.="\t\t\t\t\t\t   $pib_imp \r";					 			//  Total Factura
 $factura_compra.="\t\t\t\t\t\t\t   $otros_imp \r";					 			//  Total Factura
 $factura_compra.="\t\t\t\t\t\t\t\t     $total \r";					 			//  Total Factura
 
//_________________________Envia el trabajo a Imprimir_______________________________________________________________________________________
 $ipp->setData($factura_compra);									//  Toma la cadena para imprimir
 $ipp->printJob();											//  Imprime el trabajo
 $ipp->setBinary(); 										// resetea al uso normal 

 
?>