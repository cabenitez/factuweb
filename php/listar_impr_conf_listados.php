<?
//================================IMPRESORAS==================================================================================//				
	include("conexion.php");
	$consulta = "SELECT impresora FROM conf_listados"; // consulta sql                  where nombre = '$nombre'		
	$result = mysql_query($consulta);            // hace la consulta
   	$nfilas = mysql_num_rows ($result);          //indica la cantidad de resultados
	$registro = mysql_fetch_row($result);        // toma el registro
	//if ($nfilas > 0){     						 // si existe el usuario inicia la sesion
		$impresion=$registro[0];   									// obtiene el nombre y la info de la impresora
		$posicion_comodin = strrpos ($impresion, "#") + 1; 		
		$impresion = substr($impresion, $posicion_comodin); 		// obtiene solo la info de la impresora
		
		function __autoload($class_name) { 
				require_once ("class_print_ipp/".$class_name . '.php'); 
		} 
									
		$ipp = new CupsPrintIPP; // instancia la clase  
		
		if($ipp->getPrinters() == "successfull-ok"){; // si realiza la xonexion
			echo"<select name='impresora_mod' id='impresora_mod' class='caja' onKeyUp='pasar_foco_conf_listados_2(event)'>"; 
				for ($i = 0 ; $i < count($ipp->available_printers) ; $i ++) {
						$ipp->setPrinterURI($ipp->available_printers[$i]);
						$ipp->getPrinterAttributes();
						
						// obriene el nombre de la impresora y la info para mostrar
						$impr_nombre =$ipp->printer_attributes->printer_name->_value0;
						$impr_info = $ipp->printer_attributes->printer_info->_value0;
						// en la BD guarda el nombre de la impresora detectada por el SO mas la info para mostrar separados por  '#'
						
						if ( $impresion == $impr_info){
								echo "<option selected value='$impr_nombre#$impr_info' title='ID: $impr_nombre'>$impr_info</option>";
						}else{
								echo "<option value='$impr_nombre#$impr_info' title='ID: $impr_nombre'>$impr_info</option>";
						}
				}
			echo"</select>";
		}else{
			echo "NO hay Impresoras disponibles";
		}
		

	//}

//================================FIN DE IMPRESORAS============================================================================//
?>