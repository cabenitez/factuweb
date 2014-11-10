<?
// echo error_reporting(E_ALL); 

//_________________________Cuerpo de la Factura___________________________________________________________________________
 $factura= "\n";																			// Espacio de arriba
 $factura.= $margen."\t\t\t\t         $codigo_tal \r\n";									// Tipo de talonario
 $factura.= $margen.$margen."\t\t\t\t\t\t      N: $num_sucursal - $num_factura \r\n";   	// Numero de Factura   
 $factura.= $margen.$margen."\t\t\t\t\t\t      Fecha: $fecha \r\n"; 						// Fecha 
 $factura.= $margen.$margen."\t\t\t\t\t\t      Hora: $hora_actual \r\n\n\n\n\n\n\n"; 		// Hora 
 
 if($cod_cliente != 'no_cliente'){
 		$factura.= $margen.$margen."\t\t\t\t\t\t\t     Cod. Cliente: $cod_cliente \r"; 		//  Nº Cliente
 }
 
 $factura.= $margen."Senor (es): $razon \r\n";											//  Nombre Cliente
 $factura.= $margen."Domicilio: $dir \r"; 												//  Domicilio Cliente
 $factura.= $margen.$margen."\t\t\t\t\t\t\t     Vendedor: $vendedor \r\n"; 				//  Nº VENDEDOR
 $factura.= $margen."Localidad: $localidad \r"; 										//  CP - Localidad Cliente
 $factura.= $margen.$margen."\t\t\t\t\t\t\t     Fletero: $repartidor \r\n\n\n"; 		//  Nº FLETERO 
 $factura.= $margen."IVA:    $cond_iva_nombre \r";										//  Condicion de IVA  
 $factura.= $margen.$margen."\t\t\t\t\t\t       CUIT N: $cuit \r\n ";					//  CUIT 
 $factura.= $margen."Condiciones de Venta:    $forma_pago_nombre \r"; 					//  Condicion de IVA
 $factura.= $margen.$margen."\t\t\t\t\t\t       Remito N: $numero_rem \r\n\n";			//  Nº de Remito
	$factura.= $margen."COD.\r";													//  Codigo de Articulo
	$factura.= $margen."\t CANT. \r"; 												//  Cantidad de Articulo
	$factura.= $margen."\t\t DESCRIPCION \r"; 											//  Descripcion de Articulo  
	$factura.= $margen.$margen.$margen."\t\t\t %BON. \r";						//  % Bonificacion 
	$factura.= $margen.$margen.$margen."\t\t\t\t IMP. \r";					//  importe  Bonificacion 
	$factura.= $margen.$margen.$margen."\t\t\t\t\t P.U. \r ";						//  Precio Unitario
	$factura.= $margen.$margen.$margen."\t\t\t\t\t\t IVA \r ";				  	//  Tasa IVA
	$factura.= $margen.$margen.$margen."\t\t\t\t\t\t\t IMPORTE\r ";					//  Precio total  
 
 $factura.= $margen."\n".$detalle;														//  Lineas del detalle
 $factura.= $margen."\n\n\r\t\t\t\t $observacion \n\n\r";								//  Espacios para imprimir la linea de totales 

 //---------------------------LEYENDA DE TOTALES------------------------------//
 $factura.= $margen."TASA IVA \r";												//  TASA IVA
 $factura.= $margen."\t\t NETO GRAVADO\r";										//  NETO GRAVADO
 $factura.= $margen."\t\t\t\t\t IMPORTE IVA \r";		 	    				//  IMPORTE IVA
 $factura.= $margen."\t\t\t\t\t\t\t\t NO GRAVADO \r";							//  NO GRAVADO
 $factura.= $margen."\t\t\t\t\t\t\t\t\t\t  PERC. II BB \r";						//  IIBB
 $factura.= $margen.$margen.$margen."\t\t\t\t\t\t\t TOTAL \r\n";				//  TOTAL

 //---------------------------IMPORTE DE TOTALES------------------------------//
/*
 $factura.= $margen."  $total_importe \r";		 			    				//  Subtotal  
 $factura.= $margen."\t\t   $importe_ing_bruto \r";			 	    			//  D.G.R.
 $factura.= $margen."\t\t\t   $subtotal \r";		 	    					//  Subtotal
 $factura.= $margen."\t\t\t\t         $importe_iva \r";		 					//  IVA
 $factura.= $margen.$margen.$margen."\t\t\t\t\t\t\t $total_factura \r";			//  Total Factura
*/

foreach ($iva_importe_imprimir as $tasa_iva => $neto_gravado) {
	 
	 $neto_gravado = number_format($neto_gravado,2,'.','');
	 
	 if($codigo_tal == "A"){
		 $importe_iva = ($neto_gravado * $tasa_iva)/100;
		 $total_factura = $neto_gravado + ($neto_gravado * $tasa_iva/100);
		 $importe_iva = number_format($importe_iva,2,'.','');
	 }else{
		 $importe_iva = "";
		 $total_factura = $neto_gravado;
	 }
	 
	 $total_factura = number_format($total_factura,2,'.','');
     $suma_total_factura = $suma_total_factura + $total_factura;
   /*
	if($codigo_tal == "A"){
			if($tasa_img_bruto != 0){
				$tasa_img_bruto_impr ="II.BB. ".$tasa_img_bruto ."%"; 
				$importe_ing_bruto = ($total_importe * $tasa_img_bruto)/100;
			}
			$subtotal= $importe_ing_bruto + $total_importe;
			$tasa_iva_impr = $tasa_iva."%";
			$importe_iva = ($total_importe * $tasa_iva)/100;
			
			$total_factura = $total_importe + ((($total_importe * $tasa_img_bruto)/100) + (($total_importe * $tasa_iva)/100)) ;
	}else{
			if ($cond_iva_nombre == 'MONOTRIBUTO'){
				if($tasa_img_bruto != 0){
					$tasa_img_bruto_impr = "II.BB. ".$tasa_img_bruto ."%"; 
					$importe_ing_bruto = $total_importe * $tasa_img_bruto / 100 ;
				}
				$subtotal= $importe_ing_bruto + $total_importe;
			}else{
				$subtotal = $total_importe; 
			}
			$total_factura =  $subtotal ;
	}
	*/	
	 //$total_importe = number_format($total_importe,2,'.','');
	 //$importe_ing_bruto = number_format($importe_ing_bruto,2,'.','');
	 //$subtotal = number_format($subtotal,2,'.','');
	 
	 $factura.= $margen."$tasa_iva% \r";											//  TASA IVA
	 $factura.= $margen."\t\t $neto_gravado\r";										//  NETO GRAVADO
	 $factura.= $margen."\t\t\t\t\t $importe_iva \r";		 	    				//  IMPORTE IVA
	 $factura.= $margen."\t\t\t\t\t\t\t\t $no_gravado \r";							//  NO GRAVADO
	 $factura.= $margen."\t\t\t\t\t\t\t\t\t\t  $iibb \r";							//  IIBB
	 $factura.= $margen.$margen.$margen."\t\t\t\t\t\t\t $total_factura \r\n";		//  TOTAL
	 
}

//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
//\\//\\//\\//\\//\\//\\//\\ FISCAL //\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\

$array_fiscal[$i_fiscal++] = "@FACTPAGO|PAGO|$suma_total_factura|T";
$array_fiscal[$i_fiscal++] = "@FACTCIERRA|F|$codigo_tal|TOTAL";

if($impresora_fiscal == 1){
	include("fiscal_set_comando.php");
	fiscal_set_comando($array_fiscal,$serie_fiscal,$puerto_fiscal,$velocidad_fiscal);

}else{

//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
//\\//\\//\\//\\//\\//\\//\\ FISCAL //\\//\\//\\//\\//\\//\\//\\//\\//\\//\\
//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\

//die(); 
//________________________configuracion para imprimir_____________________________________________________________________
 $nombreComp = "Factura N: ".$num_sucursal." - ".$num_factura;
 
 include("conexion_cups.php"); 							    								// incluye la pagina de conexion con CUPS
 $ipp->setPrinterURI($impresora);															// nombre de la impresora tal como lo detecta CUPS
 $ipp->setRawText(); 
 $ipp->setCopies($cant_copias);																// Cantidad de copias
 $ipp->setDocumentName($nombreComp);							// Nombre del documento a imprimir
 $ipp->setJobName($nombreComp,true);							// Nombre del trabajo
 $ipp->setData($factura);																	// Toma la cadena para imprimir
 $ipp->printJob();																			// Imprime el trabajo
 $ipp->setBinary();																			// resetea al uso normal
} 
?>
