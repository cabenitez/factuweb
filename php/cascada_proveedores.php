<?
//variables="codigo="+txtcodigo.value+"&cuit="+cuit+"&razon="+txtrazon.value;
if (!empty($codigo)){
    $consulta = $consulta. " " . $consulta2 . " " . "cod_proveedor = $codigo";
    if (!empty($cuit)){
	 	$consulta = $consulta. " " . "and cuit = $cuit"; 
	}
	if (!empty($razon)){
		$consulta = $consulta. " " . "and razon_social ='$razon'"; 
	}
}else{
	if (!empty($cuit)){ 
		$consulta = $consulta. " " . $consulta2 . " " . "cuit = $cuit";
		if (!empty($razon)){
			$consulta = $consulta. " " . "and razon_social LIKE '%$razon%'"; 
		}
	}else{
		if (!empty($razon)){
			$consulta = $consulta. " " . $consulta2 . " " . "razon_social LIKE '%$razon%'";
		} 
	}
} 

?>
