<?php 
	session_start();
	//$_SESSION["base_datos"] = 'factuweb';
	
	ini_set('display_errors','1'); 			// Muestra los errores de php

	$plantilla = isset($_SESSION["user_usuario"])?'principal.tpl':'index.tpl';
	
	require("smarty.php");					// requiere smatry.php
	$smarty->display($plantilla);   		// Define el template a utilixar
?>
