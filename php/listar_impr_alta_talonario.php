<?
	// oculto los errores
	error_reporting(0);
	ini_set('display_errors', 0); 

	//================================IMPRESORAS==================================================================================//				
	function __autoload($class_name) { 
		require_once ("class_print_ipp/".$class_name . '.php'); 
	} 
	
	// instancia la clase CupsPrintIPP para acceder a las impresoras instaladas en el server
	$ipp = new CupsPrintIPP;

	if($ipp->getPrinters() == "successfull-ok"){; // si realiza la conexion
		echo"<select name='impresora' id='impresora' class='caja' onKeyUp='pasar_foco_tal_12(event)'>"; 
			for ($i = 0 ; $i < count($ipp->available_printers) ; $i ++) {
				$ipp->setPrinterURI($ipp->available_printers[$i]);
				$ipp->getPrinterAttributes();
				
				// obriene el nombre de la impresora y la info para mostrar
				$impr_nombre =$ipp->printer_attributes->printer_name->_value0;
				$impr_info = $ipp->printer_attributes->printer_info->_value0;
				// en la BD guarda el nombre de la impresora detectada por el SO mas la info para mostrar separados por  '#'
				echo "<option value='$impr_nombre#$impr_info' title='ID: $impr_nombre'>$impr_info</option>";
			}
			echo "<option value='---NINGUNA---#---NINGUNA---' title='NO EMITE COMPROBANTE'>---NINGUNA---</option>"; // NINGUNA IMPRESORA
		echo"</select>";
	}else{
		echo "NO hay Impresoras disponibles";
	}


	//================================FIN DE IMPRESORAS============================================================================//
	
?>