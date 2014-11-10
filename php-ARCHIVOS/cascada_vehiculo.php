<?
if (!empty($marca)){
    $consulta = $consulta. " " . $consulta2 . " " . "vehiculo.marca LIKE '%$marca%'";
    $palabra=$marca;
	if (empty($flet)){
		if (!empty($chofer)){
			$consulta = $consulta. " " . "and fletero.nombre = '$chofer'"; 
			$palabra.=" + ".$chofer;
		}
	}	
}
else{
	if (empty($flet)){
		if (!empty($chofer)){ 
			$consulta = $consulta. " " . $consulta2 . " " . "fletero.nombre LIKE '%$chofer%'";
			$palabra=$chofer;
		}
	}	
} 
$nombre=$palabra; // variable para incluir en la consulta
?>
