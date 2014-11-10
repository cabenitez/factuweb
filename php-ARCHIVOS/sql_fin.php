<?php
// toma el tiempo de fin
$tiempo_fin = array_sum(explode(' ', microtime()));

//obtiene el resultado del fin del tiempo
$tiempo_final = number_format( $tiempo_fin - $tiempo_inicio,4,'.','').' Seg.';  

?>