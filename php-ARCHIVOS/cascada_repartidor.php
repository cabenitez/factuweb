<?
if (!empty($nombre)){
    $consulta = $consulta. " " . $consulta2 . " " . "fletero.nombre LIKE '%$nombre%'";
    if ($vehiculo != 'TODOS'){
	 	$consulta = $consulta. " " . "and vehiculo.cod_vehiculo = $vehiculo";
		$palabra.=" + ".$vehiculo;
	}
}
else{
	if ($vehiculo != 'TODOS'){ 
		$consulta = $consulta. " " . $consulta2 . " " . "vehiculo.cod_vehiculo = $vehiculo";
		$palabra=$vehiculo;
	}
} 
$nombre=$palabra;
?>