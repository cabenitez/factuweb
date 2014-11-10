<?php
// crea una variable de SESSION para el pdf
$id_sql = 'f'.rand();
$_SESSION[$id_sql] = $consulta_informe;                 		
// crea el div con el id de la sql
echo "<div id='capa_impresion'  style='visibility: hidden'>$id_sql</div>"; 

?>