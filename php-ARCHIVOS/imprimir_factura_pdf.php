<?
	session_start();   // Iniciar sesión
	$usuario_sesion = $_SESSION['user_usuario']; //usuario conectado

	require('class_fpdf/fpdf.php');  												// requiere la pagina de FPDF
	
	//=======================================Establece la conf del archivo PDF ===========================
	$margen_izq = 6;
	$margen_der = 5;												
	$zoom = 100;
	$ancho_de_linea = 0.1;
	
	class PDF extends FPDF {
		//========================================Titulo de página===========================================
		function Titulo($var_titulo){
			$this->SetFont('Arial','UB',10);										//Arial subrayado negrita 10
			$this->Cell(0,10,$var_titulo,0,1,'C');									//Título
		}

		//=======================================Pie de página===========================================

		
		function Footer($observacion, $codigo_tal, $iva_importe_imprimir, $tasa_iva, $neto_gravado, $importe_iva, $no_gravado, $iibb, $total_factura){
				$this->SetY(-50);													//Posición: a 1,5 cm del final
				$this->SetFont('Arial','',8);											//Arial italic 8
				$this->SetX(10);
				$this->Cell(0,3,'Observacion:'.$observacion,0,1);		//Número de página
				$this->Ln(3);
				
				$this->SetX(10);
				$this->Cell(0,3,'TASA IVA',0,0);		
				$this->SetX(30);
				$this->Cell(0,3,'NETO GRAVADO',0,0);		
				$this->SetX(60);
				$this->Cell(0,3,'IMPORTE IVA',0,0);		
				$this->SetX(90);
				$this->Cell(0,3,'NO GRAVADO',0,0);		
				$this->SetX(120);
				$this->Cell(0,3,'PERC. II BB',0,0);		
				$this->SetX(170);
				$this->Cell(0,3,'TOTAL',0,1);		
	
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
						
						$this->SetX(10);
						$this->Cell(0,3,$tasa_iva.'%',0,0);		
						$this->SetX(30);
						$this->Cell(0,3,$neto_gravado,0,0);		
						$this->SetX(60);
						$this->Cell(0,3,$importe_iva,0,0);		
						$this->SetX(90);
						$this->Cell(0,3,$no_gravado,0,0);		
						$this->SetX(120);
						$this->Cell(0,3,$iibb,0,0);		
						$this->SetX(170);
						$this->Cell(0,3,$total_factura,0,1);		
				}
				
				$this->Ln(4);
				$this->SetFont('Arial','',10);										//Arial negrita 10
				$this->SetX(-30);
				$this->Cell(1,3 ,$suma_total_factura,0,0,'R');
	
				
		}
	}
	
	//---------------------- PARAMETROS QUE NO SE MODIFICAN ----------------------------------------//
	$pdf=new PDF();																			// crea una instancia de la clase extendida
	$pdf->SetTitle('Factura');
	$pdf->SetSubject('Factura');
	$pdf->SetKeywords('Sistema de Facturacion');
	$pdf->SetAuthor($usuario_sesion);
	$pdf->SetCreator('Libreria FPDF');
	$pdf->SetMargins($margen_izq, $margen_der);												// margenes izq y derecho
	$pdf->SetDisplayMode($zoom);															// zoom
	$pdf->AddPage();																		// agrega una pagina
	$pdf->SetLineWidth($ancho_de_linea);													// establece el anche de la linea
	$pdf->AliasNbPages();																	// crea el alias para el numero de pagina	
	//---------------------- FIN DE PARAMETROS NO SE MODIFICAN ---------------------------------//

	$codigo_tal= $codigo_tal;									// Tipo de talonario
	$num_sucursal="N: $num_sucursal - $num_factura";   	// Numero de Factura   
	$fecha="Fecha: $fecha"; 						// Fecha 
	$hora_actual="Hora: $hora_actual"; 		// Hora 
	
	if($cod_cliente != 'no_cliente'){
		$cod_cliente = "Cod. Cliente: $cod_cliente"; 		//  Nº Cliente
	}
	
	$razon = "Senor (es): $razon";											//  Nombre Cliente
	$dir = "Domicilio: $dir "; 												//  Domicilio Cliente
	$vendedor ="Vendedor: $vendedor"; 				//  Nº VENDEDOR
	$localidad = "Localidad: $localidad "; 										//  CP - Localidad Cliente
	$repartidor = "Repartidor: $repartidor "; 		//  Nº FLETERO 
	$cond_iva_nombre = "IVA: $cond_iva_nombre ";										//  Condicion de IVA  
	$cuit = "CUIT N: $cuit  ";					//  CUIT 
	$forma_pago_nombre = "Condicion de Venta:    $forma_pago_nombre "; 					//  Condicion de IVA
	$numero_rem = "Remito N: $numero_rem";			//  Nº de Remito
	

	//---------------------- creo los titulos de las columnas-----------------------------------//
	$pdf->Ln(10);
	$pdf->SetFont('Arial','',20);
	$pdf->SetX(100);
	$pdf->Cell(50,8,$codigo_tal,0,3);
	$pdf->Ln(5);
	
	$pdf->SetFont('Arial','',8);
	$pdf->SetX(10);
	$pdf->Cell(10,8,$razon,0,0);
	$pdf->SetX(150);
	$pdf->Cell(10,8,$vendedor,0,1);
	$pdf->SetX(10);
	$pdf->Cell(10,8,$dir,0,0);
	$pdf->SetX(150);
	$pdf->Cell(10,8,$repartidor,0,1);
	$pdf->SetX(10);
	$pdf->Cell(10,8,$localidad,0,1);
	$pdf->SetX(10);
	$pdf->Cell(10,8,$cond_iva_nombre,0,0);
	$pdf->SetX(150);
	$pdf->Cell(10,8,$cuit,0,1);
	$pdf->SetX(10);
	$pdf->Cell(10,8,$forma_pago_nombre,0,0);
	$pdf->SetX(150);
	$pdf->Cell(10,8,$numero_rem,0,3);
	$pdf->Ln(5);
	
	$pdf->SetFont('Arial','',10);
	$pdf->SetX(10);
	$pdf->Cell(10,8,"COD.",0,0);
	$pdf->SetX(30);
	$pdf->Cell(10,8,"CANT.",0,0);
	$pdf->SetX(50);
	$pdf->Cell(10,8,"DESCRIPCION ",0,0);
	$pdf->SetX(90);
	$pdf->Cell(10,8,"%BON.",0,0);
	$pdf->SetX(110);
	$pdf->Cell(10,8,"IMP.",0,0);
	$pdf->SetX(130);
	$pdf->Cell(10,8,"P.U.",0,0);
	$pdf->SetX(150);
	$pdf->Cell(10,8,"IVA",0,0);
	$pdf->SetX(170);
	$pdf->Cell(10,8,"IMPORTE",0,1);

	// bucle para cargar los parametros del detalle al PDF
	$pdf->SetFont('Arial','',8);
	for ($i = 1; $i <= count($array_pdf_cod)+1; $i++) {
		$pdf->SetX(10);
		$pdf->Cell(0,3,$array_pdf_cod[$i],0,0);
		$pdf->SetX(30);
		$pdf->Cell(0,3,$array_pdf_cant[$i],0,0);
		$pdf->SetX(50);
		$pdf->Cell(0,3,$array_pdf_desc[$i],0,0);
		$pdf->SetX(90);
		$pdf->Cell(0,3,$array_pdf_bon[$i],0,0);
		$pdf->SetX(110);
		$pdf->Cell(0,3,$array_pdf_imp[$i],0,0);
		$pdf->SetX(130);
		$pdf->Cell(0,3,$array_pdf_pu[$i],0,0);
		$pdf->SetX(150);
		$pdf->Cell(0,3,$array_pdf_iva[$i],0,0);
		$pdf->SetX(170);
		$pdf->Cell(0,3,$array_pdf_importe[$i],0,1);
	}
	
	// footer
	$pdf->Footer($observacion, $codigo_tal, $iva_importe_imprimir, $tasa_iva, $neto_gravado, $importe_iva, $no_gravado, $iibb, $total_factura);
	
	//---------------------- creo el archivo PDF------------------------------------------------//
	$pdf->Output('pdf/'.$usuario_sesion.'.pdf','F');   // guarda en el server

	
	//________________________________________________________________________________________________________________________
	//________________________configuracion para imprimir_____________________________________________________________________
	//________________________________________________________________________________________________________________________
	
	 $nombreComp = "Factura N: ".$num_sucursal." - ".$num_factura;
	 
	 include("conexion_cups.php"); 							    								// incluye la pagina de conexion con CUPS
	 $ipp->setPrinterURI($impresora);															// nombre de la impresora tal como lo detecta CUPS
	 $ipp->setCopies($cant_copias);																// Cantidad de copias
	 $ipp->setDocumentName($nombreComp);							// Nombre del documento a imprimir
	 $ipp->setJobName($nombreComp,true);							// Nombre del trabajo
	 $ipp->setMimeMediaType('application/pdf'); 				// modo de impreison para que imprima el archivo y no como texto plano
	 $ipp->setData('pdf/'.$usuario_sesion.'.pdf');				//  Toma la cadena para imprimir
	 $ipp->printJob();											//  Imprime el trabajo
	 $ipp->setBinary(); 										// resetea al uso normal 
?>