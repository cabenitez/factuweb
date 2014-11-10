<?php
  
function fiscal_get_estado_descripcion($comando,$codigo,$campo){

	$comando = strtoupper ($comando);
	if($comando == "ESTADO" ){			
			$codigo = strtoupper ($codigo);
			switch ($codigo) {
				 case 'A':				// A = Informaci�n sobre los contadores de documentos fiscales y no fiscales
					 $n=13;	 
					 break;
				 case 'C':				// C = Informaci�n sobre el contribuyente
					 $n=9;	 
					 break;
				 case 'D':				// D = Informaci�n sobre el documento que se esta emitiendo
					 $n=4;	 
					 break;
				 case 'N':				// N = Informaci�n normal
					 $n=10;	 
					 break;
				 case 'P':				// P = Informaci�n sobre las caracter�sticas del controlador fiscal
					 $n=13;	 
					 break;
				default:
					 $codigo=-1; 		// ERROR 
			}
	}
	if($comando == "CIERREZ"){ 			
			$n=18;	 
	}
	
	if($codigo == -1){
		$estado = "ERROR: Codigo Incorrecto, {A C D N P}";
	}else{
		if ($campo <= $n){
			//IF_SERIAL("27-0163848-435");
			//IF_WRITE("@".$comando."|".$codigo);
			$estado = IF_READ($campo) ;
		}else{
			$estado = "ERROR: Campo Incorrecto, {1..$n}";
		}		
   }
   
   // cierra el puerto
   $err =IF_CLOSE();
}

return $estado;

?>