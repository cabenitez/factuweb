<?php
  // abre el puerto
  $port = IF_OPEN($puerto_fiscal,$velocidad_fiscal);  

  // verifica la disponibilidad del puerto
  if ( $port == -1) {
     echo "impresora ocupada";
	 return;  
  }
 
  // bucle para cargar los parametros fiscales
  for ($i = 1; $i <= $i_fiscal; $i++) {
	 $err = IF_WRITE($array_fiscal[$i]);
  }

  // si hay error cancelar la factura
  $nfactura =  IF_READ(3);
  
  // cierra el puerto
  $err =IF_CLOSE();
?>
