<?php
function fiscal_set_comando($array_fiscal,$serie,$puerto,$velocidad){ 
	// abre el puerto
	$port = IF_OPEN($puerto,$velocidad);  
	
	// verifica la disponibilidad del puerto
	if ( $port == -1) {
		$estado = "ERROR: No se puede establecer la conexin, {PUERTO,VELOCIDAD}";
	}else{

		if($serie != ""){
			IF_SERIAL($serie);
		}

		// bucle para cargar los parametros fiscales
		for ($i = 1; $i <= count($array_fiscal); $i++) {
			$estado = IF_WRITE($array_fiscal[$i]);
		}
		
		// si hay error cancelar la factura
		//$estado =  IF_READ(3);
		
		// cierra el puerto
		$estado = IF_CLOSE();
	}
	return $estado;
} 
?>
