<?
	// muestro todos los errores exepto los notices
	//ini_set ('error_reporting', E_ALL & ~E_NOTICE);

	session_start();   								// Iniciar sesi�n
	$usuario_sesion = $_SESSION['user_usuario']; 	// usuario conectado
		
	// verificamos si existe la var. de session
	if(session_is_registered('user_usuario'))
		if(session_is_registered($consulta))
			$consulta = $_SESSION[$consulta]; 			// pasamos a la variable el id de la variable de sesion que contiene el sql
		else
			$consulta = '';
	else
		header ("Location: ../index.php"); 
	
			
	require('class_fpdf/fpdf.php');  												// requiere la pagina de FPDF
	
	//=======================================Establece la conf del archivo PDF ===========================
	$margen_izq = 6;
	$margen_der = 5;												
	$zoom = 100;
	$ancho_de_linea = 0.1;
	
	class PDF extends FPDF {
		//=======================================Cabecera de p�gina===========================================
		function Header(){
			include("conexion.php");
			$consulta = "SELECT * FROM empresa"; 	 							// consulta sql
			$result = mysql_query($consulta);    	 							// hace la consulta
			$registro = mysql_fetch_row($result);	 							// toma el registro
			$razon_social=$registro[2];
			$dir=$registro[10];
			$pais=$registro[11];
			$provincia=$registro[12];
			$localidad=$registro[13];
						
			$this->SetX(6);
			$this->SetFont('Arial','',8);
			$this->Cell(10,10,$razon_social,0,0,'L');								//T�tulo
			//$this->Image('../imagenes/ajax.jpg',10,10,0,0); 						//Agrega una imagen
			//$this->Rect(10, 10, 20, 20);											//Rectangulo
			
			$this->SetX(70);
			$this->SetFont('Arial','',8);
			$this->Cell(10,10,$dir." - ".$localidad,0,0,'L');						//Direccion
			
			$this->SetX(-15); 
			$this->SetFont('Arial','',8);
			$this->Cell(10,10,date("H:i:s").'   '.$fecha  ,0,1,'R');				//Fecha/Hora
		}
		
		//========================================Titulo de p�gina===========================================
		function Titulo($var_titulo){
			$this->SetFont('Arial','UB',10);										//Arial subrayado negrita 10
			$this->Cell(0,10,$var_titulo,0,1,'C');									//T�tulo
		}
	
		//=======================================Pie de p�gina===========================================
		function Footer(){
			$this->SetY(-12);													//Posici�n: a 1,5 cm del final
			$this->SetFont('Arial','',8);										//Arial italic 8
			$this->Cell(0,10,'P�gina '.$this->PageNo().' de {nb}',0,0,'C');		//N�mero de p�gina
		}
	}
	
	//---------------------- PARAMETROS QUE NO SE MODIFICAN ----------------------------------------//
	$pdf=new PDF();																			// crea una instancia de la clase extendida
	$pdf->SetTitle('Listado');
	$pdf->SetSubject('Listado de Sistema de Facturaci�n');
	$pdf->SetKeywords('Sistema de Facturaci�n');
	$pdf->SetAuthor($usuario_sesion);
	$pdf->SetCreator('Librer�a FPDF');
	
	$pdf->SetMargins($margen_izq, $margen_der);												// margenes izq y derecho
	$pdf->SetDisplayMode($zoom);															// zoom
	$pdf->AddPage();																		// agrega una pagina
	$pdf->Titulo($titulo);																	// llama a la funcion T�tulo 
	$pdf->SetLineWidth($ancho_de_linea);													// establece el anche de la linea
	$pdf->AliasNbPages();																	// crea el alias para el numero de pagina	
	//---------------------- FIN DE PARAMETROS NO SE MODIFICAN ---------------------------------//

  
?>
