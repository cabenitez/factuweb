<?
//_____________________________________configuracion_______________________________________________________
 require_once("class_print_ipp/PrintIPP.php"); 						// requiere la pag pagina para trabajar
 $ipp = new PrintIPP(); 				 							// instancia la clase para manejar las impresiones
 
 $ipp->setHost("localhost"); 			 							// define el servidor
 $ipp->ssl = true; 						 							// habilita ssl
 $ipp->setCharset('utf-8');											// codificacion para caracteres extraños
 $ipp->setUserName("Factuweb - $usuario_fac");						// nombre delusuario
 //$ipp->setAuthentification($user,$password); 						// usuario y clave de acceso

 //error_reporting(E_ALL);

?>