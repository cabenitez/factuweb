<?
	//====================== obliga a la descarga del archivo q viene como parametro===================//
	
	header( "Content-Type: application/octet-stream");
	header( "Content-Length: ".filesize($dir.$arch));
	header( "Content-Disposition: attachment; filename=".$arch);
	readfile($dir.$arch); 

?> 