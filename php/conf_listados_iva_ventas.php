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
		//=======================================Cabecera de página===========================================
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
			$this->Cell(10,10,$razon_social,0,0,'L');								//Título
			
			$this->SetX(70);
			$this->SetFont('Arial','',8);
			$this->Cell(10,10,$dir." - ".$localidad,0,0,'L');						//Título
			
			//$this->Cell(10,10,date("H:i:s").'   '.$fecha  ,0,1,'R');										//Título
		}
		function Hoja($n){
			$this->SetX(-25); 
			$this->SetFont('Arial','',8);
			$this->Cell(10,10,'HOJA: '.$n,0,1,'C');		//Número de página
		}
		
		//========================================Titulo de página===========================================
		function Titulo($var_titulo){
			$this->SetFont('Arial','UB',10);										//Arial subrayado negrita 10
			$this->Cell(0,10,$var_titulo,0,1,'C');									//Título
		}
	
	  /*
		//=======================================Pie de página===========================================
		function Footer(){
			$this->SetY(-12);													//Posición: a 1,5 cm del final
			$this->SetFont('Arial','',8);										//Arial italic 8
			$this->Cell(0,10,'Página '.$this->PageNo().' de {nb}',0,0,'C');		//Número de página
		}
	*/
	}
	
	//---------------------- PARAMETROS QUE NO SE MODIFICAN ----------------------------------------//
	$pdf=new PDF();																			// crea una instancia de la clase extendida
	$pdf->SetTitle('Listado');
	$pdf->SetSubject('Listado de Sistema de Facturación');
	$pdf->SetKeywords('Sistema de Facturación');
	$pdf->SetAuthor($usuario_sesion);
	$pdf->SetCreator('Librería FPDF');
	
	$pdf->SetMargins($margen_izq, $margen_der);												// margenes izq y derecho
	$pdf->SetDisplayMode($zoom);															// zoom
	$pdf->AddPage();
	$pdf->Hoja($n);																			// agrega una pagina
	$pdf->Titulo($titulo);																	// llama a la funcion Título 
	$pdf->SetLineWidth($ancho_de_linea);													// establece el anche de la linea
	$pdf->AliasNbPages();																	// crea el alias para el numero de pagina	
	

	//---------------------- FIN DE PARAMETROS NO SE MODIFICAN ---------------------------------//

  
?>