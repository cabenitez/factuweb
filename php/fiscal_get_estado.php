<?php
  
function fiscal_get_estado($comando,$serie,$puerto,$velocidad,$codigo,$campo){ 
	// abre el puerto
	$port = IF_OPEN($puerto,$velocidad);  
	
	// verifica la disponibilidad del puerto
	if ( $port == -1) {
		$estado = "ERROR: No se puede establecer la conexin, {PUERTO,VELOCIDAD}";
	}else{
		$comando = strtoupper ($comando);
		if($comando == "ESTADO" ){			
				$codigo = strtoupper ($codigo);
				switch ($codigo) {
					 case 'A':				// A = Información sobre los contadores de documentos fiscales y no fiscales
						 $n=13;	 
						 break;
					 case 'C':				// C = Información sobre el contribuyente
						 $n=9;	 
						 break;
					 case 'D':				// D = Información sobre el documento que se esta emitiendo
						 $n=4;	 
						 break;
					 case 'N':				// N = Información normal
						 $n=10;	 
						 break;
					 case 'P':				// P = Información sobre las características del controlador fiscal
						 $n=13;	 
						 break;
					default:
						 $codigo=-1; 		// ERROR 
				}
		}
		if($comando == "CIERREZ"){ 			
				$n=18;	 
		}
		if($comando == "PIDEFECHORA" || $comando == "PIDEENCABEZADO"){ 			
				$n=4;	 
		}
		if($comando == "LEEZONAS"){ 			
				$n=6;	 
		}

		
		if($codigo == -1){
			$estado = "ERROR: Codigo Incorrecto, {A C D N P}";
		}else{
			if ($campo <= $n){
				
				if($serie != ""){
					IF_SERIAL($serie);
				}
				
				$estado = IF_READ($campo) ;
			}else{
				$estado = "ERROR: Campo Incorrecto, {1..$n}";
			}		
	   }
	   
	   // cierra el puerto
	   $err =IF_CLOSE();
	}
	
	return $estado;
}

?>