<?
	//fecha_desde="+fecha_desde+"&fecha_hasta
	if (!empty($fecha_desde)){
		$consulta = $consulta. " fecha >= $fecha_desde";
		if (!empty($fecha_hasta)){
			$consulta = $consulta. " " . "and fecha <= $fecha_hasta";
		}
	}
	else{
		if (!empty($fecha_hasta)){
			$consulta = $consulta. " " . "fecha >= $fecha_hasta";
		}
	} 
?>