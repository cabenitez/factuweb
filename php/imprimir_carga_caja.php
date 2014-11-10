<?
// echo error_reporting(E_ALL);

//================================ OBTIENE EL DESTINO DE IMPRESION==================================================================================//				
include("conexion.php");
$consulta_impr = "SELECT impresora FROM conf_listados"; // consulta sql                  where nombre = '$nombre'		
$result_impr = mysql_query($consulta_impr);            // hace la consulta
$nfilas_impr = mysql_num_rows ($result_impr);          //indica la cantidad de resultados
$registro_impr = mysql_fetch_row($result_impr);        // toma el registro
if ($nfilas_impr > 0){     						 // si existe el usuario inicia la sesion
		$impresora= $registro_impr[0]; 		// OK
		$posicion_comodin = strrpos ($impresora, "#"); 		
		$impresora = substr($impresora, 0,$posicion_comodin); 		// obtiene solo la info de la impresora
		$impresora = "/printers/".$impresora;
}
//================================FIN =============================================================================================================//		 		

$cant_copias = 1;				  										// indica la cantidad de copias
//________________________configuracion para imprimir_________________________________________________________________________________
 include("conexion_cups.php"); 							    						        // incluye la pagina de conexion con CUPS
 $ipp->setPrinterURI($impresora); 													// nombre de la impresora tal como lo detecta CUPS
 $ipp->setRawText(); 
 $ipp->setCopies($cant_copias);				  										// indica la cantidad de copias

 $destino = 1;
 
 include('exportar_carga_caja.php');
//_________________________Envia el trabajo a Imprimir_______________________________________________________________________________________
 
 $ipp->setMimeMediaType('application/pdf'); 				// modo de impreison para que imprima el archivo y no como texto plano
 $ipp->setData('pdf/'.$usuario_sesion.'2.pdf');				//  Toma la cadena para imprimir
 $ipp->printJob();											//  Imprime el trabajo
 $ipp->setBinary(); 										// resetea al uso normal 

?>