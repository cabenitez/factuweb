<?php
	/*
	include("../conexion.php");
	
	// Obtiene la configuracion de colores para el acalendario
	$getSettings = mysql_query("SELECT * FROM settings WHERE id='1' LIMIT 1", $coneccion);
	if($getSettings) {
		extract(mysql_fetch_array($getSettings), EXTR_PREFIX_ALL, 's');
		$dayColor = $s_dayColor;
		$weekendColor = $s_weekendColor;
		$todayColor = $s_todayColor;
		$eventColor = $s_eventColor;
		$iteratorColor1 = $s_iteratorColor1;
		$iteratorColor2 = $s_iteratorColor2;
	} else {
		die("ERROR: No se puede conectar");
	}
	*/
		// colores por defecto
		$dayColor =	"e6e1d3";
		$weekendColor = "a0a395";
		$todayColor = "ffeb45";
		$eventColor = "fa0032";
		$iteratorColor1 = "e6e1d1";
		$iteratorColor2 = "ffffff";

?>