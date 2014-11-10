<?
if (!empty($codigo)){
    $consulta = $consulta. " " . $consulta2 . " " . "variedad.cod_variedad LIKE '%$codigo%'";
	$palabra.=$codigo;
	if (!empty($nombre)){
		$consulta = $consulta. " " . "and variedad.descripcion LIKE '%$nombre%'"; 
		$palabra.=" + ".$nombre;
	}
	if ($cod_grupo != "TODOS"){
	 	$consulta = $consulta. " " . "and variedad.cod_grupo = $cod_grupo"; 
		$palabra.=" + ".$cod_grupo;
	}
	if ($cod_marca != "TODOS"){
	 	$consulta = $consulta. " " . "and variedad.cod_marca = $cod_marca"; 
		$palabra.=" + ".$cod_marca;
	}
}else{
	if (!empty($nombre)){ 
		$consulta = $consulta. " " . $consulta2 . " " . "variedad.descripcion LIKE '%$nombre%'"; 
		$palabra.=$nombre;
		if ($cod_grupo != "TODOS"){
			$consulta = $consulta. " " . "and variedad.cod_grupo = $cod_grupo"; 
			$palabra.=" + ".$cod_grupo;
		}
		if ($cod_marca != "TODOS"){
			$consulta = $consulta. " " . "and variedad.cod_marca = $cod_marca"; 
			$palabra.=" + ".$cod_marca;
		}
	}else{
		if ($cod_grupo != "TODOS"){
			$consulta = $consulta. " " . $consulta2 . " " . "variedad.cod_grupo = $cod_grupo";
			$palabra.=$cod_grupo;
			
			if ($cod_marca != "TODOS"){
				$consulta = $consulta. " " . "and variedad.cod_marca = $cod_marca"; 
				$palabra.=" + ".$cod_marca;
			}
		}else{
			if ($cod_marca != "TODOS"){
				$consulta = $consulta. " " . $consulta2 . " " . "variedad.cod_marca = $cod_marca";
				$palabra.=$cod_marca;
			}
		}
	}	
}
$nombre=$palabra; // variable para incluir en la consulta
?>