<?
		//variables="codigo="+txtcodigo.value+"&razon="+txtrazon.value+"&localidad="+txt_loca;

if (!empty($codigo)){
    $consulta = $consulta. " " . $consulta2 . " " . "cod_cliente LIKE '%$codigo%'";
	$palabra.=$codigo;
	if (!empty($razon)){
		$consulta = $consulta. " " . "and razon_social LIKE ' %$razon%' "; 
		$palabra.=" + ".$razon; 
	}
    if ($localidad != "TODOS"){
	 	$consulta = $consulta. " " . "and cod_localidad = $localidad"; 
		$palabra.=" + ".$localidad; 
	}
}else{
	if (!empty($razon)){
			$consulta = $consulta. " " . $consulta2 . " " . "razon_social LIKE '%$razon%'";
			$palabra.=" + ".$razon; 
			if ($localidad != "TODOS"){
				$consulta = $consulta. " " . "and cod_localidad = $localidad"; 
				$palabra.=" + ".$localidad; 
			}
	}else{
		if ($localidad != "TODOS"){ 
			$consulta = $consulta. " " . $consulta2 . " " . "cod_localidad = $localidad";
			$palabra.=$localidad; 
		}	
	}
} 
$nombre=$palabra; // variable para incluir en la consulta
?>
