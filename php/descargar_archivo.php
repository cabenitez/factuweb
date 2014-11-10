<?
	//====================== obliga a la descarga del archivo q viene como parametro===================//
	/*
	header( "Content-Type: application/octet-stream");
	header( "Content-Length: ".filesize($dir.$arch));
	header( "Content-Disposition: attachment; filename=".$arch); 
	readfile($dir.$arch); 
	*/


	if (file_exists($archivo)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($archivo));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($archivo));
		ob_clean();
		flush();
		readfile($archivo);
		exit;
	}


?> 