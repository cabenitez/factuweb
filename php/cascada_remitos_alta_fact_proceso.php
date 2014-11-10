<?
//	variables="codigo=""&razon=""&localidad="

$fecha_desde=$ano_desde.$mes_desde.$dia_desde;
$fecha_hasta=$ano_hasta.$mes_hasta.$dia_hasta;

if (!empty($codigo)){
    $consulta = $consulta. " " . $consulta2 . " " . "remito_vta.num_remito LIKE '%$codigo%'";
	if (!empty($razon)){
		$consulta = $consulta. " " . "and cliente.razon_social LIKE '%$razon%'"; 
	}
    if ($localidad != "TODOS"){
		$consulta = $consulta. " " . "and localidad.nombre = '$localidad'"; 
	}
	if ($fecha_desde != "" && $fecha_hasta != ""){
		$consulta = $consulta. " " . "and remito_vta.fecha >= $fecha_desde and remito_vta.fecha <= $fecha_hasta"; 
	}
}else{
	if (!empty($razon)){
			$consulta = $consulta. " " . $consulta2 . " " . "cliente.razon_social LIKE '%$razon%'";
			if ($localidad != "TODOS"){
				$consulta = $consulta. " " . "and localidad.nombre = '$localidad'"; 
			}
			if ($fecha_desde != "" && $fecha_hasta != ""){
				$consulta = $consulta. " " . "and remito_vta.fecha >= $fecha_desde and remito_vta.fecha <= $fecha_hasta"; 
			}
	}else{
		if ($localidad != "TODOS"){ 
			$consulta = $consulta. " " . $consulta2 . " " . "localidad.nombre = '$localidad'";
			if ($fecha_desde != "" && $fecha_hasta != ""){
				$consulta = $consulta. " " . "and remito_vta.fecha >= $fecha_desde and remito_vta.fecha <= $fecha_hasta"; 
			}
		}else{
			if ($fecha_desde != "" && $fecha_hasta != ""){
				$consulta = $consulta. " " . $consulta2 . " " . "remito_vta.fecha >= $fecha_desde and remito_vta.fecha <= $fecha_hasta"; 
			}
		}
	}
} 
?>
