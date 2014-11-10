<?php

	// Smarty v3.1.18
	require 'libs/Smarty.class.php';
	$smarty = new Smarty;

	$smarty->template_dir   = 'templates/';     // Directorio de plantillas
	$smarty->compile_dir    = 'templates_c/';   // templates cache
	$smarty->config_dir     = 'configs/';		// config
	$smarty->cache_dir      = 'cache/';			// cache
	$smarty->force_compile  = true;				// recompila los templates - USO: true->desarrollo, false->produccion
	$smarty->debugging 	    = false;			// ventana de debug
	$smarty->caching 	    = false;				// cacheo
	$smarty->cache_lifetime = 120;				// duracion en segundos de la cache
?>